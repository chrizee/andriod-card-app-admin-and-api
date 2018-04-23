<?php
require_once 'includes/content/header.php';
$link = $linkObj->get([1, '=', 1]);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>Other app link</small>
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
        <p class="text text-center text-info msg hidden"></p>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Link</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-4 connectedSortable">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Enter Link</h3>
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form role="form" method="post" id="link2" name="link" action="addlink">
                            <?php
                                if(empty($link)) {
                            ?>
                            <input type="hidden" name="new" value="1">
                            <?php } ?>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <div class="input-group" style="width: 100%;">
                                    <input type="text" class="form-control" id="link" name="link" value="<?php echo (!empty($link)) ? $link[0]->link : '' ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="box-footer">
                        <input type="submit" form="link2" class="btn btn-primary" name="linkAdd" value="Send">
                    </div>
                </div>
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require_once 'includes/content/footer.php';
?>
