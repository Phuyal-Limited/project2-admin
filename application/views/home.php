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
					<div class="row" id="notifys"> <!-- starts:notifys -->
						<div class="col-xs-12 col-sm-6 col-md-3 notify" > <!-- starts:notify -->
							<div id="notify-head">
								<i class="fa fa-square-o"></i>Total
							</div>
							<div id="pri-notify-info">
								91 Bookings
							</div>
							<div id="sec-notify-info">
								46 Cancellations
							</div>	
						</div> <!-- ends:notifys -->
						<div class="col-xs-12 col-sm-6 col-md-3 notify" > <!-- starts:notify -->
							<div id="notify-head">
								<i class="fa fa-star"></i>Total
							</div>
							<div id="pri-notify-info">
								91 Bookings
							</div>
							<div id="sec-notify-info">
								46 Cancellations
							</div>	
						</div> <!-- ends:notifys -->
						<div class="col-xs-12 col-sm-6 col-md-3 notify"> <!-- starts:notify -->
							<div id="notify-head">
								Total
							</div>
							<div id="pri-notify-info">
								91 Bookings
							</div>
							<div id="sec-notify-info">
								46 Cancellations
							</div>	
						</div> <!-- ends:notifys -->
						<div class="col-xs-12 col-sm-6 col-md-3 notify"> <!-- starts:notify -->
							<div id="notify-head">
								Total
							</div>
							<div id="pri-notify-info">
								91 Bookings
							</div>
							<div id="sec-notify-info">
								46 Cancellations
							</div>	
						</div> <!-- ends:notifys -->
					</div> <!-- ends:notifys -->

					<div class="clear"></div>
					<div class="row" id="data-blocks"> <!-- starts:data-blocks -->
						<div class="col-md-4 ">
							<div class="row">
								<div class="col-md-12 col-xs-12 col-sm-6"> <!-- starts:data block-small -->
									<div class="data-block data-block-small" id="guest-pickup">
										<div class="data-block-head">
											Today's Guest Pickup
										</div>

										<div class="data-block-content" id="pickup_show"> <!-- starts: data-block-content -->
										</div> <!-- ends: data-block-content -->
										
									</div>
								</div>  <!-- ends:data block-small -->

								<div class="col-md-12 col-xs-12 col-sm-6"> <!-- starts:data block-small -->
									<div class="data-block data-block-small" id="recent-bookings">
										<div class="data-block-head">
											Sheduled Arrivals
										</div>

										<div class="data-block-content" id="scheduled_show"> <!-- starts:Data-block-content -->
										</div>  <!-- ends:Data-block-content -->
									
									</div>
								</div>  <!-- ends:data block-small -->

								<div class="col-md-12 col-xs-12 col-sm-6"> <!-- starts:data block-small -->
									<div class="data-block data-block-small" id="recent-bookings">
										<div class="data-block-head">
											Recents Bookings
										</div>

										<div class="data-block-content" id="recent_show"> <!-- starts:Data-block-content -->
										</div>  <!-- ends:Data-block-content -->
									
									</div>
								</div>  <!-- ends:data block-small -->


								
							</div>

						</div>
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-12"><!-- starts:data-block-big -->
									<div class="data-block data-block-big" id="available-rooms">
										<div class="data-block-head">
											Rooms
										</div>
										<div class="data-block-content room-content">
											<div class="row room-boxes"> <!-- starts:room row -->
												<?php foreach ($rooms as $aRoom) {?>
													<div class="col-md-2 col-xs-3 col-sm-2 room-box"  rel="tooltip" title="<?php echo $aRoom['standard']; ?>">
														<div class="room-no <?php echo $aRoom['status']; ?>"><?php echo $aRoom['roomNumber']; ?></div>
													</div>
												<?php } 
													if($rooms == array()){
														echo "There are no rooms entered in your Inn";
													}
												?>
											</div><!-- starts:room row -->
											<div class="row ">
												<div class="room-filter">
													<div class="col-md-12 col-sm-12 col-xs-12">
														<div class="data-block-filter-head">
															Filter Rooms
														</div>
													</div>
													<div class="col-md-4 col-sm-4 col-xs-4">
														<select class="form-control">
															<option>Any Category</option>
														</select>
													</div>
													<div class="col-md-4 col-sm-4 col-xs-4">
														<input class="form-control" type="text" id="datepicker-from" placeholder="From">
													</div>
													<div class="col-md-4 col-sm-4 col-xs-4">
														<input class="form-control" type="text" id="datepicker-to" placeholder="To">
													</div>
													<div id="room-filter-button">
														<input class="btn btn-default inn-button room-filter-btn"  type="submit" value="Filter">
													</div>

												</div>
											</div>
											
										</div>
									</div>
								</div><!-- ends:data-block-big -->

								<div class="col-md-12"><!-- starts:data-block-big -->
									<div class="data-block data-block-big" id="check-in">
										<div class="data-block-head">
											Check In
										</div>
										<div class="data-block-content form-content"> <!-- starts:data-block-contents -->
											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Name:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Name">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Check In:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Check In">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Check Out:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Check Out">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Guests:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Guests">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Rooms:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Rooms">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Address:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Address">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Email:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Email">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Cell:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="cell">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Details:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<textarea class="form-control"></textarea>

												</div>
											</div> <!-- ends:form-row -->

											<div class="inn-buttons" id="form-buttons">
												<p><input class="btn btn-default inn-button" type="submit" value="Check In"></p>
											</div>

										</div> <!-- ends:data-block-contents -->
										<div class="data-block-footer"> <!-- starts:data-block-footer -->
											<p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CLASS APTENT TACITI SOCIOSQU AD LITORA</p>
										</div> <!-- ends:data-block-footer -->
									</div>
								</div><!-- ends:data-block-big -->

								<div class="col-md-12"><!-- starts:data-block-big -->
									<div class="data-block data-block-big" id="check-out">
										<div class="data-block-head">
											Check Out
										</div>
										<div class="data-block-content form-content"> <!-- starts:data-block-contents -->
											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Name:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Name">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Check In:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Check In">

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-4 col-md-4">
													<label>Check Out:</label>
												</div>
												<div class="col-sm-8 col-xs-8 col-md-8">
													<input class="form-control" type="text" placeholder="Check Out">

												</div>
											</div> <!-- ends:form-row -->

											

											<div class="inn-buttons" id="form-buttons">
												<p><input class="btn btn-default inn-button" type="submit" value="Check Out"></p>
											</div>

										</div> <!-- ends:data-block-contents -->
										<div class="data-block-footer"> <!-- starts:data-block-footer -->
											<p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. CLASS APTENT TACITI SOCIOSQU AD LITORA</p>
										</div> <!-- ends:data-block-footer -->
									</div>
								</div><!-- ends:data-block-big -->
							</div>
						</div>
					</div> <!-- ends:data-blocks -->
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
