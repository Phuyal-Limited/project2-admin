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
					
					<div class="row">
						<div class="col-md-12">
							<div class=" wrap-wrap change-password-wrap">
								<div class="col-md-12">
									<div class="head-head">
										Change Password
									</div>
									<div class="clear"></div>
									<?php
										if(isset($success)){
											echo "<div class='message-show'>";
											if($success){
												echo "<div class='success'>$message</div>";
											}else{
												echo "<div class='failure'>$message</div>";
											}
											echo "</div>";
										}
									?>
									<form name='changepsw' method='post' action='' onsubmit="return validate();" >
										<div class="form-content">
											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-5 col-md-4">
													<label>Old Password:</label>
												</div>
												<div class="col-sm-8 col-xs-7 col-md-5">
													<input class="form-control" name="old" type="password" placeholder="Old Password" required>

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-5 col-md-4">
													<label>New Password:</label>
												</div>
												<div class="col-sm-8 col-xs-7 col-md-5">
													<input class="form-control" name="new" id="new" type="password" placeholder="New Password" required>

												</div>
											</div> <!-- ends:form-row -->

											<div class="row form-row"> <!-- starts:form-row -->
												<div class="col-sm-4 col-xs-5 col-md-4">
													<label>Confirm Password:</label>
												</div>
												<div class="col-sm-8 col-xs-7 col-md-5">
													<input class="form-control" name="renew" id="renew" type="password" placeholder="Confirm Password" required>

												</div>
											</div> <!-- ends:form-row -->
											<div class="clear"></div>
											<div class="row">
												<div class="col-md-12">
												<div id="validate-msg"></div><br/>
													<input type="submit" name="pswChng" value="Change Password" class="btn btn-default">
												</div>
											</div>
										</div>
									</form>
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
