	<div class="contents"> <!-- starts:contents -->
		<div class="container"> <!-- starts:container -->
			<div class="row">  <!-- starts:row -->
				<?php  
					include("sidebar.php");
				?>

				<div class="col-md-9 ">
					<div class="row" id="breadcrums"> <!-- starts:breadcrums -->
						<ol class="breadcrumb">
						  <li><a href="#">Nepal Inn</a></li>
						  <li class="active">Dashboard</li>
						</ol>
					</div> <!-- ends:breadcrums -->
					
					<!--form div starts here-->
					<div class=" row edit-update-wrap"> <!-- starts:edit update wrap -->
						<div class="edit-update">
							<div class="col-md-12">
								<form action="edit_update" method="post" enctype="multipart/form-data">
							
								<div class="edit-update-head">
									<?php echo $hotel_details[0]->name;?>
								</div>
								<div class="form-content">
									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>Address</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-6">
											<input class="form-control" type="text" name="address" id="address" value="<?php echo $hotel_details[0]->address;?>" />
										</div>
									</div> <!-- ends:form-row -->

									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>Phone1</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-6">
											
											<input class="form-control" type="text" name="phone1" id="phone1" value="<?php echo $hotel_details[0]->phone1;?>" />
										</div>
									</div> <!-- ends:form-row -->

									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>Phone2</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-6">
											<input class="form-control" type="text" name="phone2" id="phone2" value="<?php echo $hotel_details[0]->phone2;?>" />
										</div>
									</div> <!-- ends:form-row -->

									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>URL</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-6">
											<input class="form-control" type="text" name="url" id="url" value="<?php echo $hotel_details[0]->url; ?>" />
										</div>
									</div> <!-- ends:form-row -->

									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>Google Map URL</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-6">
											<input class="form-control" type="text" name="google_url" id="google_url" value="<?php echo $hotel_details[0]->google_map_url; ?>" />
										</div>
									</div> <!-- ends:form-row -->

									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>Default Image</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-8">
											<input type="file" name="default_image" id="default_image" onChange="readURL(this);" />
											<?php
												if($hotel_details[0]->default_imgid==0){
											?>
											
											<br /><img  style="display:none; padding:4px; border:1px solid #c7c7c7; border-radius: 5px;" id="img_prev" src="#" alt="Image Preview" />
											<?php 
												}else{
										 	?>
										 	<img src="<?php echo $default_image[0]->path; ?>" id="img_prev" alt="<?php echo $default_image[0]->alt; ?>" width="150px" height="150px" />
										 	<?php 
										 		} 
										 	?>
										</div>
									</div> <!-- ends:form-row -->

									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>Other Images</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-8">
											<input type="file" name="images" id="images" onChange="showimg(this);" disabled="disabled" />
											<?php
												if($hotel_details[0]->default_imgid==''){
											?>
											<br/><div id="image_display"></div><br />
											<?php
												}else{
													for($i=0;$i<sizeof($other_image);$i++){
											?>
													<img src="<?php echo $other_image[$i]->path; ?>" alt="<?php echo $other_image[$i]->alt; ?>" width="150px" height="auto" />
											<?php 
													}
												}
											?>
										</div>
									</div> <!-- ends:form-row -->

									<div class="row form-row">  <!-- starts:form-row -->
										<div class="col-sm-4 col-xs-4 col-md-4">
											<label>Description</label>
										</div>
										<div class="col-sm-8 col-xs-8 col-md-6">
											<textarea class="form-control" name="description" id="description" value="<?php echo $hotel_details[0]->description; ?>"></textarea>
										</div>
									</div> <!-- ends:form-row -->

									<div class="row">
										<div class="col-md-12">
											<label>Facilities</label>
										</div>

										<?php 
											$size = sizeof($hotel_facilities);
											$sz = $size-1;
											$row = intval($sz/6);
											$j=0;
											$count = 0;
											for($i=0;$i<$row;$i++){
												while($j<$size){
													

													$checked = '';
													if($hotel_facilities[$j][2]=='1'){
														$checked='checked';
													}
										?>
										<div class="col-md-4">
											<label><input type="checkbox" name="check[]" value="<?php echo $hotel_facilities[$j][0]; ?>" <?php echo $checked; ?> /><?php echo $hotel_facilities[$j][1];?></label>
										</div>

										<?php
													$j++;
													$count++;
													if($count==6){
														$count = 0;
														echo '<br />';
														break;
													}
												}
											}
										?>
										
									</div>

									
										
										
									
									
										
										
									
									
										
										
									<div class="row">
										<div class="col-md-12">
											<input type="submit" name="update" id="update" value="Update" class="btn btn-default" />
										</div>
									</div>
								</div>
								<div class="clear"></div>
						</form>
							</div>
						</div>
					</div><!-- ends:edit update wrap -->

				</div>
			</div><!-- Ends:row -->
		</div> <!-- Ends:container -->
	</div> <!-- Ends:contents -->

	<div class="footer-dash">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					&copy Copyright <a href="home.php"> Nepal Inn</a>
				</div>
			</div>
		</div>
	</div>
