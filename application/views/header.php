<?php
	if(!isset($this->session->userdata['user_id']) && !isset($this->session->userdata['username']) && !isset($this->session->userdata['full_name']) && !isset($this->session->userdata['hotel_id'])){
		redirect('home');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title;?></title>
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.theme.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
	
</head>
<body>

	<div class="header">
		<div class="title">
			<h1>Dashboard</h1>
		</div>
	</div>

