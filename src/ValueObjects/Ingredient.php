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
        $this->setBestBefore($bestBefore);
        $this->setUseBy($useBy);
    }
    
    private function setUseBy($useBy) {
        if (\DateTime::createFromFormat('Y-m-d', $useBy) === FALSE) {
            throw new \Exception('useBy date is not valid');
        }
        $this->useBy = $useBy;
    }

    private function setBestBefore($bestBefore) {
        if (\DateTime::createFromFormat('Y-m-d', $bestBefore) === FALSE) {
            throw new \Exception('useBy date is not valid');
        }
        $this->bestBefore = $bestBefore;
    }
    
    /**
     * @return bool If ingredient has not expired function will return true otherwise false
     */
    public function hasNotExpired() {
        $exp_date = strtotime($this->useBy . " 23:59:00");
        return time() < $exp_date;
    }
    
    public function bestToEat(){
        $exp_date = strtotime($this->bestBefore . " 23:59:00");
        return $exp_date > time();
    }

    public function getTitle() {
        return $this->title;
    }

}
