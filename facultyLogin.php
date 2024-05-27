<?php
session_start();
include 'db.php';
if(isset($_POST['submit']))
  {
$email_id=$_POST['email_id'];
    $password=$_POST['password'];
    $query = "select * from faculty where email_id='$email_id' AND password='$password'";
    $result = mysqli_query($mysqli,$query);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count=mysqli_num_rows($result);
    if($count==1)
    {
    $_SESSION["username"]=$row;
    header('location:/projectApprovalSystem/facultyPages/homePage.php');
    } 
    else
    {
echo"invalid";
    header('location:/projectApprovalSystem/facultyLogin.php');    
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN FORM</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="/projectApprovalSystem/fonts/material-icon/css/material-design-iconic-font.min.css">

    <link href="/projectApprovalSystem/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main css -->
    <link rel="stylesheet" href="/projectApprovalSystem/assets/registration_css/style.css">
    <style type="text/css">
        .invalid
        {
            border:1px solid #e62727;
        }
        body {
            background-color: #0E1C26; /* Set background color to teal */
        }

        .main {
            background-color: transparent; /* Remove background color from the main container */
        }

        .signup-content {
            background-color: #294861; /* Set background color of the login container */
            padding: 50px; /* Add padding for better spacing */
            border-radius: 10px; /* Add border radius for rounded corners */
        }


    </style>
</head>
<body>

    <div class="main">

        <section class="signup">

            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="login-container">
                <div class="signup-content">
                    <form method="POST" action="/projectApprovalSystem/facultyLogin.php" id="signup-form" class="signup-form">
                        <div class="form-title">
                        <h1 style='text-align: center;color:white;'>Login</h1>
                    </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="email_id" id="email_id" placeholder="Email Id"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign In"/>
                        </div>
                  
                      </form>
                    <p style='text-align: center;color: white;'>
                        Don't have account ? <a href="/projectApprovalSystem/facultyRegistration.php" class="loginhere-link" style="color:white;">Register here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="/projectApprovalSystem/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/projectApprovalSystem/assets/js/main.js"></script>
</body>
</html>


