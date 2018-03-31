<?php

/**
 * Created by PhpStorm.
 * User: OKORO EFE
 * Date: 2/3/2018
 * Time: 6:25 AM
 */
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
                $data = $this->get(array($field, '=', $id), 'id, name');
                if (count($data)) {
                    return $data;
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        if($name) {
            $data = $this->get(array('name', '=', $name));
            if(count($data)) {
                return $data[0];
            }
        }
        return false;
    }

    public function hasSubCategories($id) {
        $this->_table = 'sub_categories';
        return $this->exists($id,false,'parent');
    }
}