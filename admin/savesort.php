<?php
if(!empty(Input::get('categories'))) {
    $cat = explode("&", Input::get('categories'));
    foreach ($cat as $key => $value) {
     $pos =  explode('=', $value);
     $arr[] = $pos[1];
    }
    if(Input::get('sub')) {
        if($subCategoryObj->sort($arr)) {
            echo 1;
        }else {
            echo 'X';
        }
    }else {
        if ($categoryObj->sort($arr)) {
            echo 1;
        } else {
            echo 'X';
        }
    }
}else {
    echo "X";
}