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

<!-- Login form -->
<div id="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
	    <h1 align="center">Welcome to Our Site!</h1>
        <div class="form-group">
            UserName:<input type="text" name="user_name" id="user_name" class="form-control" required><br>        
            Password:<input type="text" name="password" id="password" class="form-control" required><br>                
            <input type="button" name="login_submit" id="login_submit" value="Submit" class="btn btn-success form-control">        
            <br>
            <br>
            <p>Click here to <a href="<?php echo base_url('welcome/register');?>">Register</a> for new user</p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        var url='<?php echo base_url();?>';

        //function for validate user details to login
        $('#login_submit').click(function(){
            var user_name=$('#user_name').val();
            var password=$('#password').val();
            if(user_name!='' && password!=''){
                $.ajax({
                    url:url+'welcome/login',
                    method:'post',
                    data:{user_name:user_name,password:password},
                    success:function(response){
                        if(response=="flag1"){
                            window.location.href=url+'welcome/admin_home';
                        }else if(response=="flag2"){
                            window.location.href=url+'welcome/user_home';
                        }else{
                            alert("username and password did not match");
                            $('#user_name').val("");
                            $('#password').val("");
                        }
                    }
                });

            }else if(user_name=='' && password==''){
                alert("enter username and password");
            }else if(password==''){
                alert("enter password");
            }else{
                alert("enter username");
            }

        });

    });
</script>

</body>
</html>
