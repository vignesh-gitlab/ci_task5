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
<!-- Registration form -->
<div id="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
	    <h1 align="center">Registration</h1>
        <div class="form-group">
            Name:<input type="text"   name="name" id="name" value="" autocomplete="off" class="form-control" required><br><br>        
            User Name:<input type="text"   name="user_name" id="user_name" value="" autocomplete="off" class="form-control" required><br><br>            
            Password:<input type="text"   name="password" id="password" value="" autocomplete="off" class="form-control" required><br><br>
            <input type="hidden" name="latitude" id="latitude" value="">
            <input type="hidden" name="longitude" id="longitude" value="">
            <input type="button" name="register_submit" id="register_submit" value="Register" class="btn btn-success form-control">  
            <br><br>
            <p><a href="<?php echo base_url();?>">Home</a></p>          
        </div>
    </div>
</div>

<script>

$(document).ready(function(){


    //function for autoload latitude and longitude while page opens
    window.onload = function() {
        
        
    
    fetch("https://ipapi.co/json/")   //using ISP(Internet Service Provider), IP address
      .then((response)=>response.json())
      .then((data)=>{
        console.log(data);
    var latitudeInput = document.getElementById('latitude');
    latitudeInput.value = data.latitude;
    var longitudeInput = document.getElementById('longitude');
    longitudeInput.value = data.longitude;
    });
};

//function for insert new user data    
$('#register_submit').click(function(){
        var url='<?php echo base_url();?>';
        var name=$('#name').val();
        var user_name=$('#user_name').val();
        var password=$('#password').val();
        var latitude=$('#latitude').val();
        var longitude=$('#longitude').val();         
        $.ajax({
            url:url+"welcome/register_data",
            method:"POST",
            data:{name:name,user_name:user_name,password:password,latitude:latitude,longitude:longitude},
            success:function(response){
                //return true;
                $('#name').val("");
                $('#user_name').val("");
                $('#password').val("");               
                
                if(response=="true"){
                    alert("Record Inserted Successfully");
                }else{
                    alert("Record Not Inserted"+response+"");
                }
            }
        });

    });




});



</script>

</body>
</html>
