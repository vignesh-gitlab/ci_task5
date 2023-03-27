<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Users</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

</head>
<body>

<!-- Modal for edit user details -->
<div class="modal" tabindex="-1" role="dialog" id="edit_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form id="frm">
                <input type="hidden" name="action" id="action" value="Insert">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="user_name" id="user_name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" id="password" required class="form-control">
                </div>
                
                <input type="submit" name="edit_submit" id="edit_submit" value="Submit" class="btn btn-success">
              </form>
      </div>
     
    </div>
  </div>
</div>


<div id="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
	    
        
    </div>
</div>
<h1 align="center">User Details Data</h1>
<button type="button" id="admin_home" name="admin_home"   class="btn btn-warning float-right">Admin Home</button><br><br>
<button type="button" id="log_out" name="log_out"   class="btn btn-danger float-right">Log Out</button>

  <div id="result">
    <!-- Div for show user details from Database -->
  </div>
           
</div>
        
<script>
    
    
		//function for load user details while page opens
        window.onload = function() {
            var url='<?php echo base_url();?>';		
		$.ajax({
			url:url+'welcome/get_users',
			method:'post',
			dataType:'json',
			success:function(data){
				var html='';
				var i;
				html+='<table align="center" border="1" class="border"><tr><th>Name</th><th>User Name</th><th>Password</th><th>Latitude</th><th>Longitude</th><th>User Type</th><th>Action</th><th>Location</th></tr>';
				for(i in data){
					html+='<tr><td>'+data[i].name+'</td><td>'+data[i].user_name+'</td><td>'+data[i].password+'</td><td>'+data[i].latitude+'</td><td>'+data[i].longitude+'</td><td>'+data[i].user_type+'</td><td><button type="button" class="btn btn-info edit" id='+data[i].id+'>Edit&nbsp;<button type="button" class="btn btn-danger delete" id='+data[i].id+'>Delete</td><td style="width:350px;height:250px;"><iframe src="https://www.google.com/maps?q='+data[i].latitude+','+data[i].longitude+'&hl=es;z=14&output=embed" style="width:100%;height:100%;"></iframe></td></tr>';
				}
				html+='<table>';
				$('#result').html(html);
			}
		});
    }

	$(document).ready(function(){


    //function for get user details in modal
	$("body").on('click','.edit',function(){
		event.preventDefault();
		$current_row=$(this).closest("tr");
                  $("#edit_modal").modal();
                  var id=$(this).attr("id");
                  var name=$(this).closest("tr").find("td:eq(0)").text();
                  var user_name=$(this).closest("tr").find("td:eq(1)").text();
                  var password=$(this).closest("tr").find("td:eq(2)").text();
                  var user_type=$(this).closest("tr").find("td:eq(5)").text();
                  
                  $("#action").val("Update");
                  $("#id").val(id);
                  $("#name").val(name);
                  $("#user_name").val(user_name);
                  $("#password").val(password);
                  $("#user_type").val(user_type);
		
		
	});

  //function for update user details
  $('#edit_submit').click(function(){
        var edit_id=$('#id').val();
        var name=$('#name').val();
        var user_name=$('#user_name').val();
        var password=$('#password').val();

        var url='<?php echo base_url();?>';                         
        $.ajax({
            url:url+"welcome/update_data",
            method:"POST",
            data:{edit_id:edit_id,name:name,user_name:user_name,password:password},
            success:function(response){
                //return true;
                $('#edit_id').val("");
                $('#name').val("");
                $('#user_name').val("");
                $('#password').val("");               
                
                if(response){
                    alert("Record Updated Successfully");
                }else{
                    alert("Record Not Inserted"+response+"");
                }
            }
        });

    });

    //function for delete user from Database
    $("body").on("click",".delete",function(event){   //Delete Record from Database
                  event.preventDefault();
                  var url='<?php echo base_url();?>';	
                  var id=$(this).attr("id");
                  //alert(id);
                  var cls=$(this);                 
                  if(confirm("Are you Sure?")){
                  $.ajax({
                    url:url+"welcome/delete_data",
                    type:"POST",
                    data:{id:id},
                    /*beforeSend:function(){
                      $(cls).text("Loading");
                    },*/
                    success:function(res){                      
                      if(res){
                        $(cls).closest("tr").remove();
                      }else{                        
                        alert("Not Deleted");
                        $(cls).text("Try Again");
                      }
                    }                    
                  });
                }
                });



    //function for log out user
    $('#log_out').click(function(){
			var url='<?php echo base_url();?>';
            window.location.href=url+'welcome/log_out';
        });
    
    //function for go Admin Home Page
    $('#admin_home').click(function(){
			var url='<?php echo base_url();?>';
            window.location.href=url+'welcome/admin_home';
        });



	});		
</script>

</body>
</html>
