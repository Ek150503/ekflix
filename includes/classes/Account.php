<?php
// require_once("./Constants.php");

class Account {
  private $con;
  private $errorArray = array();

  public function __construct(object $con)
  {
    $this->con = $con;
  }

  public function register(string $fn,string  $ln,string  $un,string  $em,string  $em2,string  $pw,string  $pw2): bool
  {
    $this->validateFirstName($fn);
    $this->validateLastName($ln);
    $this->validateUserName($un);
    $this->validateEmail($em, $em2);
    $this->validatePassword($pw, $pw2);

    if(empty($this->errorArray)){
      return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
    }
    
    return false;
    
  }

  public function login(string $un, string $pw): bool
  {
    $pw = hash("sha512",$pw);

    $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
    $query->bindValue(":un", $un);
    $query->bindValue(":pw", $pw);

    $query->execute();

    if($query->rowCount() == 1){
      return true;
    }

    array_push($this->errorArray, Constants::$login_failed);
    return false;

  }

  private function insertUserDetails(string $fn, string $ln, string $un, string $em, string $pw): bool
  {
    $pw = hash("sha512", $pw);

    $query = $this->con->prepare("INSERT INTO users (firstName, lastName , username, email, password)
                                  VALUES (:fn, :ln, :un, :em, :pw)");
    $query->bindValue(':fn', $fn);
    $query->bindValue(':ln', $ln);
    $query->bindValue(':un', $un);
    $query->bindValue(':em', $em);
    $query->bindValue(':pw', $pw);

    return $query->execute();
  }

  private function validateFirstName(string $fn): void
  {
    if(strlen($fn)<2 || strlen($fn) > 25){
      array_push($this->errorArray, Constants::$first_name_characters);
    } 
  }
  private function validateLastName(string $ln): void
  {
    if(strlen($ln)<2 || strlen($ln) > 25){
      array_push($this->errorArray, Constants::$last_name_characters);
    } 
  }
  private function validateUserName(string $un): void
  {
    if(strlen($un)<5 || strlen($un) > 25){
      array_push($this->errorArray, Constants::$username_characters);
      return;
    } 

    $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
    $query->bindValue(":un", $un);

    $query->execute();

    if($query->rowCount() != 0){
      array_push($this->errorArray, Constants::$username_taken);
    }
  }

  private function validateEmail(string $em, string $em2): void
  {
    if($em != $em2){
      array_push($this->errorArray, Constants::$email_doesnt_match);
      return;
    }

    if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
      array_push($this->errorArray, Constants::$email_invalid);
      return;
    }

    $query = $this->con->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindValue(":email", $em);

    $query->execute();

    if($query->rowCount() != 0){
      array_push($this->errorArray, Constants::$email_taken);
    }

  }

  private function validatePassword(string $pw, string $pw2): void 
  {
    if($pw != $pw2){
      array_push($this->errorArray, Constants::$password_doesnt_match);
      return;
    }

    if(strlen($pw) < 8 || strlen($pw) > 25){
      array_push($this->errorArray, Constants::$password_characters);
      return;
    }
  }

  public function getError(string $error): string 
  {
    if(in_array($error, $this->errorArray)){
      return "<span class='errorMessage'>$error</span>";
    }
    return "";
  }
}