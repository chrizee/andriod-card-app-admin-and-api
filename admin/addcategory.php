<?php
//require_once 'core/init.php';
if(Input::exists() && !empty(Input::get('category'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'name' => array(
            'required' => true,
            'max' => '50',
        )
    ));
    if(empty($_FILES['icon'])) {
        $validation->addError("No file was uploaded. Make sure you choose a file to upload");
    }
    $validation->checkPic('icon');
    if ($validation->passed()) {
        try {
            if(Input::get('sub') == 1 && !empty(Input::get('parent'))){
                $subCategoryObj->add();
                Session::flash('home', Input::get('name') . " added");
                Redirect::to("dashboard");
            }else {
                $categoryObj->add();
                Session::flash('home', Input::get('name') . " added");
                Redirect::to("dashboard=" . Input::get('name'));
            }
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
//editing category
if(Input::exists() && !empty(Input::get('editCategory'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'name' => array(
            'required' => true,
            'max' => '50',
        )
    ));

    $validation->checkPic2('icon');
    if ($validation->passed()) {
        try {
            if(Input::get('sub') == '1'){
                $subCategoryObj->edit();
                Session::flash('home', "Subcategory updated");
                Redirect::to("subcategory=" . Input::get('id'));
            }else {
                $categoryObj->edit();
                Session::flash('home', "Category updated");
                Redirect::to("dashboard=" . Input::get('name'));
            }
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
Redirect::to("dashboard");