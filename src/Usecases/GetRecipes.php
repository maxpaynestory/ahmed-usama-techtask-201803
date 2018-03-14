<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RecipeApp\Usecases;

use RecipeApp\ValueObjects\Ingredient;
use RecipeApp\ValueObjects\Recipe;

/**
 * Description of GetRecipes
 *
 * @author Usama Ahmed Khan
 */
class GetRecipes {
    function __construct(){
        
    }
    
    /**
     * @param Ingredient[] $aIngredients Array of ingredient objects
     * @param Recipe[] $aRecipes Array of recipe objects
     */
    function execute(array $aIngredients, array $aRecipes){
        $nonExpiredIngredients = array_filter($aIngredients, function($item){
            if($item instanceof Ingredient){
                return $item->hasNotExpired();
            }
            return false;
        });
        
        var_dump($nonExpiredIngredients);
        die();
    }
}
