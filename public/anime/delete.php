<?php

require '../../database.php'; // Require the database.php file
require '../../functions.php'; // Require the functions.php file



// Get the ID from the query string if it doesn't exist the value will be null.
$id = $_POST['animeId'] ?? null;

// If there is no ID redirect to index.php
// We do this because we only want to visit this site if we want to delete something 
if (!$id) {
    header('Location: /anime'); // Redirect to index.php 
    exit; // Ensure that no further code is executed after the redirect
};
// DELETE THE IMAGE FROM THE SYSTEM
$statement = $pdo->prepare('SELECT poster FROM anime WHERE animeId = ?;'); // Prepare Query (Get the filepath of the image from the database)
$statement->execute([$id]); // Execute Query
$result = $statement->fetch(PDO::FETCH_ASSOC); // Fetch results as an associative Array
$filePath = $result['poster'] ?? null; // if $result is empty assign null instead.

// DELETE A ROW FROM THE DATABASE
$statement = $pdo->prepare('DELETE FROM anime WHERE animeId = ?'); // Prepare Query (Delete row from db)
$statement->execute([$id]); // Execute Query


// Delete File & directory if it exists
if ($filePath && file_exists($filePath)) {
    unlink($filePath); // Delete File 
    rmdir(dirname($filePath)); // Delete Directory (NOTE: DIRECTORY MUST BE EMPTY OR ELSE IT WONT WORK)
}

// Redirect to index.php after deleting 
header('Location: /anime'); // Redirect to index.php 
exit; // Ensure that no further code is executed after the redirect

