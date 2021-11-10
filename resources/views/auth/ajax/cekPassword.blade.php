<?php
    $q = $_GET["q"];  
    $r = $_GET["r"];
    if($q!=$r){
        echo "Password not match";
    }else{
        echo "Password match";
    }
?>