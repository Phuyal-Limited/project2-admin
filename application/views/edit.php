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
					<div>
						<form action="edit_update" method="post">
							<fieldset>
								<label>Hotel Name</label><br />
								<?php echo $hotel_details[0]->name;?>
							</fieldset><br />
							<fieldset>
								<label>Address</label><br />
								<input type="text" name="address" id="address" value="<?php echo $hotel_details[0]->address;?>" />
							</fieldset><br />
							<fieldset>
								<label>City</label><br />
								<input type="text" name="city" id="city" value="<?php echo $hotel_details[0]->city;?>" />
							</fieldset><br />
							<fieldset>
								<label>Phone1</label><br />
								<input type="text" name="phone1" id="phone1" value="<?php echo $hotel_details[0]->phone1;?>" />
							</fieldset><br />
							<fieldset>
								<label>Phone2</label><br />
								<input type="text" name="phone2" id="phone2" value="<?php echo $hotel_details[0]->phone2;?>" />
							</fieldset><br />
							<fieldset>
								<label>E-mail</label><br />
								<input type="text" name="email" id="email" value="<?php echo $hotel_details[0]->email; ?>" />
							</fieldset><br />
							<fieldset>
								<label>URL</label><br />
								<input type="text" name="url" id="url" value="<?php echo $hotel_details[0]->url; ?>" />
							</fieldset><br />
							<fieldset>
								<label>Google Map URL</label><br />
								<input type="text" name="google_url" id="google_url" value="<?php echo $hotel_details[0]->google_map_url; ?>" />
							</fieldset><br />
							<fieldset>
								<label>Default Image</label><br />
								<input type="file" name="default_image" id="default_image" onChange="readURL(this);" />
								<?php
									if($hotel_details[0]->default_imgid==0){
								?>
								
								<br /><img  style="display:none;" id="img_prev" src="#" alt="Image Preview" />
								<?php 
									}else{
							 	?>
							 	<img src="<?php echo $default_image[0]->path; ?>" id="img_prev" alt="<?php echo $default_image[0]->alt; ?>" width="150px" height="150px" />
							 	<?php 
							 		} 
							 	?>
							</fieldset><br />
							<fieldset>
								<label>Other Images</label><br />
								<input type="file" name="images" id="images" />
								<?php
									if($hotel_details[0]->default_imgid==''){
								?>
								<br/><div id="image_display"></div><br />
								<?php
									}else{
										for($i=0;$i<sizeof($other_image);$i++){
								?>
										<img src="<?php echo $other_image[$i]->path; ?>" alt="<?php echo $other_image[$i]->alt; ?>" width="150px" height="150px" />
								<?php 
										}
									}
								?>
							</fieldset><br />
							<fieldset>
								<label>Description</label><br />
								<textarea name="description" id="description" value="<?php echo $hotel_details[0]->description; ?>"></textarea>
							</fieldset><br />
							<fieldset>
								<label>Facilities</label><br />
								<?php 
									$size = sizeof($hotel_facilities);
									$sz = $size-1;
									$row = intval($sz/6);
									$j=0;
									$count = 0;
									for($i=0;$i<$row;$i++){
										while($j<$size){
											$j++;

											$checked = '';
											if($hotel_facilities[$j][2]=='1'){
												$checked='checked';
											}
								?>
								 			<input type="checkbox" name="<?php echo $j;?>" value="<?php echo $hotel_facilities[$j][0]; ?>" <?php echo $checked; ?> /><label><?php echo $hotel_facilities[$j][1];?></label>&nbsp;&nbsp;
								<?php
											$count++;
											if($count==6){
												$count = 0;
												echo '<br />';
												break;
											}
										}
									}
								?>
							</fieldset><br />
							<input type="submit" name="update" id="update" value="Update" class="btn btn-default inn-button" />
						</form>
					</div><!--form div ends here-->

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
