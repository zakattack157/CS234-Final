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

    <br /><br />

    <form action="login_backend.php" method="post" class="w3-container w3-teal form">
      <p>
        <label>Username</label>
        <input
          class="w3-input"
          type="text"
          id="username"
          name="username"
          placeholder="Enter username"
          required
        />
      </p>

      <p>
        <label>Password</label>
        <input
          class="w3-input"
          type="password"
          id="pass"
          name="pass"
          placeholder="Enter password"
          required
        />
      </p>

      <button class="w3-btn w3-blue">Login</button>
    </form>
  </body>
</html>
