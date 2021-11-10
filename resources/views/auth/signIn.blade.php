@extends('layouts.app')

@section('title', 'Sign In |')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <div class="columns justify-content-center">
        <div class="column">
            <div class="card">
                <div class="card-header-title">Identity</div>
                    <div class="card-content"> 
                        <form name="register" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                            <div class="field">
                                <label for="date">Name</label>
                                <br>
                                <input class="input" type="text" name="name" required placeholder="Name">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="date">Username</label>
                                <br>
                                <input class="input" type="text" name="username" onkeyup="cekUsername(this.value)" required placeholder="Username">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="date">Gender</label>
                                <br>
                                <table class="table" style="width:35%">
                                    <tr><td><input type="radio" name="gender" value="male" style="height:inherit"></td><td>Male</td>
                                    <td><input type="radio" name="gender" value="female" style="width:inherit"></td><td>Female</td></tr>
                                </table>
                            </div>
                            <div class="field">
                                <label for="date">Email</label>
                                <br>
                                <input class="input" type="email" required name="email" placeholder="Email">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="date">Password</label>
                                <br>
                                <input class="input" type="password" required name="password" id="p1" placeholder="Password">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="date">Confirm Password</label>
                                <br>
                                <input class="input" type="password" id="p2" required name="Cpassword" onkeyup="cekPassword()" placeholder="Confirm Password">
                                <br><br>
                            </div>
                            <span class="ajax" id="validPassword"></span><br>

                            <button type="submit" class="button is-primary" style="color: #030303">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>            
        
<script>
function cekPassword(){
    var pass1 = document.getElementById("p1").value;
    var pass2 = document.getElementById("p2").value;
    if(pass2.length==0){
        document.getElementById("validPassword").innerHTML="";
        return;
    }
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status==200){
            document.getElementById("validPassword").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","ajax/cekPassword.php?q="+pass2+"&r="+pass1,true);
    xmlhttp.send();
}
</script>
@endsection