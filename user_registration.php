<?php
include('validation.php');
include('connection.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>user registration</title>
</head>
<body>
<style>
  body{
    background-image: url('https://wallpapers.com/images/hd/4k-laptop-on-black-desk-qrlk8vcxz01kbm0h.jpg');
  }
  .btn{
    width: 100%;
  }
  .login{
    color: #ced4da;
    text-align: center;
    margin-top: 10px;
  }
  
  input.transparent-input{
     color: #ced4da;
       background-color:rgba(0,0,0,0) !important;
       border:none !important;
    }
  #reg{
    box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 8px 8px rgba(0,0,0,0.11), 
              0 16px 16px rgba(0,0,0,0.11), 
              0 32px 32px rgba(0,0,0,0.11);
  }
  .form-control {
      background-color: transparent; 
      border: 1px solid #ced4da; 
      color: #ced4da; 
    }

    .form-control::placeholder {
      color: #6c757d; 
    }
    .btn {
      background-color: #ced4da;
      color: #000;
    }
    form{
      margin-top: 40px;
    }

</style>

<div class="container mt-5">
  <div id="messages">

  </div>
  <div class="row justify-content-center">
    <div id="reg" class="col-md-6">
        <h1 style="text-align:center;color:#f5f5f5;margin-top: 20px;">USER REGISTRATION</h1>
      <form id="edit-Form" method="post" enctype="multipart/form-data">
        <div class="mb-3 ">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          <span class="text-danger"><?php echo $usernameError; ?></span>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="email address">
          <span class="text-danger"><?php echo $emailError; ?></span>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="password">
          <span class="text-danger"><?php echo $passwordError; ?></span>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Re enter your password">
          <span class="text-danger"><?php echo $confirmpasswordError; ?></span>
        </div>
        <div class="mb-3">
          <input type="file" class="form-control" id="file" name="file">
          <span class="text-danger"><?php echo $fileError; ?></span>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <p class="login">already signin? <a href="user_login.php">login</a> </p>

      </form>
      
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $('#editForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                // Display success message or handle response
                $('#messages').html('<div class="alert alert-danger" role="alert">Deleted successfully</div>');
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
