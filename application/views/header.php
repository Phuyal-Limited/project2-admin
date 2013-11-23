<?php
	if(!isset($this->session->userdata['user_id']) && !isset($this->session->userdata['username']) && !isset($this->session->userdata['full_name']) && !isset($this->session->userdata['hotel_id'])){
		redirect('login');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"> <!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.theme.min.css'); ?>"> <!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">  <!-- Font-awesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/demos.css'); ?>"> <!-- jquery ui -->
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"> <!-- jquery ui -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css'); ?>"> <!-- Custom css Nepal Inn -->
	
</head>
<body>

	<div class="header">
		<div class="title">
			<h1>Dashboard</h1>
		</div>
	</div>

