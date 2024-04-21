<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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

   .profile_header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid black;
        }

    .profile_header h5 {
      margin-left: 16px; 
    }

    .profile_header a {
      margin-right: 16px;
    }

    .pfp {
      border: 2px dashed;
      margin-top: 5px;
      margin-right: 85%;
      width: 250px;
      height: 325px;
    }

    .pfp_size {
      display: flex;
      margin-left: 25px;
      margin-top: 25px;
      width: 200px;
      height: 200px;
      overflow: hidden;
      
    }

    .about_me {
      margin-left: 250px;
      position: relative;
      top: -325px;
      border: 2px dashed;
      height: 150px;
      border-left: none;
    }

    .about_me_header {
      display: flex;
      height: 25px;
      font-size: 12px;
      align-items: center;
    }

    .text_area {
      padding-left: 16px;
      margin-top: 10px;
    }

    #joined {
      padding-left: 25px;
    }

    #online {
      padding-left: 25px;
    }


  </style>

  <header class="w3-container w3-red header">
      <div class="w3-left-align">
        <h1>Game Recommender</h1>
      </div>

      <div class="w3-bar w3-right-align login-buttons">
        <p>Welcome back,</p> 
        <div class="w3-dropdown-click dropdown">
        <button onclick="dropdown()" class="w3-button  w3-red"><?php echo $_SESSION['username'] ?></button>
            <div id="Profile-Choices" class="w3-dropdown-content w3-bar-block w3-border">
                <a href="Profile.php" class="w3-bar-item w3-button">Profile</a>
                <a href="#" class="w3-bar-item w3-button">Friends</a>
                <a href="Logout.php" class="w3-bar-item w3-button">Logout</a>
            </div>
        </div>
      </div>
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
    
    <div class="w3-yellow profile_header">
        <h5><strong><?php echo $_SESSION['username']?>'s Profile</strong></h5>
        <a href="Profile_editor.php"> Profile settings</a>
    </div>

    <div class="w3-container w3-blue">
        <div class="pfp">
        <img class="pfp_size" src="data:image/jpeg;base64,<?php echo $_SESSION['pfp']; ?>" alt="Profile Picture">
        <p id="online"><?php echo $_SESSION['time']; ?></p>
        <p id="joined">Joined:
          <?php
            $username = $_SESSION['username'];
            $dsn = 'mysql:host=localhost;dbname=vglib';
            $username_db = 'php';
            $password_db = 'admin';
                 
            try {
              $pdo = new PDO($dsn, $username_db, $password_db);
            } 
            catch (PDOException $e) {
              die('Connection failed');
            }

            $sql = 'SELECT Join_Date FROM user_info WHERE Username = ?';
            $statement = $pdo->prepare($sql);
            $statement->execute([$username]);
            $date = $statement->fetch();
            $date = $date['Join_Date'];

            $timestamp = strtotime($date);
            $formatdate = date("F j, Y", $timestamp);
            $_SESSION['join_date'] = $formatdate;
            echo $_SESSION['join_date'];
          ?></p>
        
        </div>

        <div class="about_me">
          <div class="w3-container w3-red about_me_header">
            <p><strong>About Me:</strong></p>
          </div>

          <?php 
            $username = $_SESSION['username'];
            $dsn =  'mysql:host=localhost;dbname=vglib';
            $username_db = 'php';
            $password_db = 'admin';
              
            try{
              $pdo = new PDO($dsn, $username_db, $password_db);
            }
          
            catch(PDOException $e){
              die("connection failed");
            }
          
            $sql = 'SELECT About_User FROM profile_info WHERE Username = ?';
            $statement = $pdo->prepare($sql);
            $statement->execute([$username]);
            $message = $statement->fetch();
            $_SESSION['message'] = $message['About_User'];
          ?>

          <p class="text_area"><?php echo $_SESSION['message']; ?>

        </div>

          
        </div>
    </div>

  </body>
</html>
