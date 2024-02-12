<?php



require '../../database.php';

require '../../functions.php';

// Why is it GET?
$id = $_GET['animeId'] ?? null; 

// If there is no ID redirect to index.php
// We do this because we only want to visit this site if we want to update something 
if (!$id) {
    header('Location: index.php'); // Redirect to index.php 
    exit; // Ensure that no further code is executed after the redirect
};
$statement = $pdo->prepare("SELECT * FROM anime WHERE animeId=?");
$statement->execute([$id]);
$postId = $statement->fetch(PDO::FETCH_ASSOC);


echo $_SERVER['REQUEST_METHOD'];


$title = $postId["title"];
$studio = $postId["studio"];
$date = new DateTime($postId["releaseDate"]);
$formattedDate = $date->format('Y-m-d');
$posterOriginal = $postId["poster"];



// Checks if the request method is POST (when we submit the form)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $studio = $_POST['studio'];
  $date = new DateTime($_POST['release-date']);
  $formattedDate = $date->format('Y-m-d');


 


// Check if title is empty
  if (!$title) {
    $errors[] = 'Title is required';
  }
// Check if studio is empty
  if (!$studio) {
    $errors[] = 'Studio is required';
  }
// Check if release date is empty/valid
  if (!isValidDate($formattedDate)) {
    $errors[] = 'Release Date is invalid';
  }
// create a poster directory if it doesn't exist
  if (!is_dir('poster')) {
    mkdir('poster');
  }
// if there are no errors, insert the data to the database
  if (empty($errors)) {
    // Check if image is undefined or not
    $poster = $_FILES['poster'] ?? null;
    $posterPath = $posterOriginal ?? null;
    // Check if poster is defined
    require '../../validateAnime.php';


  $posts = $pdo->prepare('UPDATE anime SET title = ?, studio = ?, releaseDate = ?, poster = ? WHERE animeId = ?;');
  $posts->execute([$title,$studio,$formattedDate, $posterPath, $postId['animeId']]);
  header('Location: /index.php');
  }
}



?>

  <?php include '../../views/anime/partials/header.php'; ?>
  <h1>Edit Anime</h1>


  <?php include '../../form.php' ?>
<!-- NOTES: -->
<!-- 1. The name attribute is used for to get the form values via $_GET supervariable. ex. name="title" -> $_GET['title'] -->
  <?php include '../../views/anime/partials/footer.php'; ?>


</html>
