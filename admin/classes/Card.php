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
            $sql = "SELECT COUNT(*) as total FROM cards WHERE category = ? AND status =". Config::get('status/active');
            if (!$data = DB::getInstance()->query($sql, array($category))) {
                throw new PDOException("There was a problem getting total record");
            }
            return $data->first()->total;
        }else {
            $sql = "SELECT COUNT(id) as total FROM cards WHERE status =". Config::get('status/active');
            if (!$data = DB::getInstance()->query($sql)) {
                throw new PDOException("There was a problem getting total record");
            }
            return $data->first()->total;
        }
    }

}