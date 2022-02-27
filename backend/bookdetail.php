<?php 

	include 'function.php';
	include 'dbconfig.php';
	session_start();

if (isset($_SESSION['user_id']) && !isLoginSessionExpired()) {

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$tablename = 'books';
		$book = bookdetail($tablename,$id,$connection);
		//print_r($book);
	}else{
		echo "Something went wrong!";
		exit();
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
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title">Book Detail</h3>
										<div class="dropdown card-title-btn-container">
											<button class="btn btn-sm btn-warning " type="button" data-toggle="modal" data-target="#exampleModal"> EDIT</button>
											<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#exampleModal"> DELETE</button>
											<!-- <button class="btn btn-sm btn-subtle dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="fa fa-cog"></em></button>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#"><em class="fa fa-search mr-1"></em> More info</a>
											    <a class="dropdown-item" href="#"><em class="fa fa-thumb-tack mr-1"></em> Pin Window</a>
											    <a class="dropdown-item" href="#"><em class="fa fa-remove mr-1"></em> Close Window</a></div> -->
										</div>
											
											<div class="row">
												<div class="col-4">
													Name:
												</div>
												<div class="col-8">
													<?php echo $book['name']; ?>
												</div>
											</div><br>
											<div class="row">
												<div class="col-4">
													Photo:
												</div>
												<div class="col-8">
													<img src="<?php echo $book['photo']; ?>" class="img-fluid">
												</div>
											</div><br>
											<div class="row">
												<div class="col-4">
													Pdf:
												</div>
												<div class="col-8">
													<?php echo $book['pdf']; ?> 
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-4">
													Level:
												</div>
												<div class="col-8">
													<?php echo $book['level']; ?>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-4">
													Description
												</div>
												<div class="col-8">
													<?php echo $book['description']; ?>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-4">
													Perprice:
												</div>
												<div class="col-8">
													<?php echo $book['perprice']; ?> Kyats
												</div>
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
        			<input type="radio" value="Beginner" name="level" id="beginner"><label for="beginner">Beginner</label><br>
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