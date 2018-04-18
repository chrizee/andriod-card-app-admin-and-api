<?php
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

    public function deleteCard($id) {
        $this->update(escape($id), array(
            'status' => Config::get('status/deleted')
        ));
        if($this->delete) {
            $card = $this->get(['id', '=', escape($id)]);
            unlink($card[0]->link);
        }
    }
}