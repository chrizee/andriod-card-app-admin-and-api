<?php

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

    public function deleteSubCategory($id) {
        $this->update($id, array(
            'status' => Config::get('status/deleted')
        ));
        $subCategory = $this->get(['id', '=', escape($id)]);
        $cardObj = new Card();
        $cards = $cardObj->get(['sub_category', '=', $subCategory[0]->id]);
        if($cards) {
            foreach ($cards as $key => $value) {
                $cardObj->deleteCard($value->id);
            }
        }
        if($this->delete) {
            @unlink($subCategory[0]->icon);
        }
    }
}