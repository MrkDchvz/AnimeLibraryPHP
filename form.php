


<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error) : ?>
        <div><?= $error ?></div>
      <?php endforeach ?>
    </div>
  <?php endif ?> 

  <form method="post" enctype="multipart/form-data">
    <?php if($postId): ?>
        <img src="<?= $posterOriginal?>">
    <?php endif; ?>
    <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="<?= $title?>">
    </div>
    <div class="mb-3">
      <label>Poster</label>
      <input type="file" name="poster" class="form-control">
    </div>
    <div class="mb-3">
      <label>Studio</label>
      <input type="text" name="studio"  class="form-control" value="<?= $studio ?>">
    </div>
    <div class="mb-3">
      <label>Release Date</label>
      <input type="date" name="release-date" class="form-control" value="<?= $formattedDate ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>