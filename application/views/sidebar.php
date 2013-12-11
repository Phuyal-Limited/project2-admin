<div class="col-md-3 sidebar section1 "> <!-- starts: section1,sidebar -->
	<div class="row">
		<div class="col-xs-5 col-md-5 profile-img-small">
			<div class="thumbnail">
				<img src="<?php 
					if(isset($default_image[0]))
						echo $default_image[0]->path; 
					?>">
			</div>
		</div>
		<div class="col-xs-7 col-md-7 profile-details-small">
			<div id="owner-name">
				<a href=""><?php echo $hotel_details[0]->name;?></a>
			</div>
			<div id="owner-location">
				<?php echo $hotel_details[0]->address.', '.$hotel_details[0]->city;?>
			</div>
			<div class="inn-buttons" id="sidebar-buttons">
				<a href="">Profile</a>
				<a href="logout">Logout</a>
			</div>
		</div>
	</div>
	<div class="row" id="sidebar-search">
		<input class="form-control" type="text" placeholder="To search type and hit enter">
	</div>
	<div class="sidebar-menus">
		<ul>
			<li class="current"><a href="home"><i class="fa fa-home"></i>Dashboard</a></li>
			<li><a href=""><i class="fa fa-book"></i>Add bookings</a></li>
			<li><a href="room_setting"><i class="fa fa-building"></i>Room Setting</a></li>
			<li><a href="edit">Profile Edit</a></li>
			<li><a href="">Bookings</a></li>
			<li><a href="">Arrivals</a></li>
			<li><a href="change_password">Change Password</a></li>
		</ul>
	</div>

	<div class="row ">
		<div class="room-filter">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="data-block-filter-head">
					Check Available Rooms
				</div>
			</div>
			<div class="col-md-12 col-sm-4 col-xs-12">
				<select class="form-control" id="template" name="template">
					<option value="any">Any Category</option>
					<?php
					foreach ($template as $aTemplate) {
						echo "<option value='$aTemplate[template_id]'>$aTemplate[name]</option>";
					}
					?>
				</select>
				<div class='clear-small'></div>
			</div>
			<div class="col-md-12 col-sm-4 col-xs-12">
				<input class="form-control" type="text" id="datepicker-from" placeholder="From">
				<div class='clear-small'></div>
			</div>
			<div class="col-md-12 col-sm-4 col-xs-12">
				<input class="form-control" type="text" id="datepicker-to" placeholder="To">
				<div class='clear-small'></div>
			</div>
			<div class="col-md-12 col-sm-4 col-xs-12">
				<div id="date-error-message"></div>
				<div class='clear-small'></div>
			</div>
			<div id="room-filter-button">
				<input class="btn btn-default inn-button room-filter-btn" id="check" type="submit" onclick="return search_room();" value="Check">
				<input class="btn btn-default inn-button room-filter-btn" data-toggle="modal" data-target="#myModal" style="display:none;" id="check_show" type="submit" value="Check Show">
			</div>

		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        	Available Rooms
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-md-12"><!-- starts:data-block-big -->
				<div class="data-block" id="available-rooms">
					<div class="data-block-content room-content">
						
						<div class="row room-boxes"  id="available-rooms-show"> <!-- starts:room row -->
						</div><!-- starts:room row -->

					</div>
				</div>
			</div><!-- ends:data-block-big -->
		</div>
      </div>
      <div class="modal-footer">
      	<input type="submit" value="Check In" class="btn btn-default" data-toggle="modal" data-dismiss="modal" data-target="#my-checkin-Modal">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Button trigger modal -->
<!-- <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#my-checkin-Modal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="my-checkin-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <!-- <h4 class="modal-title" id="myModalLabel">Modal title</h4> -->
        <div id="myModalLabel" class="modal-title ">
			Check In
		</div>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12"><!-- starts:data-block-big -->
									<div class="data-block data-block-big" id="check-in">
										<!-- <div class="data-block-head">
											Check In
										</div> -->
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
        </div>
      </div>
      <div class="modal-footer">
      <!-- <input type="submit" value="Finish" class="btn btn-default"> -->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</div><!-- ends: section1,sidebar -->

<input type="hidden" id="room_id" />