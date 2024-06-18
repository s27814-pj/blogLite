<?php include( './includes/header.php')?>


    <!--navbar-->
<?php include( './includes/navbar.php');?>

<?php
require_once './includes/public_functions.php';
require_once('config.php');

if (isset($_GET['slug'])) {
    $post = getPostBySlug($_GET['slug']);
}?>

<?php if (isset($post)){ ?>
<div class="card text-center">
    <div class="card-header">
        <?php echo $post['header'] ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $post['title'] ?></h5>
        <p class="card-text"><?php echo $post['body'] ?></p>
        <a href="single_post.php?slug=<?php echo $post['slug'] ?>" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer text-body-secondary">
        <?php echo $post['created_at'] ?>
    </div>
    <img src="<?php echo $post['image'] ?>" class="card-img-bottom" alt="...">

</div>
<?php }else echo "null"?>

<?php include( './includes/footer.php')?>
