<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css'); ?>">
</head>
<body>
	<div class="wrapper">	
		<div id="logo">
			<a href="index.php"><img src="<?php echo base_url('assets/images/logo.png'); ?>"> </a>
		</div>
		<div id="login-main">
			<div class="login-form">
			<form name="login" method="POST" action="login_entry" >
				<div id="username">
					<label>Username: </label></br>
					<input type="text" name="user"  id="user" class="text-box" /></br>
				</div>
				<div id="password">
					<label>Password:</label> </br>
					<input type="password" name="pass"  id="pass" class="text-box" /></br>
				</div>
				<div id="msg"></div>
				<span id="load"></span>
				<div id="button">
					<input type="submit" name="login" id="submit-button" value="Login To Nepal Inn" class="register-button">
				</div>
				<div id="forget">
					<p><a href="">Forget Password?</a>
						or
						<a href="">Contact Us.</a>
					</p>
				</div>
			</form>
		</div>
		</div>
	</div>

	<!--script links-->
	<script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
 	<script src="<?php echo base_url('assets/js/jq.js');?>"></script><!--script ends here-->
</body>
</html>
	
