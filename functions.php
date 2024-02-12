<?php

// Check if date is properly formmated (Year-Month-Day)
function isValidDate($dateString) {
    $dateTime = dateTime::createFromFormat("Y-m-d", $dateString);
    return $dateTime && $dateTime->format("Y-m-d") == $dateString; 
  }
  
  // Random string Generator 
  function randomStringGenerator($length) {
    $characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHINJKLMNOPQRSTUVWXYZ";
    $generatedString = "";
    for ($i = 0; $i < $length; $i++) {
      $generatedString .= $characters[rand(0, strlen($characters) -1)];
    }
    return $generatedString;
  }
  
  // function that Check if file is in directory 
  function existPath($filename) {
    return is_dir($filename);
  }
  
  // Debug code via printin it on screen
  function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
  
    die();
  }