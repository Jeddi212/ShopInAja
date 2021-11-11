@extends('layouts.app')

@section('title', 'Sign Up |')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <div class="columns justify-content-center">
        <div class="column">
            <div class="card">
                <div class="card-header-title">Identity</div>
                    <div class="card-content"> 
                        <form name="register" method="post" action="{{ route('auth.register') }}" enctype="multipart/form-data">
                            @csrf
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
                                <br>
                                <span class="ajax" id="usedUsername"></span><br>
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
                                <input class="input" type="password" id="p1" required name="password" onkeyup="cekPassword()" placeholder="Password">
                                <br><br>
                            </div>
                            <div class="field">
                                <label for="date">Confirm Password</label>
                                <br>
                                <input class="input" type="password" id="p2" required name="Cpassword" onkeyup="cekPassword()" placeholder="Confirm Password">
                                <br>
                                <span class="ajax" id="validPassword"></span><br>
                            </div>

                            <button type="submit" class="button is-primary hvr-glow" style="color: #030303" id="submitBtn" disabled onclick="return confirm('Please confirm your registration')">
                                <span class="icon">
                                    <i class="fi-xwsuxl-plus-solid"></i>
                                </span>
                                <b>Submit</b>
                            </button>
                            <a class="button is-warning hvr-buzz" href="{{ route('product.all') }}" onclick="return confirm('This will discard your data. Are you sure?')">
                                <span class="icon">
                                    <i class="fi-xnsuxl-times-solid"></i>
                                </span>
                                <b style="color: black;">Discard</b>
                            </a>
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

        var shortWarn = "Password must have at least 8 characters";
        var notMatchWarn = "Password not match";
        var match = "Password match";
        var warn = document.getElementById('validPassword').innerText;
        var used = "Username has been used";

        if(pass2.length==0){
            document.getElementById("validPassword").innerHTML="";
            document.getElementById("submitBtn").disabled = true;
            return;
        }

        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                if(xmlhttp.responseText == match){
                    document.getElementById("submitBtn").disabled = false;
                }else if(xmlhttp.responseText == notMatchWarn ||xmlhttp.responseText == shortWarn){
                    document.getElementById("submitBtn").disabled = true;
                }
                if(document.getElementById("usedUsername").innerHTML==used){
                    document.getElementById("submitBtn").disabled = true;
                }
                document.getElementById("validPassword").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","ajaxPassword/cekPassword.php?q="+pass2+"&r="+pass1,true);
        xmlhttp.send();
    }
    function cekUsername(str){
        if(str.length==0){
            document.getElementById("usedUsername").innerHTML="";
            return;
        }

        var used = "Username has been used";
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                if(xmlhttp.responseText != used){
                    document.getElementById("submitBtn").disabled = false;
                }else{
                    document.getElementById("submitBtn").disabled = true;
                }
                document.getElementById("usedUsername").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","ajaxUsername/cekUsername.php?q="+str,true);
        xmlhttp.send();
    }
</script>
@endsection