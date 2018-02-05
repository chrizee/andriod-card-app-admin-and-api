<?php
	require_once 'includes/content/header.php';
	$db = DB::getInstance();
	$errors = array();
	$pass = true;
	if(Input::exists() && !empty(Input::get('sendEmail'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'subject' => array(
				'required' => true,
				'max' => '100',
				),
			'message' => array(
				'required' => true,
				'min' => '5',
				),
			));
		if(empty(Input::get('recipient')) && empty(Input::get('recipients'))) {
			$errors[] = "Recipient is required";
			$pass = false;
		}
		if($validation->passed() && $pass) {
			try {
				$message = new Message();
				if(!empty(Input::get('recipients'))) {
					$_POST['to'] = "*";
					$message->put();
				} elseif(!empty(Input::get('recipient'))) {
					foreach (Input::get('recipient') as $key => $value) {
						$_POST['location'] = '';		//necessary to prevent location from being available in the put method of the message class
							if(strstr($value,'all')) {
							$_POST['location'] = explode('--',$value)[1];
							$message->put();
						}	else{
							$_POST['to'] = $value;
							$message->put();
						}
					}
				}
				Session::flash('home', 'Message sent');
			} catch (Exception $e) {
				print_r($e->getMessage());
			}
		} else {
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}
		}
	}
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
				if($errors) {
    			foreach ($errors as  $value) {
    				echo "<p class='text text-center'>$value</p>";
    			}
    		}
      ?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>20</h3>

              <p>Total trips</p>
            </div>
            <div class="icon">
              <i class="ion ion-speedometer"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>20<sup style="font-size: 20px">%</sup></h3>

              <p>Trips Initiated from </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>12</h3>

              <p>Total waybill delivered </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">


        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
          <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">
	$(document).ready(function() {

		//The Calender
		$("#calendar").datepicker();
	})
</script>
<?php
	require_once 'includes/content/footer.php';
?>
