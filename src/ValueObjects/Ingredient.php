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

    protected $useBy;
    protected $bestBefore;

    protected $title;

    /**
     * @param string $title Title of ingredient
     * @param string $bestBefore best before date
     * @param string $useBy expiry date
     */
    function __construct($title, $bestBefore, $useBy) {
        
        $this->title = $title;
        $this->bestBefore = $bestBefore;
        $this->useBy = $useBy;
    }
}
