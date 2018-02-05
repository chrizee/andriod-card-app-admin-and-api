<?php
require_once 'core/init.php';
if(Input::exists() && !empty(Input::get('category'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'name' => array(
            'required' => true,
            'max' => '50',
        )
    ));

    if ($validation->passed()) {
        try {
            $categoryObj->add(Input::get('name'));
            Session::flash('home', Input::get('name')." added");
            Redirect::to("categories=".Input::get('name'));
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    } else {
        foreach ($validation->errors() as $key => $error) {
            Routes::$errors[] = $error;
        }
        Session::flash('errors', implode("::", Routes::$errors));
    }
}else {
    Session::flash('home', "Provide the required information correctly.");
}
Redirect::to("categories");