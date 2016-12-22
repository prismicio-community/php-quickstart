<?php

/*
 * This is the main file of the application, including routing and controllers.
 *
 * $app is a Slim application instance, see the framework documentation for more details:
 * http://docs.slimframework.com/
 *
 * The order of the routes matter, as it will define the priority of routes. For that reason we
 * need to keep the more "generic" routes, such as the pages route, at the end of the file.
 *
 * If you decide to change the URLs, make sure to change PrismicLinkResolver in LinkResolver.php
 * as well to make sures links in your site are correctly generated.
 */

use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;

require_once 'includes/http.php';

$apiEndpoint = $WPGLOBAL['app']->getContainer()->get('settings')['prismic.url'];
$repoEndpoint = str_replace("/api", "", $apiEndpoint);
$url = $repoEndpoint . '/app/settings/onboarding/run';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("language=php&framework=slim"));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec ($ch);
curl_close ($ch);

// Index page
$app->get('/', function ($request, $response) use ($app, $prismic) {
  render($app, 'page');
});

// Help Page
$app->get('/help', function ($request, $response) use ($app, $prismic) {
  $DEFAULT_ENDPOINT = 'https://your-repo-name.prismic.io/api';
  $API_ENDPOINT = $app->getContainer()->get('settings')['prismic.url'];
  preg_match("/^(https?:\/\/([-_a-zA-Z0-9]+)\..+)\/api$/", $API_ENDPOINT, $match);
  $repoURL = $match[1];
  $name = $match[2];
  $host = $request->getUri()->getBaseUrl();
  $isConfigured = $DEFAULT_ENDPOINT != $API_ENDPOINT;
  render($app, 'help', array(
    'isConfigured' => $isConfigured,
    'repoURL'=> $repoURL,
    'name'=> $name,
    'host'=> $host
  ));
});

// Previews
$app->get('/preview', function ($request, $response) use ($app, $prismic) {
  $token = $request->getParam('token');
  $url = $prismic->get_api()->previewSession($token, $prismic->linkResolver, '/');
  setcookie(Prismic\PREVIEW_COOKIE, $token, time() + 1800, '/', null, false, false);
  return $response->withStatus(302)->withHeader('Location', $url);
});
