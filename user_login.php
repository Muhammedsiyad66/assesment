<?php
session_start();
include('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $enteredUsernameOrEmail = $_POST['username_or_email'];
    $enteredPassword = $_POST['password'];

    // Retrieve stored data from the database based on the entered username or email
    $sql = "SELECT * FROM user_registration WHERE username = '$enteredUsernameOrEmail' OR email = '$enteredUsernameOrEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the entered password against the stored hashed password
        if (password_verify($enteredPassword, $row['password'])) {
            echo "Login successful!";
            // Set the user_id session key
            $_SESSION['user_id'] = $row['id'];
            // Set other user-related information in the session
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['file'] = $row['file']; // Adjust the key based on your database column name
            // Redirect to landingpage.php
            header("Location: landingpage.php");
            exit();
        } else {
            $htmlResponse = '<div id="uls" class=container; style="color: red;text-align:center;margin-top: 20px;"><p>incorrect password</p></div>';

        }
    } else {
        $htmlResponse = '<div id="unf" class=container; style="color: red;text-align:center;margin-top: 20px;"><"><p>user not found</p></div>';

    }
}
echo $htmlResponse;
?>
<style>
    
    #uls{
        box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 8px 8px rgba(0,0,0,0.11), 
              0 16px 16px rgba(0,0,0,0.11), 
              0 32px 32px rgba(0,0,0,0.11);
        background-color: #ced4da   ;
      
    }
    #unf{
        box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 8px 8px rgba(0,0,0,0.11), 
              0 16px 16px rgba(0,0,0,0.11), 
              0 32px 32px rgba(0,0,0,0.11);
        background-color: #ced4da   ;
    }

</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>User Login</title>
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
    .card{
        background: none;
        box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 8px 8px rgba(0,0,0,0.11), 
              0 16px 16px rgba(0,0,0,0.11), 
              0 32px 32px rgba(0,0,0,0.11);
    }
    h4{
        text-align: center;
        color: #ced4da;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>USER LOGIN</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="usernameOrEmail">Username or Email:</label>
                                <input type="text" class="form-control" name="username_or_email" id="usernameOrEmail" placeholder="Enter your username or email" required>

                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <div>
                                <p style="text-align:center;margin-top:10px;">Not a user ? <a href="user_registration.php">sign up</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>