<?php

use PHPUnit\Framework\TestCase;
use RecipeApp\Usecases\GetRecipes;
use RecipeApp\ValueObjects\Ingredient;
use RecipeApp\ValueObjects\Recipe;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetRecipesTest
 *
 * @author Usama Ahmed Khan
 */
class GetRecipesTest extends TestCase {
    
    private $usecase;
    
    protected function setUp() {
        $this->usecase = new GetRecipes();
        parent::setUp();
    }

    protected function tearDown() {
        unset($this->usecase);
        parent::tearDown();
    }

    
    function testInstance(){
        $this->assertInstanceOf(GetRecipes::class, new GetRecipes());
    }
    
    /**
     * @expectedException \Exception
     */
    function testExecuteWithException(){
        $ingredients = ["wierdthing",""];
        $this->usecase->execute($ingredients, []);
    }
    
    /**
     * @expectedException \Exception
     */
    function testExecuteWithException2(){
        $recipes = ["wierdthing",""];
        $this->usecase->execute([], $recipes);
    }
    
    function testExecute()
    {
        $ingredients = [
            new Ingredient("Ingredient 1",date("Y-m-d", strtotime('+3 day')),date("Y-m-d", strtotime('+10 day'))),
            new Ingredient("Ingredient 2",date("Y-m-d", strtotime('+1 day')),date("Y-m-d", strtotime('+12 day'))),
            new Ingredient("Expired Ingredient",date("Y-m-d", strtotime('-5 day')),date("Y-m-d", strtotime('-1 day'))),
        ];
        
        $recipes = [
            new Recipe("Some recipe", [
                'Ingredient 1',
                'Ingredient 2'
            ])
        ];
        
        $this->assertEquals($recipes, $this->usecase->execute($ingredients, $recipes));
        
        $recipesexpired = [
            new Recipe("Some recipe", [
                'Ingredient 1',
                'Expired Ingredient'
            ])
        ];
        
        $this->assertEquals($recipes, $this->usecase->execute($ingredients, array_merge($recipesexpired,$recipes)));
    }
}
