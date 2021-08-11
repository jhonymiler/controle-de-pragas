<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vistoria
 *
 * @author Jonatas
 */
class vistoria {
    private $registro;
    
    public function __construct() {
        $args = func_get_args();
        
        switch ($args) {
            case func_num_args() == 1 && is_numeric($args):


                break;

            default:
                break;
        }
    }
    
    
    public function getById(int $id){
        
    }
    
}


