<?php
// Include the database connection file
require '../../database.php';
// Prepare Query
$statement = $pdo->prepare('SELECT * FROM anime;');
// Execute Query
$statement->execute();
// Store Results
$animeList = $statement->fetchAll(PDO::FETCH_ASSOC);

$search = $_GET['search'] ?? '';
if ($search) {
  $statement = $pdo->prepare('SELECT * FROM anime WHERE title LIKE ?;');
  $statement->execute(["%$search%"]);
  $animeList = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else {
  $statement = $pdo->prepare('SELECT * FROM anime;');
  $statement->execute();
  $animeList = $statement->fetchAll(PDO::FETCH_ASSOC);
}






?>

<?php include '../../views/anime/partials/header.php'; ?>

  <div class="d-flex justify-content-between">
    <h1>Anime Library</h1>
    <form action="" method="GET" class="row g-3">
    <div class="col-auto">
      <label for="inputPassword2" class="visually-hidden">Search</label>
      <input type="text" value="<?= $search ?>" class="form-control" id="inputPassword2" name="search" placeholder="Search">
    </div>
    <div class="col-auto">
      <button type="submit"  class="btn btn-primary mb-3">Search</button>
    </div>
  </form>
  </div>

  <p>
    <a href="/anime/create.php" type="button" class="btn btn-outline-success">Insert New Anime</a>

  </p>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">AnimeID</th>
        <th scope="col">Title</th>
        <th scope="col">Poster</th>
        <th scope="col">Studio</th>
        <th scope="col">ReleaseDate</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($animeList as $anime) : ?>
        <tr>
          <th scope="row"><?= $anime["animeId"] ?></th>
          <td><?= $anime["title"] ?></td>
          <td><img src="\poster\DQilo1Ze\fern.PNG" class="poster"></td>
          <td><?= $anime["studio"] ?></td>
          <td><?= $anime["releaseDate"] ?></td>
          <td>
            <a href="anime/update.php?animeId=<?= $anime['animeId']?>" class="btn btn-outline-primary">Edit</a>
            <!-- Delete an item -->
            <form method="post" action="/anime/delete.php" style="display: inline-block;">
              <!-- Assign the animeId to the input value -->
              <input type="hidden" name="animeId" value="<?= $anime['animeId'] ?>"  >
              <!-- Submit the input value via the submit button -->
              <button type="submit" class="btn btn-outline-danger" >Delete</button>
            </form> 

          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php include '../../views/anime/partials/footer.php'; ?>
</html>