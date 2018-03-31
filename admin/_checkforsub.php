<?php
/**
 * Created by PhpStorm.
 * User: OKORO EFE
 * Date: 3/30/2018
 * Time: 4:58 AM
 */
if(!empty(Input::get('id'))) {
    //var_dump($categoryObj->hasSubCategories(Input::get('id')));
    if($subCategories = $categoryObj->hasSubCategories(Input::get('id'))) {
        echo json_encode($subCategories);
    }else{
        echo "X";
    }
}else {
    echo "X";
}