<?php
require_once 'includes/content/header.php';
$categories = $categoryObj->get(['status', '=', Config::get('status/active')]);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>New Card</small>
        </h1>
        <?php if(Session::exists('home')) {
            echo "<p class='text text-center text-danger'>".Session::flash('home')."</p>";
        }
        if(Session::exists('errors')) {
            $arr = explode("::", Session::flash('errors'));
            foreach ($arr as  $value) {
                echo "<p class='text text-center'>$value</p>";
            }
        }
        ?>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Cards</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if($Qstring) {?>
        <div style="display:inline-block;">
            <button class="btn btn-sm btn-success pull-right new_card">New card <i class="fa fa-link"></i></button>
        </div>
        <?php } ?>
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-4 connectedSortable <?php if($Qstring) echo 'hidden'?> ">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Enter Card Info</h3>
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form role="form" method="post" name="card" id="card" enctype="multipart/form-data" action="addcard">
                            <input type="hidden" name="noOfFiles" value="1"/>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="input-group" style="width: 100%;">
                                    <input type="text" class="form-control" id="name" name="name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select style="text-transform:capitalize;" class="form-control select2" name="category" style="width: 100%;" required>
                                    <option value="">--select--</option>
                                    <?php
                                    foreach ($categories as $value) { ?>
                                        <option value=<?php echo $value->id; ?>><?php echo $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group hidden subcategory">
                                <label for="category">Sub Category (optional)</label>
                                <select style="text-transform:capitalize;" class="form-control select2" name="subcategory" style="width: 100%;" >

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tag &nbsp;</label>
                                <label>
                                    <input type="radio" name="tag" value="<?php echo Config::get('tag/free')?>" checked> Free
                                </label>
                                <label>
                                    <input type="radio" name="tag" value="<?php echo Config::get('tag/paid')?>"> Add Price
                                </label>
                            </div>

                            <div class="form-group price hidden">
                                <label for="price">Price (<?php echo Config::get('app/currency')?>) </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="price" data-inputmask="'alias': 'decimal'" data-mask>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPhoto" >Card</label>
                                <div class="input-group">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Config::get('cards/max_size')?>" />
                                    <input type="file" class="form-control" id="inputPhoto" name="card[]" required multiple>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="box-footer">
                        <input type="submit" form="card" class="btn btn-primary" name="cardCreate" value="Add Card">
                    </div>
                </div>
            </section>
            <!-- /.Left col -->
            <!-- right col -->
            <?php if($Qstring) {?>
            <section class="col-lg-8 connectedSortable">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo escape($Qstring);?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                            $card = $cardObj->get(array('name', '=', $Qstring, 'status', '=', Config::get('status/active')));
                            if(!empty($card)) {
                                $value = $card[0];
                                    ?>
                                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">

                                            <div class="fh5co-property">
                                                <figure style="height:260px;">
                                                    <img src="<?php echo $value->link?>" alt="card" class="img-responsive">
                                                </figure>
                                                <div class="fh5co-property-innter">
                                                    <h3 class="head">Category: <a href="dashboard=<?php echo $categoryObj->getNameFromId($value->category)?>"><?php echo $categoryObj->getNameFromId($value->category) ?></a></h3>
                                                    <?php
                                                        if($value->sub_category != 0) {
                                                            ?>
                                                            <h5 class="head">Sub category:<a
                                                                        href="subcategory=<?php echo $value->sub_category ?>"><?php echo $subCategoryObj->getNameFromId($value->sub_category) ?></a>
                                                            </h5>
                                                            <?php
                                                        }
                                                            ?>
                                                    <div class="price-status">
                                                        <span class="price"><?php echo ($value->price != 0 && $value->tag == Config::get('tag/paid'))? "Price: ".$value->price : "Free";?> </span>
                                                    </div>
                                                </div>
                                                <p class="fh5co-property-specification">
                                                    <span><strong>Created: </strong> <?php $date = new dateTime($value->created_at); echo $date->format('d-M-Y h:i A') ?></span>
                                                </p>
                                            </div>

                                        <button class="btn btn-sm btn-primary pull-right edit">Edit</button>
                                        <a href="deletecard=<?php echo $value->id; ?>"><button class="btn btn-sm btn-danger pull-left deleteCard">Delete</button></a>
                                    </div>
                                    <div class="col-md-8 edit_form hidden">
                                        <h2>Edit <?php echo escape($Qstring);?></h2>
                                        <form role="form" method="post" name="card" id="card" enctype="multipart/form-data" action="addcard">
                                            <input type="hidden" name="id" value="<?php echo $value->id?>">
                                            <input type="hidden" name="oldcategory" value="<?php echo $value->category?>">
                                            <input type="hidden" name="oldsubcategory" value="<?php echo $value->sub_category?>">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $value->name ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select style="text-transform:capitalize;" class="form-control select2" name="category" style="width: 100%;" required>
                                                    <option value="">--select--</option>
                                                    <?php
                                                    foreach ($categories as $value2) { ?>
                                                        <option value="<?php echo $value2->id; ?>" <?php if($value->category == $value2->id) echo "selected"?>><?php echo $value2->name; ?></option>
                                                    <?php } ?>
                                                   <!-- <option value="new">new category</option>-->
                                                </select>
                                            </div>

                                            <div class="form-group <?php echo ($value->sub_category == 0) ? 'hidden': ''; ?> subcategory">
                                                <label for="subcategory">Sub Category (optional)</label>
                                                <select style="text-transform:capitalize;" class="form-control select2" name="subcategory" style="width: 100%;" >
                                                    <?php
                                                        if($value->sub_category != 0 && ($subcategory = $categoryObj->hasSubCategories($value->category))) {
                                                            echo "<option value=''>--select--</option>";
                                                            foreach ($subcategory as $subcat) {
                                                                print_r($subcategory);
                                                    ?>
                                                                <option value="<?php echo $subcat->id ?>" <?php if($value->sub_category == $subcat->id) echo "selected=selected" ?>><?php echo $subcat->name ?></option>
                                                            <?php }}?>

                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Tag &nbsp;</label>
                                                <label>
                                                    <input type="radio" name="tag2" value="<?php echo Config::get('tag/free')?>" <?php if($value->tag == Config::get('tag/free')) echo "checked"?>> Free
                                                </label>
                                                <label>
                                                    <input type="radio" name="tag2" value="<?php echo Config::get('tag/paid')?>" <?php if($value->tag == Config::get('tag/paid')) echo "checked"?>> Paid
                                                </label>
                                            </div>

                                            <div class="form-group price2 hidden">
                                                <label for="price">Price</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="<?php echo $value->price ?>" name="price2" data-inputmask="'alias': 'decimal'" data-mask>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPhoto" >Card</label>

                                                <div class="input-group">
                                                    <input type="hidden" name="previousCard" value="<?php echo $value->link;?>" />
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Config::get('cards/max_size')?>" />
                                                    <input type="file" class="form-control" id="inputPhoto" name="card">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                    <input type="submit" class="btn btn-sm btn-warning pull-right" name="cardEdit" value="Update">
                                            </div>

                                        </form>
                                    </div>
                            <?php }  else { ?>
                            <p class="text-center">Select a valid card.</p>
                        <?php }?>
                    </div>
                    <!-- /. box -->
                </div>
            </section>
            <!-- right col -->
            <?php }?>
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function() {
        $('div.input-group').css("width", "100%");
        $(document).on('change', "select[name=category]", function(e) {
            if($("select[name=category]").val() == "new") {
                $('div.new_category').removeClass('hidden').slideDown('slow');
                $('input[name=cat_name]').attr('required', 'required');
            }else {
                var $id = $(this).val();
                $.post('_checkforsub', {id: $id}, function($result) {

                  if($result != 'X'){
                      $sub = JSON.parse($result);
                      $('div.subcategory').removeClass('hidden');
                      $('select[name=subcategory]').html('');
                      $('select[name=subcategory]').append("<option value=''>--select--</option>")
                      $($sub).each(function(index,value) {
                          $('select[name=subcategory').append("<option value='"+value.id+"'>"+value.name+"</option>")
                      });
                  }else{
                      $('div.subcategory').addClass('hidden');
                      $('select[name=subcategory]').html('');
                  }
                });
                $('div.new_category').addClass('hidden');
                $('input[name=cat_name]').removeAttr('required');
            }
        }).on('change', "select[name=subcategory]", function(e) {
            if($(this).val() == "new") {
                $('div.new_sub_category').removeClass('hidden');
                $('input[name=sub_cat_name]').attr('required', 'required');
            }else {
                $('div.new_sub_category').addClass('hidden');
                $('input[name=sub_cat_name').removeAttr('required');
            }
        }).on('click',"input[name=tag]", function(e) {
            if($("input[name=tag]").filter(':checked').val() == "<?php echo Config::get('tag/paid')?>" ) {
                $('div.price').removeClass('hidden').slideDown('slow');
                $('input[name=price]').attr('required', 'required');
            }else {
                $('div.price').addClass('hidden');
                $('input[name=price]').removeAttr('required');
            }
        }).on('click', 'button.new_card', function(e) {
            $('section.col-lg-4').removeClass('hidden');
            $('section.col-lg-8').addClass('hidden');
        }).on('click', "button.edit", function(e) {
            $('div.edit_form').removeClass('hidden').slideDown('slow');
        }).on('click',"input[name=tag2]", function(e) {
            if ($("input[name=tag2]").filter(':checked').val() == "<?php echo Config::get('tag/paid')?>") {
                $('div.price2').removeClass('hidden').slideDown('slow');
                $('input[name=price2]').attr('required', 'required');
            } else {
                $('div.price2').addClass('hidden');
                $('input[name=price2]').removeAttr('required');
            }
        }).on('click', "button.deleteCard", function(e) {
            $ans = confirm("Are you sure you want to delete this card");
            if($ans) {
                $location = $(this).parent('a').attr('href');
                //window.location.href = $location;
            }else {
                e.preventDefault();
            }
        })
    })
</script>
<?php
require_once 'includes/content/footer.php';
?>
