<?php
//require_once 'core/init.php';
//adding new card
if(Input::exists() && !empty(Input::get('cardCreate'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'name' => array(
            'max' => '200',
        ),
    ));

    for ($i = 0; $i < count($_FILES); $i++) {
        $key = "card".$i;
        if (empty($_FILES[$key]['name'])) {
            $validation->errors[] = "No file was uploaded. Make sure you choose a file to upload";
        }else {
            print_r($_FILES[$key]);
            $validation->checkPic($key);
        }
    }

    if ($validation->passed()) {
        try {
            $subcategory = (!empty(Input::get('subcategory'))) ? Input::get('subcategory') : '';
            $table = (!empty($subcategory)) ? $categoryObj->getNameFromId(Input::get('category')).'/'.$subCategoryObj->getNameFromId($subcategory): $categoryObj->getNameFromId(Input::get('category')) ;
            $price = (!empty(Input::get('price'))) ? Input::get('price'): '';
            for ($i = 0; $i < count($_FILES); $i++) {
                $key = "card".$i;
                $name = (!empty(Input::get('name'))) ? Input::get('name').$i : uniqid('card_');
                if($link = $cardObj->save($key,$table)) {
                    $cardObj->create(array(
                        'name' => $name,
                        'category' => Input::get('category'),
                        'sub_category' => $subcategory,
                        'tag' => Input::get('tag'),
                        'price' => $price,
                        'link' => $link,
                    ));
                }
            }
                Session::flash('home', Input::get('name')." added");
                Redirect::to("cards=".Input::get('name'));
                //Session::flash('home', "Cannot move card to specified folder. Please select the correct category");
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

//editing existing card

if(Input::exists() && !empty(Input::get('cardEdit'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'name' => array(
            'max' => '200',
        ),
    ));
    if(!empty($_FILES['card']['name'])) {
        //Routes::$errors[] = print_r($_FILES['card']);
        $validation->checkPic('card');
    }

    if ($validation->passed()) {
        try {
            //create new category if field is present
            $id = '';
            if(!empty(Input::get('cat_name'))) {
                $categoryObj->add(Input::get('cat_name'));
                $id = $categoryObj->lastId();
            }
            $category = (!empty($id) && Input::get('category') != 'new') ? $id : Input::get('category');
            $subcategory = (!empty(Input::get('subcategory'))) ? Input::get('subcategory') : '';
            if(Input::get('oldcategory') != Input::get('category') && Input::get('oldsubcategory') == Input::get('subcategory')) {
                $subcategory = '';
            }
            $price = (!empty(Input::get('price2'))) ? Input::get('price2') : '';
            if(!empty($_FILES['card']['name'])) {
                if ($link = $cardObj->save('card', $categoryObj->getNameFromId($category))) {
                    $name = (!empty(Input::get('name'))) ? Input::get('name') : uniqid('card_');
                    $cardObj->update(Input::get('id'), array(
                        'name' => $name,
                        'category' => $category,
                        'sub_category' => $subcategory,
                        'tag' => Input::get('tag2'),
                        'price' => $price,
                        'link' => $link,
                    ));
                    unlink(Input::get('previousCard'));     //delete old card if new one is provided
                    Session::flash('home', Input::get('name') . " updated");
                    Redirect::to("cards=" . Input::get('name'));
                }
            } else {
                $cardObj->update(Input::get('id'), array(
                    'name' => Input::get('name'),
                    'category' => $category,
                    'sub_category' => $subcategory,
                    'tag' => Input::get('tag2'),
                    'price' => $price,
                ));
                Session::flash('home', Input::get('name') . " updated");
                Redirect::to("cards=" . Input::get('name'));
            }
            Session::flash('home', "Cannot move card to specified folder. Please select the correct category");
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    } else {
        foreach ($validation->errors() as $key => $error) {
            Routes::$errors[] = $error;
        }
        Session::flash('errors', implode("::", Routes::$errors));
        Redirect::to("cards=" . Input::get('name'));
    }
}
if(empty(Input::get('cardCreate')) && empty(Input::get('cardEdit'))) {
    Session::flash('home', "Provide the required information correctly");
    Redirect::to("cards");
}
Redirect::to("cards");