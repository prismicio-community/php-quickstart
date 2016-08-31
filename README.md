## PHP Quickstart project for prismic.io

This is the PHP Quickstart project that will connect to any prismic.io repository and display the quickstart page. It uses the prismic.io PHP development kit, and provides a few helpers.

### Getting started

#### Launch the starter project

Fork this repository, then clone your fork, and set up Apache so that the root of your website is the `public_html` directory.

If you haven't, [install Composer](https://getcomposer.org/doc/00-intro.md), and run `composer install`, to retrieve and install the PHP prismic.io kit and its dependencies.

#### Configure the starter project

Change the ```https://your-repo-name.prismic.io/api``` API endpoint in the `resources/config.php` file to your repository's endpoint.

#### Get started with prismic.io

You can [visit the docs](https://prismic.io/docs#?lang=php) to find out how to get started with prismic.io.

#### Understand the PHP development kit

You'll find more information about how to use the development kit included in this starter project, by reading [its README file](https://github.com/prismicio/php-kit).

### Specifics and helpers of the PHP Quickstart project

There are several places in this project where you'll be able to find helpful helpers of many kinds. You may want to learn about them in order to know your starter project better, or to take those that you think might be useful to you in order to integrate prismic.io in an existing app.

 * `resources/config.php`:
  * role: gathers key configuration for your project; if you're integrating prismic.io into an existing project, you definitely want this file
  * centralizes all information about the prismic.io repository's API (endpoint, client ID, client secret, ...)
  * defines some key variable used across the project, and requires the `Prismic.php` helper file.
  * defines the `Routes` class, which contains helpers to build some of the project's URLs (depending on your project's architecture, you can choose to do this in another file), including:
    * `index`, which is here for the example
    * `baseUrl`, a helper for all the helpers above
  * provides a basic `LinkResolver` class to iterate upon. For a given document, the "link resolver" describes its URL on your front-office. You really should edit this method, so that it supports all the document types your content writers might link to (read [our Link resolving documentation](https://prismic.io/docs/link-resolver#?lang=php) to learn more about what the link resolver is for).
  * provides a `handlePrismicException` function to factorize how to catch API call exceptions
 * `resources/templates/` is a directory with bits of pages that are useful for the example.
 * `public_html/` contains the example page and resources

### Licence

This software is licensed under the Apache 2 license, quoted below.

Copyright 2013 Zengularity (http://www.zengularity.com).

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this project except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
