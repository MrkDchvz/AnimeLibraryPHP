<?php

require '../../database.php';

require '../../functions.php';


$errors = [];
$postId = [
    'title' => '',
    'studio' => '',
    'releaseDate' => '',
    'poster' => ''
];

$title = $postId["title"];
$studio = $postId["studio"];
$date = new DateTime($postId["releaseDate"]);
$formattedDate = $date->format('Y-m-d');
$posterOriginal = $postId["poster"] ?? 'Hello';

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
    $poster = $_FILES['poster'] ?? null;
    $posterPath = $posterOriginal ?? null;
    
    require '../../validateAnime.php';
  


  $posts = $pdo->prepare('INSERT INTO anime (title, studio, releaseDate, poster) VALUES (?, ?, ?, ?)');
  $posts->execute([$title,$studio,$formattedDate, $posterPath]);
  header('Location: /anime/index.php');
  }
}



?>

<?php include '../../views/anime/partials/header.php' ?>

  <h1>Insert New Anime</h1>
  <!-- When we create, update or delete on the db we use POST method -->
<?php include '../../form.php' ?>
<!-- NOTES: -->
<!-- 1. The name attribute is used for to get the form values via $_GET supervariable. ex. name="title" -> $_GET['title'] -->

<?php include '../../views/anime/partials/footer.php' ?>
