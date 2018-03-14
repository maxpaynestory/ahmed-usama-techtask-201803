<?php

// web/index.php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/lunch', function ($name) use ($app) {
    
    $getRecipes = new \RecipeApp\Usecases\GetRecipes();
    
    return json_encode(['help'=>'sdads']);
});

$app->run();