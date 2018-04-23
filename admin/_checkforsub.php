<?php
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