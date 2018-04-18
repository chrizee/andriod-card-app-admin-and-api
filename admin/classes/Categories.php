<?php

class Categories extends Action
{
    protected $_table = "categories";

    public function getIdFromName($name) {
        $id = $this->get(array('name', '=', $name), "id");
        if ($id) {
            return $id[0]->id;
        }
        return false;
    }

    public function getNameFromId($id) {
        $name = $this->get(array('id', '=', $id), "name");
        if ($name) {
            return $name[0]->name;
        }
        return false;
    }

    protected function createDir($name,$parent = false) {
        if($name) {
            $path = "img/" . $name . "/";        //specifies the path
            if($parent) {
                $this->_table = "categories";
                $path = "img/".trim($this->getNameFromId($parent))."/".$name."/";
            }
            if ($dir = @opendir($path)) {            //checks if the dir exist by opening it
                closedir($dir);            //if the dir exist ie opens successfully,close it
            } else {
                $dir = "img/" . $name;
                if($parent) $dir = rtrim($path, '/');
                mkdir($dir);                //if the dir doesn't exist create it inside the pic folder
            }

        }
    }

    public function add() {
        $link = $this->save('icon', 'icons');
        $this->create(array(
            'name' => Input::get('name'),
            'icon' => $link,
        ));
        $this->createDir(Input::get('name'));
    }

    public function exists($id, $name = false, $field = 'id') {
        if($id) {
            try {
                $data = $this->get(array($field, '=', $id, 'status', '=', Config::get('status/active')), 'id, name');
                if (count($data)) {
                    return $data;
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        if($name) {
            $data = $this->get(array('name', '=', $name, 'status', '=', Config::get('status/active')));
            if(count($data)) {
                return $data[0];
            }
        }
        return false;
    }

    public function hasSubCategories($id) {
        $this->_table = 'sub_categories';
        $subData = $this->exists($id,false,'parent');
        $this->_table = 'categories';
        return $subData;
    }

    public function deleteCategory($id) {
        $this->update(escape($id), array(
            'status' => Config::get('status/deleted')
        ));
        $category = $this->get(['id', '=', escape($id)]);
        $subCategoryObj = new SubCategories();
        $cardObj = new Card();
        $subCategory = $subCategoryObj->get(['parent', '=', $category[0]->id]);
        $cards = $cardObj->get(['category', '=', $category[0]->id, 'sub_category', '=', Config::get('status/deleted')]);
        //rmdir("img/".$this->getNameFromId($id));
        if($cards) {
            foreach ($cards as $key => $value) {
                $cardObj->deleteCard($value->id);
            }
        }

        if($subCategory) {
            foreach ($subCategory as $key => $value) {
                $subCategoryObj->deleteSubCategory($value->id);
            }
        }
        if($this->delete) {
            @unlink($category[0]->icon);
        }
    }

    public function edit() {
        try {
            if (!empty($_FILES['icon']['name'])) {
                $link = $this->save('icon', 'icons');
                $oldPic = $this->get(['id', '=', Input::get('id')])[0]->icon;
                $this->update(Input::get('id'), array(
                    'name' => Input::get('name'),
                    'icon' => $link,
                ));
                if ($this->delete) {
                    @unlink($oldPic);
                }
            } else {
                $this->update(Input::get('id'), array(
                    'name' => Input::get('name')
                ));
            }
            $this->createDir(Input::get('name'));
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}