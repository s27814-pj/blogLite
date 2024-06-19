<?php include( './includes/header.php')?>


<!--navbar-->
<?php include( './includes/navbar.php'); ?>
<?php
$posts = getNewPosts();
foreach ($posts as $post):
?>


<div class="card text-center">
    <div class="card-header">
        <?php echo $post['header'] ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $post['title'] ?></h5>
        <p class="card-text"><?php echo $post['body'] ?></p>
        <a href="single_post.php?slug=<?php echo $post['slug'] ?>" class="btn btn-primary">Go to post</a>
    </div>
    <div class="card-footer text-body-secondary">
        <?php echo $post['created_at'] ?>
    </div>
    <img src="<?php echo $post['image'] ?>" class="card-img-bottom" alt="...">

</div>

<?php endforeach ?>


<div class="card text-center">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer text-body-secondary">
        2 days ago
    </div>
    <img src="https://lds-img.finalfantasyxiv.com/promo/h/e/zADePMzBSPsaZMvfM6PIWMeoME.jpg" class="card-img-bottom" alt="...">

</div>

<div class="card text-center">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional contentWith supporting text below as a natural lead-in to additional contentWith supporting text below as a natural lead-in to additional contentWith supporting text below as a natural lead-in to additional contentWith supporting text below as a natural lead-in to additional contentWith supporting text below as a natural lead-in to additional contentWith supporting text below as a natural lead-in to additional contentWith supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer text-body-secondary">
        2 days ago
    </div>
</div>


<?php include( './includes/footer.php')?>
