<?php

use PHPUnit\Framework\TestCase;
use RecipeApp\ValueObjects\Ingredient;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IngredientTest
 *
 * @author Usama Ahmed Khan
 */
class IngredientTest extends TestCase{
    function testInstance()
    {
        $ingredient = new Ingredient('Some Title for ingredient','2018-03-25','2018-03-27');
        $this->assertInstanceOf(Ingredient::class, $ingredient);
    }
    
    /**
     * @expectedException \Exception
     */
    function testInvalidBestBefore()
    {
        new Ingredient('Some Title for ingredient','asdad','2018-03-27');
    }
    
    /**
     * @expectedException \Exception
     */
    function testInvalidUseBy()
    {
        new Ingredient('Some Title for ingredient','2018-03-25','20-03-2018');
    }
}
