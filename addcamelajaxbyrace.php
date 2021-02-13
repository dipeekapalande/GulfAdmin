<?php
session_start();
ob_start();
	include_once('config\config.php');
	
	if($_REQUEST['camelname']=='')
	{
		echo "<script>alert('Please Enter Camel Name')</script>";
	}
	else{
	$id=new MongoDB\BSON\ObjectId();
	 $camelname=$_REQUEST['camelname'];

	 $camelnumber=$_POST['camelnumber'];
	   $cameldescription=$_POST['cameldescription'];
	   $camelcategory=$_POST['camelcategory'];
	   $age=$_POST['age'];
		 
	  $gender=$_POST['gender'];
      $fathername=$_POST['fathername'];
	  $mothername=$_POST['mothername'];
      
	  $owner_name=$_POST['owner_name'];
	  $countryCode=$_POST['countryCode'];
	  $contact=$_POST['mobile'];
	  $ccode="+".$_POST['countryCode'].$_POST['mobile'];
	 
	  //$race_id=$_POST['racename'];
	  
	  //$raceid=new MongoDB\BSON\ObjectId($race_id);
	   
	   
	  $camel_status  = $_POST['camel_status'];
      if($camel_status==1)
	  {
		  $s=true;
	  }
	  else
	  {
		  $s=false;
	  }
	

      if(!$camel_status){
  
        $flag = 5;

      }else{
         
           $insRec       = new MongoDB\Driver\BulkWrite;

           $insRec->insert(['_id'=>$id,'camelname'=>$camelname,'camelnumber'=>$camelnumber,'cameldescription'=>$cameldescription,'camelcategory'=>$camelcategory,'age'=>(int)($age),'fathername'=>$fathername,'mothername'=>$mothername,'gender'=>$gender,'camel_status' =>$s,'owner_name'=>$owner_name,'mobile'=>$ccode,'countryCode'=>$countryCode,'contact'=>$contact]);
          
           $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
         
             $result       = $connection->executeBulkWrite('gulf_racing.camels', $insRec, $writeConcern);

      
		   
		echo $id;
      }
					
	} //echo $flag;
	 // die();
	

	
  

  
?>