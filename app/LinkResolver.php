<?php

use Prismic\LinkResolver;

/**
 * The link resolver is the code building URLs for pages corresponding to
 * a Prismic document.
 *
 * If you want to change the URLs of your site, you need to update this class
 * as well as the routes in app.php.
 */
class PrismicLinkResolver extends LinkResolver
{
  public function resolve($link)
  {
    // Example link resolver for custom type with API ID of 'page'
    if ($link->type === 'page') {
      return '/page/' . $link->uid;
    }
    
    // Default case returns the homepage
    return '/';
  }
}
