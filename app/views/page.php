<?php

$prismic = $WPGLOBAL['prismic'];
if (isset($WPGLOBAL['pageContent'])) {
  $pageContent = $WPGLOBAL['pageContent'];
}

$title = "TODO";

?>

<?php include 'header.php'; ?>
    
<div class="welcome">
  <img class="star" src="/images/powerstart.png">
  <h1>Welcome aboard!</h1>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
  <p>Checkout our <a href="https://prismic.io/quickstart#?lang=php" target="_blank">Quick Start Tutorial</a></p>
</div>

<?php include 'footer.php'; ?>