<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/login.css">
</head>


<body>


<div class="login">

    <div class="content">
        <h2>LOGIN</h2>

        <label for="">Username</label>
        <input id="username" type="text" placeholder="Username" >

        <label for="">Password</label>
        <input id="password" type="password" placeholder="Password" maxlength="8" >

        <button id="button" > Login</button>

        <p id="error" style="color: red; display:none;" >please fill the detiles</p>

    </div>
</div>

<?php 
  
 

?>
<script>
 
  const usernameinput=document.getElementById('username');
  const passwordinput=document.getElementById('password');
  const loginbutton=document.getElementById('button');
  const errortext=document.getElementById('error');

  loginbutton.addEventListener('click',()=>{

    if (usernameinput.value.trim()==="" || passwordinput.value.trim()===""){
        errortext.style.display='block';
    }else{
        errortext.style.display='none';
        alert('login successfull!');
    }


  });

  

</script>
</body>
</html>