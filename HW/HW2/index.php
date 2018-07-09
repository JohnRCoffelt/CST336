<!DOCTYPE html>
<?php
include 'inc/functions.php';
?>

<html>
    <head>
        <title> Random Cat Creator </title>
        <style>
            @import url("css/catstyles.css");
        </style>
    </head>
    <body>
        <div id="main"></div>
            <?php
                play();
            ?>
            <form>
                <input type="submit" value="Create a cat!"/>
            </form>
        </div>
         <footer>
            <hr>
            CSUMB CST 336. 2018&copy; Coffelt <br />
            <strong>Disclaimer:</strong> The information in this webpage
            is fictitious. <br />
            It is used for academic purposes only.<br />
            <img src="img/logo.png" alt="Picture of CSUMB logo"/>
        </footer>
    </body>
</html>