<?php
	include('config/config.php');
	/*include('inc/header.php');
	include('inc/aside.php');*/
	$id=$_REQUEST['id'];
	$filter = ["raceid"=>new MongoDB\BSON\ObjectID($id)];
	$options = ['sort' => [ 'result.duration' => -1 ]];	
	$query=new MongoDB\Driver\Query($filter,$options);
	$cursor=$connection->executeQuery("gulf_racing.raceresults",$query);
//	print_r($cursor);
	/*if($_POST['submit'])
	{
		print_r($_POST['duration']);
		die();
	}*/
?>
<!doctype html>
<html lang="en">

    <head>

		<!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Bootstrap 4 Carousel with Multiple Items</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">
        <link rel="stylesheet" href="assets/css/carousel.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

		

        <!-- Top content -->
		<form enctype="multipart/form-data" method="POST">
        <div class="top-content">
        	<div class="container-fluid">
        		<div id="carousel-example" class="carousel slide" data-ride="carousel">
        			<div class="carousel-inner row w-100 mx-auto" role="listbox">
				<?php	
				$i=1;
				foreach($cursor as $key => $document)
					{
						//echo "<pre>";
						//print_r($document);
						$innerArray=$document->result;
						
						
						
						foreach($innerArray as $r)
						{
							
							
								$filter1 = ['_id' => new MongoDB\BSON\ObjectID($r->camelid)];

								$options1 = [];

								$query1 = new MongoDB\Driver\Query($filter1,$options1);

								$cursor1 = $connection->executeQuery('gulf_racing.camels', $query1);
						
							foreach($cursor1 as $result)
							{
								
						
				//print_r($document);
				?>
            			<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 <?=($key == 0 ? 'active' : '')?>">
						<p><?=$r->duration.$i?></p>
						
						<img src="images/<?=((!empty($result->image))?$result->image:"noimage.jfif")?>" style="width:80%;height:60%"  title="Cover Image" class="img-fluid mx-auto d-block">
						
						<!--<label for="duration">Duration (In Minutes )</label>
							<input type="time" class="form-control" id="duration" name="duration[]" list="limittimeslist" step="0.001" value="<?php if (!empty($row->duration)) { echo $row->duration;} else { echo "";}?>"  placeholder="Enter Duration in Minutes" required />-->
							
						</div>
						
						<?php
						$i++;
							}
						}
					}
						?>
        			</div>
        			<a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
        		</div>
        	</div>
        </div>
		<div class="col-sm-6">
								 
			<input type="submit" class="btn btn-success" value="submit" name="submit" style="margin-top:2%">
		</div>
		
       </form>
	   
	   
	   

        <!-- Footer -->
        <footer class="footer-container">
        
	        <div class="container">
	        	<div class="row">
	        		
                    
                    
                </div>
	        </div>
                	
        </footer>

        <!-- Javascript -->
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>

</html>