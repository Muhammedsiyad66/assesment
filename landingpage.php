<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: user_login.php");
    exit();
}

// Retrieve user details from the session
$username = $_SESSION["username"];
$email = $_SESSION["email"];
$file = $_SESSION["file"];
?>

<!-- ... rest of your code ... -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        img{
            width: 300px;
            height: 300px;
            border-radius: 10px;
        }
        
    </style>
</head>
<body>
    <div class="container mt-5 text-center">
        <img src="<?php echo $file; ?>" class="pd-5 profile-image" alt="Profile Image">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>Email: <?php echo $email; ?></p>
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-primary" name="signout">Sign Out</button>
        </form>
        <a style="margin-top: 20px;" href="reset_passsword.php">reset password</a>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>