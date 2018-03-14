<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RecipeApp\ValueObjects;

/**
 * Description of Recipe
 *
 * @author Usama Ahmed Khan
 */
class Recipe {

    /**
     * @var array
     */
    protected $ingredientTitles;
    protected $title;
    protected $freshness;
    
    function __construct($title, Array $ingredientTitles) {
        
        $this->title = $title;
        $this->ingredientTitles = $ingredientTitles;
        $this->freshness = 0;
    }

    public function getIngredients() {
        return $this->ingredientTitles;
    }
    
    public function addFreshPoint() {
        $this->freshness += 1;
    }
    
    function getTitle() {
        return $this->title;
    }
    function getFreshness() {
        return $this->freshness;
    }


}
