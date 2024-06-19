<?php include( './includes/header.php')?>


<?php include( './includes/navbar.php');

if (isset($_GET['noAccess'])) echo '
<div class="alert alert-primary" role="alert">
  "NO ACCESS / WRONG INPUT"!
</div>

';


?>
<form action="manage.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">User</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <button type="submit" class="btn btn-primary">LOGIN</button>
</form>

<?php
include('./includes/footer.php') ?>
