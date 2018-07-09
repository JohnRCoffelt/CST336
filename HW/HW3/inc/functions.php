<?php

function play() {
    session_start();
    $_SESSION["nameErr"] = "";
    $_SESSION["collarErr"] = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $_SESSION["catName"] = $_POST["catName"];
        $_SESSION["catColor"] = $_POST["catColor"];
        $_SESSION["eyeColor"] = $_POST["eyeColor"];
        $_SESSION["collarType"] = $_POST["collarType"];
        $_SESSION["catFeatures"] = $_POST["features"];
        
    	if(isValidEntry()){
    	    displayCat();
    	}
    }
}

function isSelectedCatColor($color) {
    if($_SESSION["catColor"] == $color) {
        echo "selected='selected'";
    }
}

function isSelectedEyeColor($color) {
    if($_SESSION["eyeColor"] == $color) {
        echo "selected='selected'";
    }
}

function isCollarChecked($collar) {
    if($_SESSION["collarType"] == $collar) {
        echo "checked";
    }
}

function isFeatureChecked($feature) {
    if(isset($_SESSION["catFeatures"])) {
        if(in_array($feature, $_SESSION["catFeatures"])) {
            echo "checked";
        }
    }
}

function isValidEntry() {
    if (empty($_SESSION["catName"])) {
        $_SESSION["nameErr"] = "Name is required!";
        return false;
    }
    if (empty($_SESSION["collarType"])) {
        $_SESSION["collarErr"] = "Please select an option!";
        return false;
    }
    return true;
}

function displayCat() {
    displayBody($_SESSION["catColor"]);
    displayEyes($_SESSION["eyeColor"]);
    displayCollar($_SESSION["collarType"]);
    displayFeatures($_SESSION["catFeatures"]);
    
    echo "
    <div id='divCatName'>
        <center>{$_SESSION["catName"]}</center>
    </div>
    ";
}

function displayBody($catBody) {
    
    switch ($catBody) {
        case "White": $bodycolor = "white";
                break;
        case "Grey": $bodycolor = "gray";
                break;
        case "Orange": $bodycolor = "orange";
                break;
        case "Black-ish": $bodycolor = "#454141"; 
                break;
        case "Yellow": $bodycolor = "yellow"; 
                break;
        case "Red": $bodycolor = "red"; 
                break;
        case "Maroon": $bodycolor = "maroon"; 
                break;
        case "Blue": $bodycolor = "#0F7093"; 
                break;
        case "Green": $bodycolor = "green"; 
                break;
    }
    
    echo "
    <div id='divCatBody' style='background-color:$bodycolor'>
        <img id='catBody' src='img/blank.png' alt='catbody' title='catbody' width='270' />
    </div> 
    ";
}

function displayEyes($catEyes) {
    echo "
    <div id='divCatEyes'>
        <img id='catEyes' src='img/eyes$catEyes.png' alt='cateyes' title='cateyes' width='270' />
    </div>    
    ";
    
}

function displayCollar($catCollar) {
    if($catCollar != "none"){
        echo "
        <div id='divCatCollar'>
            <img id='catEyes' src='img/collar$catCollar.png' alt='catcollar' title='catcollar' width='270' />
        </div>    
        ";
    }
}

function displayFeatures($catFeatures) {
    if(!empty($catFeatures)) {
        for ($i=0; $i<count($catFeatures); $i++) {
            echo "
                <div id='divCatFeature'>
                    
                    <img id='catFeature' src='img/feat{$catFeatures[$i]}.png' alt='catfeature' title='catfeature' width='270' />
                </div>    
            ";
        }
    }
}
?>