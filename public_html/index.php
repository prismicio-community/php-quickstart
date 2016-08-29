<?php

require_once '../resources/config.php';
include_once(__DIR__.'/../vendor/autoload.php');

use Prismic\Api;

try {
  $api = Api::get($PRISMIC_URL, $PRISMIC_TOKEN);
  $documents = $api->query(null);
} catch (Guzzle\Http\Exception\BadResponseException $e) {
  handlePrismicHelperException($e);
}

$title="TODO";
?>

<?php
  require_once(TEMPLATES_PATH . "/header.php");
?>

<div class="welcome">
  <img class="star" src="/images/powerstart.png">
  <h1>Welcome aboard!</h1>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
  <p>Checkout our <a href="http://prismic.io/quickstart">Quick Start Tutorial</a></p>
</div>

<?php
  require_once(TEMPLATES_PATH . "/footer.php");
