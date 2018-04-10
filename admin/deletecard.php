<?php
if(!empty(escape($Qstring))) {
    try{
        $cardObj->deleteCard($Qstring);
        Session::flash('home', "Card deleted");
        Redirect::to("cards");
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
}
Session::flash('home', "Error deleting card. Try again");
Redirect::to("cards");