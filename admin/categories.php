<?php
require_once 'includes/content/header.php';
$categories = $categoryObj->get();
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
                                <li <?php if(!$Qstring) echo "class=\"active\""?>><a href="categories">All
                                        <span class="label label-primary pull-right"><?php echo Card::getTotal(); ?></span></a>
                                </li>
                                <?php if(!empty($categories)) {
                                    foreach ($categories as $key => $value) { ?>
                                <li <?php if(html_entity_decode($Qstring) == $value->name) echo "class=\"active\""?>><a href="categories=<?php echo htmlentities($value->name);?>"><i class="fa fa-inbox"></i> <?php echo ucfirst($value->name)?>
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
                            if($category = $categoryObj->getIdFromName($Qstring)) {
                            $card = $cardObj->get(array('category', '=', $category));
                            if(!empty($card)) {
                                foreach ($card as $key => $value) {
                            ?>
                                    <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                                        <a href="cards=<?php echo $value->name ?>">
                                            <div class="fh5co-property">
                                                <figure style="height:260px;">
                                                    <img src="<?php echo $value->link?>" alt="card" class="img-responsive">
                                                </figure>
                                                <div class="fh5co-property-innter">
                                                    <h3 class="head"><a href="cards=<?php echo $value->name?>"><?php echo $value->name ?></a></h3>
                                                    <div class="price-status">
                                                        <span class="price"><?php echo ($value->price != 0 && $value->tag == Config::get('tag/paid'))? "Price: ".$value->price : "Free";?> </span>
                                                    </div>
                                                </div>
                                                <p class="fh5co-property-specification">
                                                    <span><strong>Created: </strong> <?php $date = new dateTime($value->created_at); echo $date->format('d-M-Y h:i A') ?></span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                        <?php }} else { ?>
                            <p class="text-center">No card in this category.</p>
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
                                <h3 class="box-title">All Categories</h3>
                                <a href="cards"><button class="pull-right btn btn-sm btn-success"><i class="fa fa-plus"></i> Add card</button></a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                    $card = $cardObj->get();
                                    if(!empty($card)) {
                                        foreach ($card as $key => $value) {
                                        ?>
                                            <div class="col-md-4 item-block animate-box" data-animate-effect="fadeIn">
                                                <a href="cards=<?php echo $value->name ?>">
                                                    <div class="fh5co-property">
                                                        <figure style="height:260px;">
                                                            <img src="<?php echo $value->link?>" alt="card" class="img-responsive">
                                                        </figure>
                                                        <div class="fh5co-property-innter">
                                                            <h3 class="head"><a href="cards=<?php echo $value->name ?>"><?php echo $value->name ?></a></h3>
                                                            <p>Category: <a href="categories=<?php echo $categoryObj->getNameFromId($value->category)?>"> <?php echo $categoryObj->getNameFromId($value->category)?></a></p>
                                                            <div class="price-status">
                                                                <span class="price"><?php echo ($value->price != 0 && $value->tag == Config::get('tag/paid'))? "Price: ".$value->price : "Free";?> </span>
                                                            </div>
                                                        </div>
                                                        <p class="fh5co-property-specification">
                                                            <span><strong>Created: </strong> <?php $date = new dateTime($value->created_at); echo $date->format('d-M-Y h:i A') ?></span>
                                                        </p>
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
                                <form role="form" class="" method="post" action="addcategory" id="create">
                                        <div class="form-group">
                                            <label for="name">Name of category</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo escape(Input::get('name'))?>" required>

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
            })
        })
    </script>
<?php
require_once 'includes/content/footer.php';
?>
