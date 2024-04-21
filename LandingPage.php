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

   .login-buttons .w3-dropdown-click {
    float: none !important;
    
   }
   
   .dropdown .w3-button {
    vertical-align: 0;
   }

   #main_header{
    padding-bottom: 10px;
    border-bottom: 2px dashed black;
   }

   .game_box {
    border: 2px dashed black;
   }

   .table-header {
    display: flex;
    justify-content: center;
    align-items: center;
   }
   
   .rank {
    width: 100lvw;
   }

   .title {
    width: 3000px;
   }

   .score {
    width: 100lvw;
   }

 
  </style>
  <header class="w3-container w3-red header">
      <div class="w3-left-align">
        <h1>Videogame Database</h1>
      </div>
    <?php 
      if($_SESSION['username'] == ""){
    ?>
      <div class="w3-bar w3-right-align login-buttons ">    
        <a href="Login.php"><button class="w3-button w3-border w3-blue">Login!</button></a>
        <a href="SignUp.php"><button class="w3-button w3-yellow">Sign Up!</button></a>
      </div>
    <?php  }
    ?>

    <?php 
      if($_SESSION['username'] != ""){
    ?>
      <div class="w3-bar w3-right-align login-buttons ">
        <p>Welcome back,</p> 
        <div class="w3-dropdown-click dropdown">
        <button onclick="dropdown()" class="w3-button  w3-red"><?php echo $_SESSION['username'] ?></button>
            <div id="Profile-Choices" class="w3-dropdown-content w3-bar-block w3-border">
                <a href="Profile.php" class="w3-bar-item w3-button">Profile</a>
                <a href="Profile_editor.php" class="w3-bar-item w3-button">Profile Editor</a>
                <a href="Logout.php" class="w3-bar-item w3-button">Logout</a>
            </div>
        </div>
      </div>
    <?php
      }
    ?>

  

    <script>
    function dropdown(){
        var x = document.getElementById("Profile-Choices");
        if (x.className.indexOf("w3-show") == -1) {
             x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
     }
    }
  </script>

  </header>

  <body>
    <div class="w3-bar w3-green">
      <a href="LandingPage.php" class="w3-bar-item w3-button w3-border-right">Home</a>
      <a href="#" class="w3-bar-item w3-button w3-border-right">Link 1</a>
      <a href="#" class="w3-bar-item w3-button w3-border-right">Link 2</a>
      <a href="#" class="w3-bar-item w3-button w3-border-right">Link 3</a>
    </div>

    <div class="w3-container w3-blue main_page">
      <p id="main_header"><strong>Top Games</strong></p>
      <div class="game_box">
        <table class="table-header">
          <tr>
            <td class="w3-red rank">Rank</td>
            <td class="w3-teal title">Title</td>
            <td class="w3-green score">Score</td>
          </tr>



          </tr>
        </table>
      </div>
    </div>
    

    
  </body>
</html>
