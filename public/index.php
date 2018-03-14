<?php

use RecipeApp\Usecases\GetRecipes;
use RecipeApp\ValueObjects\Recipe;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// web/index.php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        
    }
});

$app->post('/lunch', function (Request $request) use ($app) {
    
    $getRecipes = new GetRecipes();
    
    $recipesStr = file_get_contents('recipes.json');
    
    $recipesJson = json_decode($recipesStr,true);
    
    $recipes = [];
    
    foreach($recipesJson['recipes'] as $recipeArr){
        array_push($recipes, new Recipe($recipeArr['title'], $recipeArr['ingredients']));
    }
    
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
    
    $ingredientsArr = $request->request->get('ingredients');
    
    if(count($ingredientsArr) < 1){
        return new Response('Ingredients are missing', 500); 
    }
    
    $ingredients = [];
    
    foreach($ingredientsArr as $recipeArr){
        array_push($ingredients, new \RecipeApp\ValueObjects\Ingredient($recipeArr['title'],$recipeArr['best-before'],$recipeArr['use-by']));
    }
    
    $resultRecipes = $getRecipes->execute($ingredients, $recipes);
    
    $responseArray = [];
    
    foreach($resultRecipes as $recipe){
        array_push($responseArray, [
            'title'=>$recipe->getTitle(),
            'ingredients'=>$recipe->getIngredients()
        ]);
    }
    
    return new \Symfony\Component\HttpFoundation\JsonResponse(['recipes' => $responseArray]);
});

$app->run();