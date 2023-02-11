<?php
  require_once("./includes/classes/FormSanitizer.php");
  require_once("./includes/config.php");

  if(isset($_POST["submit"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstname"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastname"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);	
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
    
  }

?>

<!DOCTYPE html>
<html lang="en">

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
        <img src="./assets/images/ekflix.png" title="LOGO" alt="Site Logo" />
        <h3>Sign Up</h3>
        <span>to continue to Ekflix</span>
      </div>
      <form method="post">
        <input type="text" placeholder="First Name" name="firstname" required />
        <input type="text" placeholder="Last Name" name="lastname" required />
        <input type="text" placeholder="Username" name="username" required />
        <input type="email" placeholder="Email" name="email" required />
        <input type="email" placeholder="Confirm Email" name="email2" required />
        <input type="password" placeholder="Confirm Password" name="password" required />
        <input type="password" placeholder="Confirm Password" name="password2" required />
        <input type="submit" name="submit" value="SUBMIT" required />
      </form>

      <a href="login.php" class="signInMessage">Already have an account? sign in here!</a>
    </div>
  </div>

</body>

</html>