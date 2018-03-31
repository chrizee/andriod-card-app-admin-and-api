<?php
require_once 'includes/content/header.php';
$categories = $categoryObj->get(['status', '=', Config::get('status/active')]);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>Control panel</small>
        </h1>
        <?php if(Session::exists('home')) {
            echo "<p class='text text-center'>".Session::flash('home')."</p>";
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
            <li class="active">Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <button class="btn btn-primary btn-block margin-bottom add_new">Add new category</button>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li <?php if(!$Qstring) echo "class=\"active\""?>><a href="dashboard">All
                                    <span class="label label-primary pull-right"><?php echo Card::getTotal(); ?></span></a>
                            </li>
                            <?php if(!empty($categories)) {
                                foreach ($categories as $key => $value) { ?>
                                    <li <?php if(html_entity_decode($Qstring) == $value->name) echo "class=\"active\""?>><a href="dashboard=<?php echo htmlentities($value->name);?>"><i class="fa fa-inbox"></i> <?php echo ucfirst($value->name)?>
                                            <span class="label label-primary pull-right"><?php echo Card::getTotal($value->id); ?></span></a></li>
                                    </li>

                                    <?php }} else{ ?>
                                <li><a href="#" ><i class="fa fa-exclamation"></i>No category</a></li>
                            <?php }?>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
            <?php if(!empty($Qstring)) { ?>
                <div class="col-md-9 default">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo escape($Qstring);?></h3>
                            <a href="cards"><button class="pull-right btn btn-sm btn-success"><i class="fa fa-plus"></i> Add card</button></a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php
                            if(($category = $categoryObj->getIdFromName($Qstring)) || ($category = $subCategoryObj->getIdFromName($Qstring))) {
                                $card = $cardObj->get(array('category', '=', $category, 'status', '=', Config::get('status/active')));
                                $cat = $categoryObj->get(['name', '=', $Qstring]); //check for category using name not to conflict with sub category
                                $folder = "category";
                                if(empty($card) || empty($cat)) {   //first time it shud be or
                                    $card = $cardObj->get(array('sub_category', '=', $category, 'status', '=', Config::get('status/active')));
                                    $cat = $subCategoryObj->get(['id', '=', $category]);
                                    //print_r($cat);
                                    $folder = "sub category";
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="text text-center text-success"><?php echo ucwords($folder) ?> Icon</h4>
                                        <figure style="height:260px;">
                                            <img src="<?php echo $cat[0]->icon ?>" alt="icon" class="img-responsive">
                                        </figure>
                                    </div>
                                </div>
                                <?php if(!empty($card)) {
                                    foreach ($card as $key => $value) {
                                        ?>
                                        <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                                            <a href="cards=<?php echo $value->name ?>">
                                                <div class="fh5co-property">
                                                    <figure style="height:260px;">
                                                        <img src="<?php echo $value->link?>" alt="card" class="img-responsive">
                                                    </figure>
                                                    <div class="fh5co-property-innter" style="min-height: 132px;">
                                                        <h3 class="head"><span style="color:black;">Name: </span><a href="cards=<?php echo $value->name?>"><?php echo $value->name ?></a></h3>
                                                        <?php
                                                        if($value->sub_category != 0) {
                                                            ?>
                                                            <h5 class="head">Sub category: <a
                                                                        href="dashboard=<?php echo $subCategoryObj->getNameFromId($value->sub_category) ?>"><?php echo $subCategoryObj->getNameFromId($value->sub_category) ?></a>
                                                            </h5>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="price-status">
                                                            <span class="price"><?php echo ($value->price != 0 && $value->tag == Config::get('tag/paid'))? "Price: ".$value->price : "Free";?> </span>
                                                        </div>
                                                        <p class="fh5co-property-specification">
                                                            <span><strong>Created: </strong> <?php $date = new dateTime($value->created_at); echo $date->format('d-M-Y h:i A') ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php }} else { ?>
                                    <p class="text-center">No card in this <?php echo $folder ?>.</p>
                                <?php } } else { ?>
                                <p class="text-center">Select a valid category.</p>
                            <?php }?>
                        </div>
                        <!-- /. box -->
                    </div>
                </div>
                <!-- /.col -->
            <?php }else {?>
                <div class="col-md-9 default">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Cards</h3>
                            <a href="cards"><button class="pull-right btn btn-sm btn-success"><i class="fa fa-plus"></i> Add card</button></a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php
                            $card = $cardObj->get(['status', '=', Config::get('status/active')]);
                            if(!empty($card)) {
                                foreach ($card as $key => $value) {
                                    ?>
                                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                                        <a href="cards=<?php echo $value->name ?>">
                                            <div class="fh5co-property">
                                                <figure style="height:260px;">
                                                    <img src="<?php echo $value->link?>" alt="card" class="img-responsive">
                                                </figure>
                                                <div class="fh5co-property-innter" style="min-height: 132px;">
                                                    <h3 class="head">Name: <a href="cards=<?php echo $value->name ?>"><?php echo $value->name ?></a></h3>
                                                    <p>Category: <a href="dashboard=<?php echo $categoryObj->getNameFromId($value->category)?>"> <?php echo $categoryObj->getNameFromId($value->category)?></a></p>
                                                    <?php
                                                    if($value->sub_category != 0) {
                                                        ?>
                                                        <h5 class="head">Sub category: <a
                                                                    href="dashboard=<?php echo $subCategoryObj->getNameFromId($value->sub_category) ?>"><?php echo $subCategoryObj->getNameFromId($value->sub_category) ?></a>
                                                        </h5>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="price-status">
                                                        <span class="price"><?php echo ($value->price != 0 && $value->tag == Config::get('tag/paid'))? "Price: ".$value->price : "Free";?> </span>
                                                    </div>
                                                    <p class="fh5co-property-specification">
                                                        <span><strong>Created: </strong> <?php $date = new dateTime($value->created_at); echo $date->format('d-M-Y h:i A') ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php }} else { ?>
                                <p class="text-center">No card.</p>
                            <?php }  ?>
                        </div>
                        <!-- /. box -->
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-5 create hidden">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">New category</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" class="" method="post" action="addcategory" id="create" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name of category</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo escape(Input::get('name'))?>" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sub">Sub Category</label>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="sub" value="0" checked>No
                                    </label>
                                    <label>
                                        <input type="radio" name="sub" value="1">Yes
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mainCat hidden">
                                <label for="category">Main Category</label>
                                <div class="input-group">
                                    <select style="text-transform:capitalize;" class="form-control select2" name="parent" style="width: 100%;">
                                        <option value="">--select--</option>
                                        <?php
                                        foreach ($categories as $value2) { ?>
                                            <option value="<?php echo $value2->id; ?>"><?php echo $value2->name; ?></option>
                                        <?php } ?>
                                        <!-- <option value="new">new category</option>-->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPhoto" >Category icon</label>

                                <div class="input-group">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Config::get('cards/max_size')?>" />
                                    <input type="file" class="form-control" id="inputPhoto" name="icon" required>

                                </div>
                            </div>
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" name="category" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', "button.add_new", function() {
            $('div.create').removeClass('hidden');
            $('div.default').addClass('hidden');
        }).on('click', 'input[name=sub]', function(e) {
            if($(this).val() == '1') {
                $('div.mainCat').removeClass('hidden').slideDown('slow');
                $('select[name=category]').attr('required','required');
            }else{
                $(this).value = 0;
                $('div.mainCat').slideUp('slow');
                $('select[name=category]').removeAttr('required');
            }
        })

    })
</script>
<?php
require_once 'includes/content/footer.php';
?>
