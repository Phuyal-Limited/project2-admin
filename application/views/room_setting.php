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
					<div class="row room-categories">  <!-- starts:room-categories -->
					

					<?php
						$size = sizeof($template_details);
						for($i=0;$i<$size;$i++){
					?>
						<div class="col-md-6 room-wrap"> <!-- starts:room-wrap -->
							<div class="room-category">
								<div class="col-md-12">
									<div class="room-category-head">
										<?php echo $template_details[$i]['name'];?> <a href="" class="room-category-edit">Edit</a>
									</div>
									<div>
										<div class="clear"></div>


										<div class="row room-boxes"> <!-- starts:room row -->

											<?php
												$row = sizeof($template_room[$i]);
												for($j=0;$j<$row;$j++){
											?>
												<div class="col-md-3 col-xs-3 col-sm-2 room-box">
													<div class="room-no available"><?php echo $template_room[$i][$j]['room_no'];?></div>
												</div>
											<?php
												}
											?>
										</div><!-- starts:room row -->
											<div class="row">
												<div class="col-md-12">
													<div class="room-category-add-head">
														Add a new <?php echo $template_details[$i]['name'];?> room
													</div>
												</div>
												<div class="clear"></div>
												<div clas="col-md-12">
												<form action="add_room" method="post" onsubmit="return add_room(<?php echo $i;?>);">
													<div class="col-md-3 col-sm-3 col-xs-3">
														<label>Room No:</label>
													</div>
													<div class="col-md-4 col-sm-4 col-xs-4">
														<input type="text" id="room_no<?php echo $i;?>" name="room_no<?php echo $i;?>" class="form-control">
													</div><br/>
													<div class="clear"></div>
													<div class="col-md-3 col-sm-3 col-xs-3">
														<label>Floor No:</label>
													</div>
													<div class="col-md-4 col-sm-4 col-xs-4">
														<input type="text" id="floor_no<?php echo $i;?>" name="floor_no<?php echo $i;?>" class="form-control">
													</div><br/>
													<div class="clear"></div>
													<div class="col-md-5 col-sm-5 col-xs-5">
														<input type="hidden" id="template<?php echo $i;?>" value="<?php echo $template_details[$i]['template_id'];?>" />
														<input type="submit" id="submit<?php echo $i;?>" name="submit" value="Add" class="btn btn-default">
													</div>
												</form>
												</div>
											</div>
											<div class="clear"></div>
									</div>
								</div>
							</div>
						</div> <!-- starts:room-wrap -->
						<?php
							}
						?>
					</div>  <!-- starts:room-categories -->

					<div class="row room-add-wrap">
						<div class="col-md-12">
							<div class="room-add">
								<div class="col-md-12">
									<div class="new-category-head">
										Add New Standard
									</div>
									<div class="form-content add-room-category-form">  <!-- Starts:form-content -->
										<form action="add_template" method="post">
											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Name:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" name="template_name" type="text" placeholder="Name">

												</div>
											</div> <!-- ends:form-row -->
											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Rate per Night:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" name="rate" type="text" placeholder="In NRs">

												</div>
											</div> <!-- ends:form-row -->
											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Description:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<textarea class="form-control" name="description" placeholder="Description"></textarea>
												</div>
											</div> <!-- ends:form-row -->

											<div class="row">
												<div class="col-md-12">
													<input type="submit" name="add" value="Add Standard" class="btn btn-default">
												</div>
											</div>
										</form>
									</div> <!-- ends:form-content -->
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
					

					
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
