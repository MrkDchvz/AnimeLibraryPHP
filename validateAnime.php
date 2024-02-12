<?php

if ($poster && $poster['error'] === UPLOAD_ERR_OK) {
      
    // Check if the poster is already in the database
    if (!$posterPath || $posterPath === "") {
      $randomString = randomStringGenerator(8);
      // Check if the randomly generated string already exists 
      // if it exists assign a new one, else break the while loop 
      while (existPath(__DIR__. '/' . 'public/'.'poster/' . $randomString)) {
        $randomString = randomStringGenerator(8);
      }
      // Create filename 
      $posterPath = __DIR__. '/'. 'public/'. 'poster/' . $randomString . '/' . $poster['name'] ;
      // create directory
      mkdir(dirname($posterPath)); 
      // Move the uploaded image from the temp directory to the directory that has been created prior.
      move_uploaded_file($poster['tmp_name'], $posterPath);
      // if poster is not defined, set the posterPath to empty string 
    }

    else {
      // If the poster is already in the database, we need to remove the old poster
      unlink(__DIR__. $posterPath);
      $posterParts = explode('/', $posterPath);
    //   The directory excluding the file name
      $dirBeforeFile = count($posterParts) - 2;
      $posterPath = "";
      for ($i = 0; $i < $dirBeforeFile; $i++) {
        $posterPath .= $posterParts[$i] . '/';
      }
        $posterPath .= $poster['name'];
      move_uploaded_file($poster['tmp_name'],  $posterPath);
    }

  } else {
    // Error code handling on file upload
    switch($poster['error']) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        $errors[] = "File is too large.";
        break;
      case UPLOAD_ERR_PARTIAL:
        $errors[] = "File is partially uploaded.";
        break;
      // Had to disable this one because file is optional
      // case UPLOAD_ERR_NO_FILE:
      //   $errors[] = "No file was uploaded.";
      //   break;
      case UPLOAD_ERR_NO_TMP_DIR:
        $errors[] = "Missing a temporary folder.";
        break;
      case UPLOAD_ERR_CANT_WRITE:
        $error[] = "Failed to write file to disk.";
        break;
    }  
  }
