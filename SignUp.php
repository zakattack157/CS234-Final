<?php require_once 'DBconnect.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
  </head>
  <style>
    .header {
      display: flex;
      width: 100%;
    }

    .header h1 {
      white-space: nowrap;
    }

    .signup {
      margin-left: 30%;
      margin-right: 30%;
    }

    .form {
      margin-left: 30%;
      margin-right: 30%;
    }
  </style>

  <body>
    <header class="w3-container w3-red header">
      <div class="w3-left-align">
        <h1>Game Recommender</h1>
      </div>
    </header>

    <div class="w3-container w3-section w3-yellow signup">
      <h2 class="w3-center">Registration Form:</h2>
      <p class="w3-center">
        Please fill out the following information to register your account.
      </p>
    </div>

    <form action="register_backend.php" method="POST" class="w3-container w3-teal form">
      <p>
        <label>Email</label>
        <input
          class="w3-input"
          type="email"
          id="email"
          name="email"
          placeholder="example@gmail.com"
          required
        />
      </p>

      <p>
        <label>Username</label>
        <input
          class="w3-input"
          type="text"
          id="username"
          name="username"
          placeholder="Enter a unique username"
          required
        />
        (between 6-14 characters)
      </p>

      <p>
        <label>Password</label>
        <input
          class="w3-input"
          type="text"
          id="pass"
          name="pass"
          placeholder="Enter a strong password"
          required
        />
        (Must be at least 8 characters with a digit and special character ie.
        !,#,etc)
      </p>

      <p>
        <label>Birthday</label>
        <input 
         class="w3-input"
         type="date" 
         id="birthdate"
         name="birthdate" 
         required />
      </p>

      <button 
      type="submit" class="w3-btn w3-blue">Register</button>
    </form>
  </body>
</html>
