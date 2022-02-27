<?php 
	//error_reporting(1);
	include 'function.php';
	include 'dbconfig.php';
	session_start();

if (isset($_SESSION['user_id']) && !isLoginSessionExpired()) {


	if ($_SERVER['REQUEST_METHOD']=='POST') {

		/*print_r($_FILES['photo']);
		die();
		*/

		/*echo $_POST['photo'];
		echo $_POST['pdf'];
		echo $_POST['name'];
		echo $_POST['category_id'];
		echo $_POST['author_id'];
		echo $_POST['level'];
		echo $_POST['description'];
		echo $_POST['perprice'];

		die();*/
	$photo = $_FILES['photo']['name'];
	$fileExt = explode('.', $photo);
	$fileActualExt = strtolower(end($fileExt));
	$photoallowed = array('jpg','jpeg','png');
	if (!in_array($fileActualExt, $photoallowed)){
		$photoMessagaeError = "Photo exection must be JPG,JPEG,PNG";

		}else{

			$pdf = $_FILES['pdf']['name'];
			$pdffileExt = explode('.', $pdf);
			$pdffileActualExt = strtolower(end($pdffileExt));
			$pdfallowed = array('pdf');
			if (!in_array($pdffileActualExt, $pdfallowed)){
				$pdfMessageError = "PDF exection must be pdf";
				}else{

				if (isset($_FILES['photo']) && $_FILES['photo']['size']>0) {
					if (!file_exists('bookimg')) {
						mkdir('bookimg',0777,true);
					}

					$dir = 'bookimg/';
					$photo = $dir.$_FILES['photo']['name'];

					
					$tmp_name = $_FILES['photo']['tmp_name'];
					move_uploaded_file($tmp_name, $photo)or die('Upload Image Errors!');

				

						if (isset($_FILES['pdf']) && $_FILES['pdf']['size']>0) {
						if (!file_exists('pdfimg')) {
							mkdir('pdfimg',0777,true);
						}

						$dir = 'pdfimg/';
						$pdf = $dir.$_FILES['pdf']['name'];

								
						$tmp_name = $_FILES['pdf']['tmp_name'];
						move_uploaded_file($tmp_name, $pdf)or die('Upload PDF Errors!');

						$new_book = array(
						"photo" => $photo,
						"pdf" => $pdf,
						"name" => $_POST['name'],
						"author_id" => $_POST['author'],
						"category_id" => $_POST['category'],
						"level" => $_POST['level'],
						"description" => $_POST['description'],
						"perprice" => $_POST['perprice']
					);

					$tablename = 'books';
					insert($tablename,$new_book,$connection);
					}
			}
			
		}
						
	}

		/*print_r($photo);
		print_r($pdf);
		die();*/

			
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico">
	<title>Medialoot Bootstrap 4 Dashboard Template</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<?php require 'slidebar.php'; ?>
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<?php require 'header.php'; ?>
				<section class="row">
					<div class="col-sm-12">
						<section class="row">
							<div class="col-md-12 col-lg-12">
								<?php 
									if (isset($photoMessagaeError)) {  ?>
									
								<div class="alert alert-danger" role="alert">

									<?php echo $photoMessagaeError; ?>
								</div>
									
									<?php }elseif (isset($pdfMessageError)) { ?>
								<div class="alert alert-danger" role="alert">
									<?php	echo $pdfMessageError; ?>
								</div>
									<?php }else{
										echo "";
									}
									?>
							</div>
						</section>
						<section class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title">ALL Books</h3>
										<div class="dropdown card-title-btn-container">
											<button class="btn btn-sm btn-subtle" type="button" data-toggle="modal" data-target="#exampleModal"><em class="fa fa-plus"></em> Add Book</button>
											<!-- <button class="btn btn-sm btn-subtle dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="fa fa-cog"></em></button>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#"><em class="fa fa-search mr-1"></em> More info</a>
											    <a class="dropdown-item" href="#"><em class="fa fa-thumb-tack mr-1"></em> Pin Window</a>
											    <a class="dropdown-item" href="#"><em class="fa fa-remove mr-1"></em> Close Window</a></div> -->
										</div>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Book#</th>
														<th>Name</th>
														<th>Level</th>
														<th>Perprice</th>
														<th>Actions</th>
													</tr>
												</thead>
											
								<tbody>
								<?php $result = select('books',$connection);
				    			foreach ($result as $key => $value) {
				    			?>	
								<tr>
									<td><?php echo $value['id']; ?></td>
									<td><?php echo $value['name']; ?></td>
									<td><?php echo $value['level']; ?></td>
									<td>
										<?php

										if ($value['perprice']==0) {
											echo "FREE";
										}else{
											echo $value['perprice'].' Kyats'; 
										}
										?> 
									</td>
									<td><a href="bookdetail.php?id=<?php echo $value['id']; ?>" class="btn btn-primary mx-2">DETAIL</a>
									<a href="" class="btn btn-warning mx-2">EDIT</a>
									<a href="" class="btn btn-danger mx-2">DELETE</a></td>
								</tr>
								<?php } ?>							
								</tbody>
							
											</table>
										</div>
									</div>
								</div>
							</div>
						</section>
						<section class="row">
							<div class="col-12 mt-1 mb-4">Template by <a href="https://www.medialoot.com">Medialoot</a></div>
						</section>
					</div>
				</section>
			</main>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script>
	    var startCharts = function () {
	                var chart1 = document.getElementById("line-chart").getContext("2d");
	                window.myLine = new Chart(chart1).Line(lineChartData, {
	                responsive: true,
	                scaleLineColor: "rgba(0,0,0,.2)",
	                scaleGridLineColor: "rgba(0,0,0,.05)",
	                scaleFontColor: "#c5c7cc "
	                });
	            }; 
	        window.setTimeout(startCharts(), 1000);
	</script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CREATE BOOK:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
        	<div class="col-6">
        		<p>Photo:</p>
        		<input type="file" name="photo" >
        	</div>
        	<div class="col-6">
        		<p>PDF</p>
        		<input type="file" name="pdf">
        	</div>
        </div><br>
         <div class="form-group row">
		    <label for="name" class="col-sm-3 col-form-label">Name</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="name" name="name" placeholder="Book Name...">
		    </div>
		  </div>
         <div class="form-group row">
         	<label for="category" class="col-sm-3 col-form-label">Authors</label>
         	<div class="col-sm-9">
			    <select name="author" class="form-control">
			    	<option value="">Select Author</option>
			    	<?php $result = select('authors',$connection);
			    		foreach ($result as $key => $value) {
			    	?>
			    	<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
			    <?php } ?>
			    </select>
			</div>
		</div>
        <div class="form-group row">
		    <label for="category" class="col-sm-3 col-form-label">Category</label>
		    <div class="col-sm-9">
		      <select name="category" class="form-control">
			    	<option value="">Select Category</option>
			    	<?php $result = select('categories',$connection);
			    		foreach ($result as $key => $value) {
			    	?>
			    	<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
			    <?php } ?>
			    </select>
		    </div>
		  </div>
        <div class="form-radio">
        	<div class="row">
        		<div class="col-3">
        			<label for="radio"> Level: </label>
        		</div>
        		<div class="col-9">
        			<input type="radio" value="Beginner" name="level" id="beginner" checked="checked"><label for="beginner">Beginner</label><br>
					<input type="radio" value="Advance" name="level" id="advance"><label for="advance">Advance</label><br>
					<input type="radio" value="Pro" name="level" id="professional"><label for="professional">Professional</label>
        		</div>
        	</div>
      </div>
      <div class="form-group row">
      	<label for="desc" class="col-sm-3 col-form-label">Description</label>
      	<div class="col-sm-9">
      		<textarea name="description" placeholder="Book Description..."></textarea>
      	</div>
      </div>
      <div class="form-goup row">
      	<input type="checkbox" class="col-sm-3" name=""> Not Free?
      </div>
      <div class="form-group row">      	
      		<input type="text" class="col-md-6 offset-3" placeholder="Enter Prices" name="perprice">
      </div>      
  	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	</body>
</html>
<?php } ?>