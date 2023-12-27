<?php
include("connection.php");

$usernameError = $emailError = $passwordError = $confirmpasswordError = $fileError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate username
    if (empty($_POST["username"])) {
        $usernameError = "Username is required.";
    } else if (preg_match("/[0-9 !@#$%^&*()]/", $_POST["username"])) {
        $usernameError = "Please enter only alphabetic values";
    } else {
        $username = $_POST["username"];

        // Check if the username already exists
        $checkUsernameQuery = "SELECT id FROM user_registration WHERE username = '$username'";
        $result = $conn->query($checkUsernameQuery);

        if ($result->num_rows > 0) {
            $usernameError = "Username already exists. Please choose a different username.";
        }
    }

    // Validate Email
    
    if (empty($_POST["email"])) {
        $emailError = "Email is required.";
    } else if (!preg_match("/^[a-z]+@[a-z]+\.[a-z]+$/", $_POST["email"])) {
        $emailError = "Invalid email format.";
    } else {
        $email = $_POST["email"];
    }

    // validate password
    if (empty($_POST["password"])) {
        $passwordError = "Password is required.";
    } else if (strlen($_POST["password"]) < 8) {
        $passwordError = "Please enter a password with at least 8 characters.";
    } else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $_POST["password"])) {
        $passwordError = "Password must contain at least 1 uppercase & lowercase letter, 1 digit, and 1 special character.";
    } else {
        $password = $_POST["password"];
    }

    // validate confirmpassword
    $confirmpassword = $_POST["confirmpassword"];
    if (empty($_POST["confirmpassword"])) {
        $confirmpasswordError = "Confirm password is required.";
    } else if ($password !== $confirmpassword) {
        $confirmpasswordError = "Passwords do not match.";
    } else {
        $confirmpassword = $_POST["confirmpassword"];
    }
    if (empty($usernameError) && empty($emailError) && empty($passwordError) && empty($confirmpasswordError) && empty($fileError)) {
        $checkEmailQuery = "SELECT id FROM user_registration WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            $emailError = "Email already registered. Please use a different email.";
        } else {
    $targetDirectory = "C:/xampp/htdocs/user_reg&login_sys/asset/";
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the username exists before uploading the file
    if (empty($usernameError)) {
        // Check file upload
        if (empty($_FILES["file"]["name"])) {
            $fileError= "File Upload is required.";
            $uploadOk = 0;
        }

        // Check file size
        // else if ($_FILES["file"]["size"] > 500000) {
        //     $fileError=  "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        else if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        else if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";

            // Continue with other validations and database insertion
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
        }}

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $uploadDir = "C:/xampp/htdocs/user_reg&login_sys/asset/";
        $uploadFile = $uploadDir . basename($_FILES["file"]["name"]);

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
            $fileUrl = "http://localhost/user_reg&login_sys/asset/" . basename($_FILES["file"]["name"]);
        } else {
            echo "File upload failed!";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fileUrl = "http://localhost/user_reg&login_sys/asset/" . basename($_FILES["file"]["name"]);

        $password = password_hash($password, PASSWORD_DEFAULT);
        $htmlResponse = '';
        // Insert data into the database if no errors
        if (empty($usernameError) && empty($emailError) && empty($passwordError)&& empty($confirmpasswordError)  && empty($fileError)) {
            $sql = "INSERT INTO user_registration (username, email, password, file) 
                    VALUES ('$username', '$email', '$password', '$fileUrl')";

            if ($conn->query($sql) === TRUE) {
                $htmlResponse = '<div id="urs" class=container; style="color: green;text-align:center;">User registered successfully</div>';
            } else {
                $htmlResponse = '<p style="color: red;">Error: ' . $conn->error . '</p>';
            }
        }
        echo $htmlResponse;
    }
}
?>
<style>
    #urs{
        box-shadow: 0 1px 1px rgba(0,0,0,0.11), 
              0 2px 2px rgba(0,0,0,0.11), 
              0 4px 4px rgba(0,0,0,0.11), 
              0 8px 8px rgba(0,0,0,0.11), 
              0 16px 16px rgba(0,0,0,0.11), 
              0 32px 32px rgba(0,0,0,0.11);
        background-color: #ced4da   ;
    }
</style>
<script>
    
// Set a timeout to remove the HTML response after 5 seconds (5000 milliseconds)
setTimeout(function() {
    document.querySelector('$htmlResponse').innerHTML = '';
}, 3000);
</script>
