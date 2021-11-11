<?php
    $q = $_GET["q"];  
    $r = $_GET["r"];
    if(strlen($r)>=8){
        if($q!=$r){
            echo "Password not match";
        }else{
            echo "Password match";
        }
    }else{
        echo "Password must have at least 8 characters";
    }
?>
