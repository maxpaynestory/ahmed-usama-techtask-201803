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
     * @return Recipe[] Array of recipe objects
     */
    function execute(array $aIngredients, array $aRecipes){
        $expiredNames = [];
        
        $nonExpiredIngredients = array_filter($aIngredients, function($item) use (&$expiredNames){
            if($item instanceof Ingredient){
                $hasNotExpired = $item->hasNotExpired();
                if(!$hasNotExpired){
                    array_push($expiredNames, $item->getTitle());
                }
                return $hasNotExpired;
            }
            throw new \Exception("not an instance of Ingredient");
        });
        
        
        $recipesWithNonExpiredIngredients = array_filter($aRecipes, function($item1) use ($expiredNames, $aIngredients) {
            if($item1 instanceof Recipe){
                foreach($item1->getIngredients() as $ingredientTitle){
                    if(in_array($ingredientTitle, $expiredNames)){
                        return false;
                    }
                    //////// Add freshness points to recipe ///////////
                    foreach($aIngredients as $ingredient){
                        if($ingredient->getTitle() === $ingredientTitle and $ingredient->bestToEat()){
                            $item1->addFreshPoint();
                        }
                    }
                    ///////////////////////////////////////////////////
                }
                return true;
            }
            throw new \Exception("not an instance of Recipe");
        });
        
        
        /// lets sort them based on freshness points ///////
        usort($recipesWithNonExpiredIngredients,function($first,$second){
            return $first->getFreshness() < $second->getFreshness();
        });
        ////////////////////////////////////////////////////
        
        return $recipesWithNonExpiredIngredients;
    }
}
