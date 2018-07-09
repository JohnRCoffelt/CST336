<!DOCTYPE html>
<?php
include 'inc/functions.php';
?>

<html>
    <head>
        <title> Cat Creator </title>
        <link href="https://fonts.googleapis.com/css?family=Gaegu" rel="stylesheet">
        <style>
            @import url("css/catstyles.css");
        </style>
    </head>

    <body>
        <header> 
            <h1> Create Your Cat! </h1>
            <hr>
        </header>
        <div id="main"></div>
            <?php
                play();
            ?>
            <form id="form" method="post" action="index.php">
                Cat Name: <input name="catName" type="text" id="catName" size="25" value="<?php echo $_SESSION["catName"];?>" />
                <span class="error">* <?php echo $_SESSION["nameErr"];?> </span>
                <br/><br/>
                Cat Color: <br>
                <select name="catColor" id="catColor">
                        <option value="White" <?php isSelectedCatColor("White");?> >White</option>
                        <option value="Grey" <?php isSelectedCatColor("Grey");?> >Grey</option>
                        <option value="Orange" <?php isSelectedCatColor("Orange");?> >Orange</option>
                        <option value="Black-ish" <?php isSelectedCatColor("Black-ish");?> >Black-ish</option>
                        <option value="Yellow" <?php isSelectedCatColor("Yellow");?> >Yellow</option>
                        <option value="Red" <?php isSelectedCatColor("Red");?> >Red</option>
                        <option value="Maroon" <?php isSelectedCatColor("Maroon");?> >Maroon</option>
                        <option value="Blue" <?php isSelectedCatColor("Blue");?> >Blue</option>
                        <option value="Green" <?php isSelectedCatColor("Green");?> >Green</option>
                </select><br /> <br />
                
                Eye Color: <br>
                <select name="eyeColor" id="eyeColor">
                        <option value="Blue" <?php isSelectedEyeColor("Blue");?> >Blue</option>
                        <option value="Grey" <?php isSelectedEyeColor("Grey");?> >Grey</option>
                        <option value="Brown" <?php isSelectedEyeColor("Brown");?> >Brown</option>
                        <option value="Hazel" <?php isSelectedEyeColor("Hazel");?> >Hazel</option>
                        <option value="Magenta" <?php isSelectedEyeColor("Magenta");?> >Magenta</option>
                </select><br /> <br />
                
                Collar: 
                <span class="error">* <?php echo $_SESSION["collarErr"];?> </span>
                <br/>
                <input type="radio" id="collar1"  name="collarType"  value="none" <?php isCollarChecked("none");?> >
                    <label for="collar1">None</label> <br>
                <input type="radio"  id="collar2"  name="collarType" value="blue" <?php isCollarChecked("blue");?>>
                    <label for="collar2">Blue Collar</label> <br>
                <input type="radio"  id="collar3"  name="collarType"  value="red" <?php isCollarChecked("red");?>>
                    <label for="collar3">Red Collar</label> <br>
                <input type="radio"  id="collar4"  name="collarType" value="tie" <?php isCollarChecked("tie");?>>
                    <label for="collar4">Tie</label> <br><br>
                    
                Cat Features: <br>
                <input type="checkbox" id="feature1"  name="features[]" value="spots" <?php isFeatureChecked("spots");?> >
                    <label for="feature1"> Spots </label>
                <input type="checkbox" id="feature2" name="features[]" value="striped" <?php isFeatureChecked("striped");?> >
                    <label for="feature2"> Striped </label> <br>
                <input type="checkbox" id="feature3"  name="features[]" value="stripedtail" <?php isFeatureChecked("stripedtail");?> >
                    <label for="feature1"> Striped Tail</label>
                <input type="checkbox" id="feature4" name="features[]" value="tailmark" <?php isFeatureChecked("tailmark");?> >
                    <label for="feature2"> Tail Marking </label> <br>
                <input type="checkbox" id="feature5" name="features[]" value="headmark" <?php isFeatureChecked("headmark");?> >
                    <label for="feature2"> Head Marking </label>
                <input type="checkbox" id="feature6"  name="features[]" value="bodymarks" <?php isFeatureChecked("bodymarks");?> >
                    <label for="feature1"> Body Markings </label> <br>
                <input type="checkbox" id="feature7"  name="features[]" value="dots" <?php isFeatureChecked("dots");?> >
                    <label for="feature1"> Dots </label> <br>
                <br /> <br />
                <input name="catSubmit" type="submit" id="catSubmit" value="Create your cat!"/>
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