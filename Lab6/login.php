<!DOCTYPE html>
<?php session_start(); ?>
<html>
    <head>
        <link href="css/login.css" rel="stylesheet" type="text/css" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-5 col-md-3">
                    <form method="POST" action="loginProcess.php">
                    <h4>Administrator Login</h4>
                    <input type="text" name="username" id="userName" class="form-control input-sm chat-input" placeholder="username" /> <br>
                    <input type="password" name="password" id="userPassword" class="form-control input-sm chat-input" placeholder="password" /> <br>
                    <div class="wrapper">
                    <span class="group-btn">     
                        <input type="submit" name="submitForm" value="Login!" />
                    </span>
                    </div>
                    </form>
                    <?php
                        if($_SESSION['incorrect']){
                            echo "<p class = 'lead' id = 'error' style='color:red'>";
                            echo "<strong>Incorrect Username or Password!</strong></p>";
                            $_SESSION['incorrect'] = false;
                        } 
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>