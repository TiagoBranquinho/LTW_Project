<?php 
    $counter = $_POST['resquestsNr'];
    $start = 1;
    while($counter > 0){
        if(isset($_POST['element' . $start])){
            echo "dish id " . $_POST['element' . $start] . "quantity " . $_POST['quantity' . $start];
            $counter--;
        }
        $start++;
    };?>

