<?php

ob_start();
session_start();

date_default_timezone_set("Asia/Phnom_Penh");

try{
  $con = new PDO("mysql:dbname=ekflex;host=localhost;", "root", "");
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

}catch(PDOException $e){
  exit("Coonection failed: " . $e->getMessage());
}