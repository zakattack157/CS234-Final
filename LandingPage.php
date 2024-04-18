<?php require_once 'DBconnect.php';
session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Game Database</title>
  </head>
  <style>
   .header{
    display: flex;
    align-items: center;
    justify-content: space-between;
   }

   .header h1{
    white-space: nowrap;
   }

   .login-buttons p{
    display: inline-block;
   }

 
  </style>
  <header class="w3-container w3-red header">
      <div class="w3-left-align">
        <h1>Game Recommender</h1>
      </div>
      <div class="w3-bar w3-right-align login-buttons ">
        <p>Welcome back,</p>     
        <a href="Login.php"><button class="w3-button w3-blue">Login!</button></a>
        <a href="SignUp.php"><button class="w3-button w3-yellow">Sign Up!</button></a>
      </div>
    </div>
  </header>

  <body>
    
    <div class="column">
      <div class="column1">
        <h2>Column 1</h2>
        <p>asdfasdfasdf</p>
      </div>

      <div class="column1">
        <h2>column2</h2>
        <p>asdf</p>
      </div>
    
  </body>
</html>
