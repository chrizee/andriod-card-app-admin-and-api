<?php
if(!empty(escape($Qstring))) {
    try{
        $subCategoryObj->deleteSubCategory(escape($Qstring));
        Session::flash('home', "Sub category deleted");
        Redirect::to("dashboard");
    } catch (Exception $e) {
        print_r($e->getMessage());
    }
}
Session::flash('home', "Error deleting sub category. Try again");
Redirect::to("dashboard");