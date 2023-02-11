<?php

class Utils {
  public static function getInputValue(string $name): void
  {
  if(isset($_POST[$name])){
    echo $_POST[$name];
  }
 }
 
}