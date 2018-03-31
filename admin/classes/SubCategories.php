<?php

/**
 * Created by PhpStorm.
 * User: OKORO EFE
 * Date: 3/27/2018
 * Time: 5:46 AM
 */
class SubCategories extends Categories
{
    protected $_table = 'sub_categories';

    public function add() {
        $link = $this->save('icon', 'icons');   //save icon pic in icons folder
        $this->create(array(
            'name' => Input::get('name'),
            'parent' => Input::get('parent'),
            'icon' => $link
        ));
        $this->createDir(Input::get('name'),Input::get('parent'));
    }


}