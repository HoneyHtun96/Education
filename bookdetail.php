<?php

require 'backend/function.php';
require 'backend/dbconfig.php';
require 'header.php'; 
    
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
        <!--================End Home Banner Area =================-->
        
        <!--================Courses Area =================-->
        <section class="courses_area p_120">
        	<div class="container">
    			<div class="row">
                    <div class="col-lg-12">
                        <blockquote class="generic-blockquote">
                            <h2>Featured Books</h2>
                            “Recently, the US Federal government banned online casinos from operating in America by  
                        </blockquote>
                    </div>
                </div>

        		<div class="row courses_inner my-5">
                    <div class="col-md-4 my-2">
                        <div class="grid_item wd100">
                            <div class="courses_item">
                                <img src="backend/<?php echo $book['photo']; ?>" alt="" class="img-fluid">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 my-2">
                        <div class="grid_item wd100">
                            <div class="courses_item">
                                <form>
                                  <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Book Description</label>
                                    <div class="col-sm-9">
                                      <p class="h6 my-2"><?php echo $book['description']; ?></p>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Level</label>
                                    <div class="col-sm-9">
                                      <p class="h6 my-2"><?php echo $book['level']; ?> </p>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Author</label>
                                    <div class="col-sm-9">
                                      <p class="h6 my-2"><?php echo $book['authorname'] ?> </p>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Downloads</label>
                                    <div class="col-sm-9">
                                      <p class="h6 my-2">124 </p>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">File Size</label>
                                    <div class="col-sm-9">
                                      <p class="h6 my-2"><?php 

                                      $filesize = filesize('backend/'.$book['pdf']);
                                      $mfilesize =round($filesize/1024/1024,2);
                                      echo $mfilesize;
                                       ?> MB</p>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Released Date</label>
                                    <div class="col-sm-9">
                                      <p class="h6 my-2"><?php echo $book['createdAt']; ?></p>
                                    </div>
                                  </div>

                                  <div class="form-group row my-5">
                                    <div class="col-sm-9">
                                      <a href="backend/<?php echo $book['pdf']; ?>" target="_blank" class="main_btn" style="padding: 0 15px;line-height: 37px;margin-right: 10px;">Read Now</a>
                                      <?php 
                                        if ($book['perprice']==0) { ?>
                                            <a href="backend/<?php echo $book['pdf']; ?>" class="btn btn-outline-warning mx-2" download>Download</a>
                                           
                                       <?php
                                        }else{ ?>
                                            <a href="#" data-id="<?php echo $book['id']; ?>" data-photo="backend/<?php echo $book['photo']; ?>" data-name="<?php echo $book['name']; ?>" data-price="<?php echo $book['perprice']; ?>" class="btn btn-outline-info mx-2 addToCart">Add To Cart</a>
                                        <?php
                                        }
                                      ?>
                                    </div>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="section-top-border">
                        <div class="row">
                            <div class="col-md-6 my-3">
                                <div class="single-defination">
                                    <h4 class="mb-20 text-center">Authors</h4>
                                    <a href="#" class="btn btn-outline-secondary">Thet Paing Htut</a>
                                    <a href="#" class="btn btn-outline-secondary">Yathaw Myat Noe</a>
                                    <a href="#" class="btn btn-outline-secondary">Yan Myoe Aung</a>
                                    <a href="#" class="btn btn-outline-secondary">Hein Min Htet</a>
                                    <a href="#" class="btn btn-outline-secondary">Yin Min Ei</a>
                                    <a href="#" class="btn btn-outline-secondary">Yu Yu Nwe</a>
                                    <a href="#" class="btn btn-outline-secondary">Eaindra Kyaw</a>
                                    <a href="#" class="btn btn-outline-secondary">Zar Chi Linn</a>
                                    <a href="#" class="btn btn-outline-secondary">Ei Ei Thet</a>
                                </div>
                            </div>
                            <div class="col-md-6 my-3">
                                <div class="single-defination categories">
                                    <h4 class="mb-20 text-center">Categories</h4>
                                    <a href="#" class="btn btn-outline-secondary">Web Development</a>
                                    <a href="#" class="btn btn-outline-secondary">Data Analysis</a>
                                    <a href="#" class="btn btn-outline-secondary">Database</a>
                                    <a href="#" class="btn btn-outline-secondary">Web Design</a>
                                    <a href="#" class="btn btn-outline-secondary">Networking</a>
                                    <a href="#" class="btn btn-outline-secondary">Cyber Security</a>
                                    <a href="#" class="btn btn-outline-secondary">Frameworks</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </section>
        <!--================End Courses Area =================-->
        
        <!--================Pagkages Area =================-->
        <section class="packages_area p_120">
        	<div class="container">
        		<div class="row packages_inner">
        			<div class="col-lg-4">
        				<div class="packages_text">
        					<h3>Choose <br />Course Packages</h3>
        					<p>There is a moment in the life of any aspiring astronomer that it is time to buy that first telescope. It’s exciting to think about setting up your own viewing station.</p>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="packages_item">
        					<div class="pack_head">
        						<i class="lnr lnr-graduation-hat"></i>
        						<h3>Premium</h3>
        						<p>For the individuals</p>
        					</div>
        					<div class="pack_body">
        						<ul class="list">
        							<li><a href="#">Secure Online Transfer</a></li>
        							<li><a href="#">Unlimited Styles for interface</a></li>
        							<li><a href="#">Reliable Customer Service</a></li>
        						</ul>
        					</div>
        					<div class="pack_footer">
        						<h4>£399.00</h4>
        						<a class="main_btn" href="#">Join Now</a>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="packages_item">
        					<div class="pack_head">
        						<i class="lnr lnr-diamond"></i>
        						<h3>Exclusive</h3>
        						<p>For the individuals</p>
        					</div>
        					<div class="pack_body">
        						<ul class="list">
        							<li><a href="#">Secure Online Transfer</a></li>
        							<li><a href="#">Unlimited Styles for interface</a></li>
        							<li><a href="#">Reliable Customer Service</a></li>
        						</ul>
        					</div>
        					<div class="pack_footer">
        						<h4>£399.00</h4>
        						<a class="main_btn" href="#">Join Now</a>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Pagkages Area =================-->
        
       


        <!--================ start footer Area  =================-->	
        <?php require 'footer.php'; ?>