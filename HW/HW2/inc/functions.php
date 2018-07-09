<?php

function play() {
    //First number: body, second: eyes, third: number of extra features.
    $catFeatureArray = array(rand(1,9),rand(1,5),rand(0,3));

    displayCat($catFeatureArray);
}

function displayCat($catFeatures) {
    displayBody($catFeatures[0]);
    displayEyes($catFeatures[1]);
    displayFeatures($catFeatures[2], 10);
    
    switch ($catFeatures[0]) {
        case 1: $bodycolor = "white";
                break;
        case 2: $bodycolor = "gray";
                break;
        case 3: $bodycolor = "orange";
                break;
        case 4: $bodycolor = "dark gray"; 
                break;
        case 5: $bodycolor = "yellow"; 
                break;
        case 6: $bodycolor = "red"; 
                break;
        case 7: $bodycolor = "maroon"; 
                break;
        case 8: $bodycolor = "blue"; 
                break;
        case 9: $bodycolor = "green"; 
                break;
    }
    
    switch ($catFeatures[1]) {
        case 1: $eyecolor = "white";
                break;
        case 2: $eyecolor = "gray";
                break;
        case 3: $eyecolor = "brown";
                break;
        case 4: $eyecolor = "hazel"; 
                break;
        case 5: $eyecolor = "magenta"; 
                break;
    }
    
    echo "<h2><center>You created a $bodycolor cat with $eyecolor eyes!</center></h2>";
}

function displayBody($catBody) {
    echo "
    <div id='divCatBody'>
        <img id='catBody' src='img/blankcat$catBody.png' alt='catbody' title='catbody' width='270' />
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

function displayFeatures($catFeatures, $totalFeatures) {
    $addedFeatures = array();
    for ($i=1; $i<=$catFeatures; $i++) {
        do {
            $featureNum = rand(1,$totalFeatures);
            if(count($addedFeatures) == 0 or !in_array($featureNum, $addedFeatures)) {
                echo "
                    <div id='divCatFeature'>
                        <img id='catFeature' src='img/feat$featureNum.png' alt='catfeature' title='catfeature' width='270' />
                    </div>    
                ";
            }
        } while(in_array($featureNum, $addedFeatures));
        $addedFeatures[] = $featureNum;
    }
}
?>