<?php
    $sql=mysqli_connect("localhost","root","","tubes");
    $result = mysqli_query($sql,"SELECT*FROM accountList");
    while($row = mysqli_fetch_row($result)){
        $a[]=$row[2];
    }

    $q = $_GET["q"];

    $cek=false;
    foreach($a as $value){
        if(strcmp($q,$value)==0){
            $cek=true;
        }
    }
    
    if($cek==true){
        echo "Username has been used";
    }
?>