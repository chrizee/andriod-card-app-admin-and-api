<?php

/**
 * Created by PhpStorm.
 * User: OKORO EFE
 * Date: 2/3/2018
 * Time: 9:30 AM
 */
class Card extends Action
{
    protected $_table = "cards";

    public static function getTotal($category = '') {
        if($category) {
            $sql = "SELECT COUNT(*) as total FROM cards WHERE category = ?";
            if (!$data = DB::getInstance()->query($sql, array($category))) {
                throw new Exception("There was a problem getting total record");
            }
            return $data->first()->total;
        }else {
            $sql = "SELECT COUNT(id) as total FROM cards";
            if (!$data = DB::getInstance()->query($sql)) {
                throw new PDOException("There was a problem getting total record");
            }
            return $data->first()->total;
        }
    }

    public function save($pic, $table) {
        if($table) {
            $name = uniqid(). ".jpg";
            $path = "img/".$table."/";
            if($dir = opendir($path)) {			//checks if the dir exist by opening it
                closedir($dir);			//if the dir exist ie opens successfully,close it
            } else {
                $dir = "img/".$table;
                mkdir($dir);				//if the dir doesn't exist create it inside the pic folder
            }
            $filename = $path.$name;
            if(move_uploaded_file($_FILES[$pic]['tmp_name'], $filename)){
                return $filename;
            }
        }
        return false;
    }
}