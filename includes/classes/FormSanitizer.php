<?php

class FormSanitizer {
  
  public static function sanitizeFormString($inputString) {
    $inputString = strip_tags($inputString);
    $inputString = str_replace(" ", "" ,$inputString);
    $inputString = strtolower($inputString);
    $inputString = ucfirst($inputString);

    return $inputString;
  }
}