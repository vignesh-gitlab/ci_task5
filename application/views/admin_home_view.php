<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

</head>
<body>

<div id="container">
	<h1>Admin Home</h1>

	
	<button type="button" id="view_users" name="view_users"   class="btn btn-primary">Users</button>	
	<button type="button" id="log_out" name="log_out"   class="btn btn-danger float-right">Log Out</button>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<!--<p id="session_id"></p>-->


<script type="text/javascript">
/*
    $('#session_id').click(function(){        
        $session_id = '<?php echo $this->session->userdata('id');?>';
        $('#session_id').val()=$session_id;

    });
*/
            

        $('#log_out').click(function(){
			var url='<?php echo base_url();?>';
            window.location.href=url+'welcome/log_out';
        });
    

	
		$('#view_users').click(function(){
			var url='<?php echo base_url();?>';
            window.location.href=url+'welcome/view_users';
        });
	

	/*$('#view_users').click(function(){
		var url='<?php echo base_url();?>';
		
		
		$.ajax({
			url=url+'welcome/view_users',
			method='post',
			dataType:'json',
			success:function(data){
				var html='';
				var i;
				html+='<table align="center" border="1" class="border"><tr><th>Name</th><th>User Name</th><th>Password</th><th>Latitude</th><th>Longitude</th><th>User Type</th></tr>';
				for(i in data){
					html+='<tr><td>'+data[i].name+'</td><td>'+data[i].user_name+'</td><td>'+data[i].password+'</td><td>'+data[i].latitude+'</td><td>'+data[i].longitude+'</td><td>'+data[i].user_type+'</td></tr>';
				}
				html+='<table>';
				$('#result').html(html);
			}
		});
		
	});
*/
	

</script>
</body>
</html>
