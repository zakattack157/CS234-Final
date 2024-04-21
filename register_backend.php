<?php 
    session_start();

    function does_exist($username, $password, $pdo){
        if(isset($username)){
            $sql = 'SELECT Password FROM user_info WHERE Username = ?';
            $statement = $pdo->prepare($sql);
            $statement->execute([$username]);

            $info = $statement->fetch();

            if(!$info){
                return 'nonexistent';
            }
            else{
                return 'exists';
            }
        }
    }

    function format($password, $username){
        $pass_length_regex = '/^.{8,}$/';
        $spec_char_regex = '/[\W_]/';
        $digit_regex = '/\d/';
        $user_length_regex = '/^.{6,14}$/';

        $pass_length = preg_match($pass_length_regex, $password);
        $spec_char = preg_match($spec_char_regex, $password);
        $digit  = preg_match($digit_regex, $password);
        $user_length = preg_match($user_length_regex, $username);


        if($pass_length && $spec_char && $digit && $user_length){
            return "correct";
        }
        else{
            return "incorrect";
        }
    }


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $email = $_POST['email'];
        $birthday = $_POST['birthdate'];
        $today = date('Y-m-d');

        $dsn =  'mysql:host=localhost;dbname=vglib';
        $username_db = 'php';
        $password_db = 'admin';
    
        try{
            $pdo = new PDO($dsn, $username_db, $password_db);
        }

        catch(PDOException $e){
            die("connection failed");
        }

        $check_username = does_exist($username, $password, $pdo);
        $check_format = format($password, $username);
    }

    if($check_format == "correct" && $check_username == "nonexistent"){
        $sql ='INSERT INTO user_info (Email, Username, `Password`, Birthdate, Join_Date) VALUES (:email, :username, :pass, :birthdate, :todays_date)';
        $statement = $pdo->prepare($sql);

        $pass_hash = password_hash($password, PASSWORD_BCRYPT);

        $statement->bindParam(':email', $email);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':pass', $pass_hash);
        $statement->bindParam(':birthdate', $birthday);
        $statement->bindParam(':todays_date', $today);

        $statement->execute();

        header('Location: LandingPage.php');
        exit();
    }

    else{
      //  header('Location: LandingPage.php');
        echo 'somethings wrong';
    }