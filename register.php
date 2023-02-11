<?php
  require_once("./includes/classes/FormSanitizer.php");
  require_once("./includes/classes/Constants.php");
  require_once("./includes/classes/Account.php");
  require_once("./includes/config.php");
  require_once("./includes/classes/Utils.php");



  $account = new Account($con);

  if(isset($_POST["submit"])) {
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstname"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastname"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);	
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
    
    if($success) {
       $_SESSION["userLoggedIn"] = $username;
      header("Location: index.php");
    }
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
        <?php echo $account->getError(Constants::$first_name_characters) ?>
        <input type="text" placeholder="First Name" name="firstname" value="<?php Utils::getInputValue("username") ?>"
          required />
        <?php echo $account->getError(Constants::$last_name_characters) ?>
        <input type="text" placeholder="Last Name" name="lastname" value="<?php Utils::getInputValue("lastname")?>"
          required />
        <?php echo $account->getError(Constants::$username_characters) ?>
        <?php echo $account->getError(Constants::$username_taken) ?>
        <input type="text" placeholder="Username" name="username" value="<?php Utils::getInputValue("username")?>"
          required />
        <?php echo $account->getError(Constants::$email_doesnt_match) ?>
        <?php echo $account->getError(Constants::$email_invalid) ?>
        <?php echo $account->getError(Constants::$email_taken) ?>
        <input type="email" placeholder="Email" name="email" value="<?php Utils::getInputValue("email")?>" required />
        <input type="email" placeholder="Confirm Email" name="email2" value="<?php Utils::getInputValue("email2")?>"
          required />
        <?php echo $account->getError(Constants::$password_doesnt_match) ?>
        <?php echo $account->getError(Constants::$password_characters) ?>
        <input type="password" placeholder="Confirm Password" name="password" required />
        <input type="password" placeholder="Confirm Password" name="password2" required />
        <input type="submit" name="submit" value="SUBMIT" required />
      </form>

      <a href="login.php" class="signInMessage">Already have an account? sign in here!</a>
    </div>
  </div>

</body>

</html>