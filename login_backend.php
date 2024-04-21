<?
session_start();
function confirm_creds($username, $password, $pdo){
    $sql = 'SELECT `Password` FROM user_info WHERE Username = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$username]);
    
    $creds = $statement->fetch();

    if(!$creds){
        return 'nonexistent';
    }

    $pass_hash = $creds['Password'];

    if(password_verify($password, $pass_hash)){
        return 'good creds';
    }

    else{
        return 'bad creds';
    }

}

function fetch_pfp($username, $pdo){
    $sql = 'SELECT Profile_Picture FROM profile_info WHERE Username = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$username]);

    $info = $statement->fetch();
    $pfp_blob = $info['Profile_Picture'];
    $pfp_base64 = base64_encode($pfp_blob);
    return $pfp_base64;
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['pass'];

    $dsn =  'mysql:host=localhost;dbname=vglib';
    $username_db = 'php';
    $password_db = 'admin';

    try{
        $pdo = new PDO($dsn, $username_db, $password_db);
    }

    catch(PDOException $e){
        die('Connection failed');
    }

    $check_acct = confirm_creds($username, $password, $pdo);


    if($check_acct == 'good creds'){
        $_SESSION['username'] = $username;
        $profile_pic = fetch_pfp($username, $pdo);
        $_SESSION['pfp'] = $profile_pic;
        $currentTime = time();

        $sql = 'UPDATE profile_info SET last_online = CURRENT_TIMESTAMP WHERE Username = ?';
        $statement = $pdo->prepare($sql);
        $statement->execute([$username]);        

        $_SESSION['time'] = "Last online: now";
        
        header('Location: LandingPage.php');
        exit();
    }

    else{
        echo 'Incorrect login information!';
    }
}