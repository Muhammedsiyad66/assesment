<?php
session_start();
include("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$oldPasswordError = $newPasswordError = $confirmPasswordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate old password
    $userId = $_SESSION['user_id'];
    $sql = "SELECT password FROM user_registration WHERE id = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!password_verify($oldPassword, $row['password'])) {
            $oldPasswordError = "Incorrect old password";
        }
    }

    // Validate new password
    if (empty($newPassword)) {
        $newPasswordError = "New password is required.";
    } else if (strlen($newPassword) < 8) {
        $newPasswordError = "Please enter a password with at least 8 characters.";
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $confirmPasswordError = "Confirm password is required.";
    } else if ($newPassword != $confirmPassword) {
        $confirmPasswordError = "Passwords do not match.";
    }

    // If there are no errors, update the password
    if (empty($oldPasswordError) && empty($newPasswordError) && empty($confirmPasswordError)) {
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE user_registration SET password = '$hashedNewPassword' WHERE id = '$userId'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reset Password</title>
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
                        <h4>Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="old_password">Old Password:</label>
                                <input type="password" class="form-control" name="old_password" id="old_password" required>
                                <span class="text-danger"><?php echo $oldPasswordError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" required>
                                <span class="text-danger"><?php echo $newPasswordError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                                <span class="text-danger"><?php echo $confirmPasswordError; ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
