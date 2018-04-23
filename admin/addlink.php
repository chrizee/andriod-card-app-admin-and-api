<?php
if(Input::exists() && !empty(Input::get('linkAdd'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'link' => array(
            'max' => '200',
        ),
    ));

    if ($validation->passed()) {
        try {
            if(@Input::get('new')) {
                $linkObj->create([
                    'link' => Input::get('link')
                ]);
            }else{
                $linkObj->update(1,[
                    'link' => Input::get('link')
                ]);
            }
            Session::flash('home', "Link updated");
            Redirect::to("other_app_link");
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    } else {
        foreach ($validation->errors() as $key => $error) {
            Routes::$errors[] = $error;
        }
        Session::flash('errors', implode("::", Routes::$errors));
    }
}
Redirect::to("other_app_link");