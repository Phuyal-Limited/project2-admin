
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script> <!-- jquery -->
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> <!-- Bootstrap -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.core.js'); ?>"></script> <!-- jquery ui -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.widget.js'); ?>"></script> <!-- jquery ui datepicker -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.datepicker.js'); ?>"></script> <!-- jquery ui -->
<script type="text/javascript">

	//tooltip

	$(function () {
	$("[rel='tooltip']").tooltip();
	});


	//date-picker

	$(function() {
			$( "#datepicker-from" ).datepicker();
			$( "#datepicker-to" ).datepicker();
		});



</script>
</body>
</html>