<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Editor</title>
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
    border-bottom: 1px solid black;
   }

 

   .file_upload {

        border: 2px dashed;
        width: 250px;
        height: 375px;
        
    }

    #upload-picture {
        cursor: pointer;
    }

    #image-preview {
      width: 300px; 
      height: 200px; 
      overflow: hidden; 
      
    }

    #preview {
      display: flex;
      margin-left: 25px;
      margin-top: 5px;
      width: 200px;
      height: 200px;
      overflow: hidden;
      border-bottom: 1px solid grey ;

    }

    .about_me {
        margin-left: 250px;
        position: relative;
        top: -375px;
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

    #text_box {
        width: 100%;
        height: 83%;
        
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
    
    <div class="w3-container w3-yellow profile_header">
        <h5><strong><?php echo $_SESSION['username']?>'s Profile</strong></h5>
    </div>

    <div class="w3-container w3-blue profile">
        <form method="POST" enctype="multipart/form-data">
            <div class="file_upload" >
                <input class="w3-input" type="file" id="upload-picture" name="upload-picture" accept="image/jpeg"><br>
                <img id="preview" src="#" alt="Image Preview"><br><br>
            </div>

            <script>
                const fileInput = document.getElementById('upload-picture');
                const imagePreview = document.getElementById('preview');

                fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
            </script> 

            <div class="about_me">
                <div class="w3-container w3-red about_me_header">
                    <p><strong>About Me:</strong></p>
                </div>
                <textarea id="text_box" name="message"></textarea> 

            </div>

            <button type="submit" class="w3-btn w3-black" name="submit">Apply Changes</button>
        </form>
    </div>

        <?php
        if(isset($_POST['submit']) && isset($_FILES['upload-picture'])){
            $file_tmp = $_FILES['upload-picture']['tmp_name'];
            $file_content = file_get_contents($file_tmp);
            


            $dsn = 'mysql:host=localhost;dbname=vglib';
            $username_db = 'php';
            $password_db = 'admin';

            try {
                $pdo = new PDO($dsn, $username_db, $password_db);
            } 
            catch (PDOException $e) {
                die('Connection failed');
            }

            $username = $_SESSION['username'];

            if(!isset($_SESSION['pfp'])){
                $sql = "INSERT INTO profile_info (Username, Profile_Picture) VALUES (:username, :pfp)";
                $statement = $pdo->prepare($sql);

                $statement->bindParam(':username', $username);
                $statement->bindParam(':pfp', $file_content);
                $inserted = $statement->execute();
           }

            else{
                $sql = 'UPDATE profile_info SET Profile_Picture = ? WHERE Username = ?';
                $statement = $pdo->prepare($sql);
                $statement->execute([$file_content, $username]);

                $sql = 'SELECT Profile_Picture FROM profile_info WHERE Username = ?';
                $statement = $pdo->prepare($sql);
                $statement->execute([$username]);
                $info = $statement->fetch();

                $pfp_blob = $info['Profile_Picture']; 
                $base64_pfp = base64_encode($pfp_blob);
                $_SESSION['pfp'] = $base64_pfp;
                
            }


        }

        if(isset($_POST['submit']) && isset($_POST['message'])){
            $dsn = 'mysql:host=localhost;dbname=vglib';
            $username_db = 'php';
            $password_db = 'admin';
    
            try {
                $pdo = new PDO($dsn, $username_db, $password_db);
            } 
            catch (PDOException $e) {
                die('Connection failed');
            }
            $message = $_POST['message'];
        
            $sql = 'UPDATE profile_info SET About_User = ? WHERE Username = ?';
            $statement = $pdo->prepare($sql);
            $statement->execute([$message, $username]);

            $sql = 'SELECT About_User FROM profile_info WHERE Username = ?';
            $statement = $pdo->prepare($sql);
            $statement->execute([$username]);
            $message = $statement->fetch();

            $_SESSION['message'] = $message;
            
        }
        ?>

    

  </body>
</html>
