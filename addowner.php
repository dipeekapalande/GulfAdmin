<?php
ob_start();
	include_once('config\config.php');
	include_once('inc\header.php');
	include_once('inc\aside.php');
	
	
	if(isset($_POST['submit'])){
	
	  $first_name=$_POST['first_name'];
	   $last_name=$_POST['last_name'];
	    $email=$_POST['email'];
		 $mobile=$_POST['mobile'];
		  $language=$_POST['language'];
		   $gender=$_POST['gender'];
		    $date_of_joining=$_POST['date_of_joining'];
			
			$d=new MongoDB\BSON\UTCDateTime((new DateTime($date_of_joining))->getTimestamp()*1000);
      $owner_status  = $_POST['owner_status'];
	  if($owner_status==1)
	  {
		  $s=true;
	  }
	  else
	  {
		  $s=false;
	  }
	  $address=$_POST['address'];
	 
     

	  

      if(!$owner_status){
  
        $flag = 5;

      }else{
         
           $insRec       = new MongoDB\Driver\BulkWrite;

           $insRec->insert(['first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'mobile'=>$mobile,'language'=>$language,'gender'=>$gender,'date_of_joining'=>$d,'owner_status' =>$s,'address'=>$address]);
          
           $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
         
             $result       = $connection->executeBulkWrite('gulf_racing.owners', $insRec, $writeConcern);

          if($result->getInsertedCount()){

            $flag = 3;

          }else{

            $flag = 2;

          }
		   
		  
      }
	  //echo $flag;
	 // die();
	header("Location: owner.php?flag=$flag");

    exit;

	
  

  }
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Sub Admin
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
              <!--<h3 class="box-title">Data Table With Full Features</h3>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
				
				<form enctype="multipart/form-data" method="POST">
                    <div class="form-group">
							<input type="hidden" class="form-control" id="uid" name="id" value="<?php echo $row->_id;?>"/>
						<div class="col-sm-6">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" id="first_name" name="first_name" value="<?php if (!empty($row->first_name)) { echo $row->first_name;} else { echo "";}?>"  onkeypress="return (event.charCode > 64 && 
	event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" placeholder="Enter First Name" required />
						</div>
						<div class="col-sm-6">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" id="last_name" name="last_name" value="<?php if (!empty($row->last_name)) { echo $row->last_name;} else { echo "";}?>" onkeypress="return (event.charCode > 64 && 
	event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" placeholder="Enter Last Name" required />
						</div>
						<div class="col-sm-6">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php if (!empty($row->email_id)) { echo $row->email_id;} else { echo "";}?>"  placeholder="Enter Email Id" onblur="checkduplicateemailoftheuser(this)" required/>
						</div>
						<div class="col-sm-6">
							<label for="mobile">Mobile</label>
							<input type="text" class="form-control" id="mobile" name="mobile" value="<?php if (!empty($row->phone)) { echo $row->phone;} else { echo "";}?>" pattern="[789][0-9]{9}"  onkeypress="return onlyNumberKey(event)" placeholder="Enter Mobile Number" required />
						</div>
						
						<div class="col-sm-6" style="margin:2% 0;">
							<label for="language">Language</label>
							
							<input type="radio" name="language" value="English" checked> English
							<input type="radio" name="language" value="Arabic" > Arabic
							
							<!--<input type="text" class="form-control" id="language" name="language" value="<?php if (!empty($row->language)) { echo $row->language;} else { echo "";}?>"  required />-->
						</div>
						
						<div class="col-sm-6" style="margin:2% 0;">
							<label for="gender">Gender</label>
							
							<input type="radio" name="gender" value="Male" checked> Male
							<input type="radio" name="gender" value="Female" > Female
							
							<!--<input type="text" class="form-control" id="gender" name="gender" value="<?php if (!empty($row->gender)) { echo $row->gender;} else { echo "";}?>"  />-->
						</div>
						
						<?php
						/*if (!empty($row->created_date))
						{
							$newd=$row->created_date;
							//$ti=$newd->__toString();
							//echo $d;
							
							//$utcdatetime = new MongoDB\BSON\UTCDateTime($ti);
							//$datetime = $utcdatetime->toDateTime();
							
							$timestamp = $newd->__toString(); //ISO DATE Return form mongo database
							$utcdatetime = new MongoDB\BSON\UTCDateTime($timestamp);
							$datetime = $utcdatetime->toDateTime();
							$time=$datetime->format(DATE_RSS);
							$dateInUTC=$time;
							$time = strtotime($dateInUTC.' UTC');
							$dateInLocal = date("F d Y", $time);
							//echo $dateInLocal;

						}*/
						?>
						<div class="col-sm-6">
							<label for="date_of_joining">Date Of Joining</label>
							<input type="date" class="form-control" id="date_of_joining" name="date_of_joining" value="<?php if (!empty($row->date_of_joining)) { echo $dateInLocal;;} else { echo "";}?>"  />
						</div>
						
						<div class="col-sm-6">
							<label for="status">Owner Status</label>
							
							<select class="form-control" id="owner_status" name="owner_status" class="required">
								<option value="" selected="">Select Status</option>
								<option value=1 <?php if(!empty($row->owner_status)){if ($row->owner_status==1) { echo "selected=selected";}} else { echo "Select Status";}?>>Active</option>
								<option value=2 <?php if(!empty($row->owner_status)){if ($row->owner_status==2) { echo "selected=selected";}} else { echo "Select Status";}?>>InActive</option>
								
								
							</select>
							
						</div>
						<div class="col-sm-6">
							<label for="address">Address</label>
							<input type="text" class="form-control" id="address" name="address" value="<?php if (!empty($row->address)) { echo $row->address;} else { echo "";}?>"  placeholder="Enter Mobile Number" required />
						</div>
						
					
						<div class="col-sm-6">
								 
							<input type="submit" class="btn btn-success" value="submit" name="submit" style="margin-top:2%" onclick="return validate();">
						</div>
						
                    </div>
                 
					
				
                </form>
				
                
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
		include('footer.php');
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
function submitofferForm(){
   
	var postData = new FormData($("#modal_form_id")[0]);
    
  
        $.ajax({
            type:'POST',
            url:'addcategory.php',
           processData: false,
                                 contentType: false,
                                 data : postData,
                                 success:function(data){
									 
                              		console.log(data);
									window.location.href="category.php";
                                 }
		});
	
	}
	function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
	function validate()
	{
		alert("here");
		
		var first_name=$("#first_name").val();
		var last_name=$("#last_name").val();
		var email=$("#email").val();
		var mobile=$("#mobile").val();
		var language=$("#language").val();
		var gender=$("#gender").val();
		var date_of_joining=$("#date_of_joining").val();
		var owner_status=$("#owner_status").val();
		var address=$("#address").val();
		
		if(first_name.trim()=="")
		  {
			    alert("Please Enter the first name of the owner");
				$("#first_name").val('');
				$("#first_name").focus();
				return false;
		  }
		  else 
		  {
			  return true;
		  }
		if(last_name.trim()=="")
		  {
			    alert("Please Enter the last name of the owner");
				$("#last_name").val('');
				$("#last_name").focus();
				return false;
		  }
		  else 
		  {
			  return true;
		  }
		  
		  if(mobile.trim()=="")
		  {
			    alert("Please Enter the mobile number of the owner");
				$("#mobile").val('');
				$("#mobile").focus();
				return false;
		  }
		  else 
		  {
			  return true;
		  }
		  
		  if(date_of_joining.trim()=="")
		  {
			    alert("Please Enter the date of joining of the owner");
				$("#date_of_joining").val('');
				$("#date_of_joining").focus();
				return false;
		  }
		  else 
		  {
			  return true;
		  }
		  
		   if(address.trim()=="")
		  {
			    alert("Please Enter the address of the owner");
				$("#address").val('');
				$("#address").focus();
				return false;
		  }
		  else 
		  {
			  return true;
		  }
		  
		  
	}
	
	//To check duplicate email of the student 
//By Dipeeka on 21st January 2020
function checkduplicateemailoftheuser(email){
	var emailvalue=email.value;
	
	$.ajax({
		method:'GET',
		url:'ajax/checkduplicateemail.php?email='+emailvalue,
		   dataType:'JSON',
		 success:function(data){
				alert(data.message);
				//alert($("#emailid").val());
				//document.getElementById("emailid").reset();
				$("#email").val('');
			}
	})
   /* $.ajax({
		
			 url:'ajax/checkduplicateemail.php',
			 dataType:'JSON',
			 success:function(data){
			}
		)}*/
}
</script>
</body>
</html>
