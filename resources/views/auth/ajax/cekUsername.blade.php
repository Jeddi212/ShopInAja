<?php
namespace Resources\Views\Auth\Ajax;

use Illuminate\Support\Facades\Redis;
    // $sql=mysqli_connect("localhost","root","","tubes");
    // $result = mysqli_query($sql,"SELECT*FROM accountList");
    // while($row = mysqli_fetch_row($result)){
    //     $a[]=$row[2];
    // }
    function getAccounts($start = 0, $end = -1) : array  
    {  
        $accountIds = Redis::zRange('accounts', $start, $end, true);  
        $accounts = [];  
        $usernames = [];
    
        foreach ($accountIds as $accountId => $score) 
        {  
            $accounts[$score]= Redis::hGetAll("account:$accountId");  
        } 

        return $accounts;
    }
    $q = $_GET["q"];

    $cek=false;
    $accounts = getAccounts();
    foreach($accounts as $value){
        if(strcmp($q,$value["username"])==0){
            $cek=true;
        }
    }
    
    if($cek==true){
        echo "Username has been used";
    }
?>