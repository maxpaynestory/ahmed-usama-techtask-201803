<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace RecipeApp\ValueObjects;
/**
 * Description of Ingredient
 *
 * @author Usama Ahmed Khan
 */
class Ingredient {

    /**
     * @var array
     */
    private $items;
    private $title;

    function __construct($title, Array $items) {
        
        $this->title = $title;
        $this->items = $items;
    }
}
