<?php

class FormSanitizer {
  
  public static function sanitizeFormString(string $inputString): string 
  {
    $inputString = strip_tags($inputString);
    $inputString = str_replace(" ", "" ,$inputString);
    $inputString = strtolower($inputString);
    $inputString = ucfirst($inputString);

    return $inputString;
  }

  public static function sanitizeFormUsername(string $inputString): string 
  {
    $inputString = strip_tags($inputString);
    $inputString = str_replace(" ", "" ,$inputString);
   

    return $inputString;
  }

  public static function sanitizeFormPassword(string $inputString): string
  {
    $inputString = strip_tags($inputString);
   

    return $inputString;
  }

   public static function sanitizeFormEmail(string $inputString): string
   {
    $inputString = strip_tags($inputString);
    $inputString = str_replace(" ", "" ,$inputString);
   

    return $inputString;
  }
}