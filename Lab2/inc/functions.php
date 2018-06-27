<?php

function play() {
    for ($i=1; $i<4; $i++) {
        ${"randomValue" . $i } = rand(0,3);
        displaySymbol(${"randomValue" . $i}, $i);
    }
    displayPoints($randomValue1, $randomValue2, $randomValue3);
}

function displayPoints($randomValue1, $randomValue2, $randomValue3) {
    echo "<div id='output'>";
    if ($randomValue1 == $randomValue2 && $randomValue2 == $randomValue3) {
        switch ($randomValue1) {
            case 0: $totalPoints = 1000;
                    echo "<h1>Jackpot!</h1>";
                    break;
            case 1: $totalPoints = 900;
                    break;
            case 2: $totalPoints = 500;
                    break;
            case 3: $totalPoints = 250;
                    break;
        }
        
        echo "<h2>You won $totalPoints points!</h2>";
    } else {
        echo "<h3> Try Again! </h3>";
    }
    echo "</div>";
}

function displaySymbol($randomValue, $num) {
    switch ($randomValue) {
        case 0: $symbol = "seven";
                break;
        case 1: $symbol = "grapes";
                break;
        case 2: $symbol = "cherry";
                break;
        case 3: $symbol = "lemon"; 
                break;
    }
    
    echo "<img id='reel$num' src='img/$symbol.png' alt='$symbol' title='". ucfirst($symbol) ."' width='70' />";
}
?>