<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        font-family: monospace;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f5f5f5;
    }

 .login{
    width: 100%;
    max-width: 400px;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;

 }

 .login .content{
    text-align: center;
 }

.login h2{

    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.login label{
    display: block;
    text-align: left;
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
    

}

.login input[type="text"],
.login input[type="password"]{

    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

.login input[type="password"]:focus,
.login input[type="text"]:focus{
    border-color: #007BFF;
    outline: none;
    box-shadow: 0 0 5px rgba(0,123,255,0.5);
}

.login button {
    width: 100%;
    max-width: 30%;
    padding: 10px;
    border-radius: 6px;
    border: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
    background:#333;
    color: #fff;


}







</style>

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