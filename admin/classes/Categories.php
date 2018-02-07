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

    private function createDir($name) {
        if($name) {
            $path = "img/".$name."/";		//specifies the path
            if($dir = opendir($path)) {			//checks if the dir exist by opening it
                closedir($dir);			//if the dir exist ie opens successfully,close it
            } else {
                $dir = "img/".$name;
                mkdir($dir);				//if the dir doesn't exist create it inside the pic folder
            }

        }
        return false;
    }

    public function add($name) {
        $link = $this->save('icon', 'icons');
        $this->create(array(
            'name' => ($name),
            'icon' => $link,
        ));
        $this->createDir($name);
    }

    public function exists($id, $name = false) {
        if($id) {
            $data = $this->get(array('id', '=', $id));
            if(count($data)) {
                return $data[0];
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
}