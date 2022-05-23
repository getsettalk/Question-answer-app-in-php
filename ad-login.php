<?php
session_start();
if (isset($_SESSION['auth'])) {
  header("location:dash.php");
}
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login for Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style type="text/css" media="all">

@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

body {
  background: #456;
  font-family: 'Open Sans', sans-serif;
}

.login {
  width: 350px;
  margin: 16px auto;
  font-size: 16px;
}

/* Reset top and bottom margins from certain elements */
.login-header,
.login p {
  margin-top: 0;
  margin-bottom: 0;
}

/* The triangle form is achieved by a CSS hack */
.login-triangle {
  width: 0;
  margin-right: auto;
  margin-left: auto;
  border: 12px solid transparent;
  border-bottom-color: #28d;
}

.login-header {
  background: #28d;
  padding: 20px;
  font-size: 1.4em;
  font-weight: normal;
  text-align: center;
  text-transform: uppercase;
  color: #fff;
}

.login-container {
  background: #ebebeb;
  padding: 12px;
}

/* Every row inside .login-container is defined with p tags */
.login p {
  padding: 12px;
}

.login input {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border-width: 1px;
  border-style: solid;
  padding: 16px;
  outline: 0;
  font-family: inherit;
  font-size: 0.95em;
}

.login input[type="email"],
.login input[type="password"] {
  background: #fff;
  border-color: #bbb;
  color: #555;
}

/* Text fields' focus effect */
.login input[type="email"]:focus,
.login input[type="password"]:focus {
  border-color: #888;
}

.login input[type="submit"] {
  background: #28d;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
}

.login input[type="submit"]:hover {
  background: #17c;
}

/* Buttons' focus effect */
/* .login input[type="submit"]:focus {
  border-color
} */
    </style>
  </head>
  <body>
    <div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Log in</h2>

  <form class="login-container">
    <p><input type="email" placeholder="Email" name="email" id="email" required></p>
    <p><input type="password" placeholder="Password" name="password" id="password"></p>
    <p><input type="submit" value="Log in" name="submit" id="submit"></p>
    <div class="text-center">
      <p id="msg"></p>
    </div>
    
  </form>
</div>

<script type="text/javascript" charset="utf-8">
  $(function(){
    $("#submit").click(function(e){
      e.preventDefault();
      var email = $("#email").val();
      var pass =$("#password").val();
      if(email =="" || email ==" "){
        alert("Please Enter Valid Email id");
      }else {
        if(pass =="" || pass ==" "){
          alert("Please Enter Your Password");
        }else {
          $("#submit").attr("disabled",true);
          $("#msg").html("Please wait...");
          $.ajax({
            url:"php/do-login.php",
            type:"post",
            data:{e:email,p:pass},
            success:function(data){
           console.log(data);
              if(data =="success"){
                $("#msg").html("<span style='color:#6dcf24;'>Login success, Redirecting...</span>");
              // here are not writtern extension of file because we have remove .php using .htaccess
                window.location.href="admin/dash"; 
              }else if(data =="failed"){
                $("#submit").attr("disabled",false);
              $("#msg").html("<span style='color:rgb(247,102,0);'>Login Failed,Enter Valid Information...</span>");
              }else {
                $("#submit").attr("disabled",false);
                $("#msg").html(data);
              }
            }
          });
        }
      }
      
      
    });
  });
</script>
  </body>
</html>