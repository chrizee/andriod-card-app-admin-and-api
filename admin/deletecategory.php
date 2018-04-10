<?php
if(!empty(escape($Qstring))) {
    try{
        $categoryObj->deleteCategory(escape($Qstring));
        Session::flash('home', "Category deleted");
        Redirect::to("dashboard");
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
}
Session::flash('home', "Error deleting category. Try again");
Redirect::to("dashboard");