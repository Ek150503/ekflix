<?php
    if(isset($_POST["submit"])) {
        echo "Form was submitted";
    }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="./assets/styles/styles.css" />
  <title>Welcome to Ekflix</title>
</head>

<body>

  <div class="signInContainer">

    <div class="column">

      <div class="header">
        <img src="assets/images/ekflix.png" title="Logo" alt="Site logo" />
        <h3>Sign In</h3>
        <span>to continue to Reeceflix</span>
      </div>

      <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="submit" name="submit" value="SUBMIT">

      </form>

      <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>

    </div>

  </div>

</body>

</html>