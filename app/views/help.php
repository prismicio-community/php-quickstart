<!DOCTYPE html(lang='en')>
<head>
  <title>prismic.io help page</title>
  <link rel="stylesheet" href="/stylesheets/reset.css"/>
  <link rel="stylesheet" href="/stylesheets/style.css"/>
  <link rel="stylesheet" href="/stylesheets/vendors/help.min.css"/>
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" type="text/css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="/javascript/highlight.min.js"></script>
</head>
<body>
  <div id="prismic-help">
    <header>
      <nav>
      <?php
      if($WPGLOBAL['isConfigured']) {
      ?>
        <a target="_blank" href="<?php echo $WPGLOBAL['repoURL']; ?>"><strong>Go to <?php echo $WPGLOBAL['name']; ?></strong></a>
      <?php
      } else {
      ?>
        <a href="#config"><strong>Configure a repository</strong></a>
      <?php
      }
      ?>
      <a target="_blank" href="https://prismic.io/docs" class="doc">Documentation<img src="images/open.svg" alt=""/></a>
      </nav>
      <div class="wrapper"><img src="images/rocket.svg" alt=""/>
        <h1>High five, you deserve it!</h1>
        <p>Grab a well deserved cup of coffee, you're two steps away from creating a page with dynamic content.</p>
      </div>
      <div class="hero-curve"></div>
      <div class="flip-flap">
        <div class="flipper">
          <div class="guide">
            <ul>
              <li class="done"><span>1</span>Bootstrap your project</li>
              <li><a href="#query"><span>2</span>Query the API<img src="images/arrow.svg" alt=""/></a></li>
              <li><a href="#done"><span>3</span>Fill a template<img src="images/arrow.svg" alt=""/></a></li>
            </ul>
          </div>
          <div class="gif"></div>
        </div>
      </div>
    </header>
    <section>
      <p>This is a help page included in your project, it has a few useful links and example snippets to help you getting started. You can access this any time by pointing your browser to <?php echo $WPGLOBAL['host']; ?>/help.</p>
      <h2><?php if($WPGLOBAL['isConfigured']) echo "Two"; else echo "Three"; ?> more steps:</h2>
      <h3 id="config"><span>1</span>Bootstrap your project</h3>
      <p>If you haven't yet, create a prismic.io content repository. A repository is where your website’s content will live. Simply <a href="https://prismic.io/#create" target="_blank">create one</a> by choosing a repository name and a plan. We’ve got a variety of plans including our favorite, Free!</p>
      <h4>Add the repository URL to your configuration</h4>
      <p>Replace the repository url in your config file with your-repo-name.prismic.io</p>
      <div class="source-code">
        <pre><code>// In prismic.php
define("PRISMIC_URL", "https://your-repo-name.prismic.io/api");</code></pre>
      </div>
      <h3 id="query"><span>2</span>Create a route and retrieve content</h3>
      <p>To add a page to your project, you need to first specify a route. The route contains the URL and performs queries for the needed content.<br/>In the following example we set a "/page/:uid" URL to fetch content of custom type "page" by its UID. The route then calls the "page" template and passes it the retrieved content.</p>
      <div class="source-code">
        <pre><code>
// Get page by UID
$app->get('/page/{uid}', function ($request, $response, $args) use ($app, $prismic) {

        // We store the param uid in a variable
        $uid = $args['uid'];

        // Query the API by the uid
        $api = $prismic->get_api();
        // We are using the function to get a document by its uid
        // pageContent is a document, or null if there is no match
        $pageContent = $api->getByUID("&lt;your-custom-type-id&gt;", $uid);

        // Where 'page' is the name of your php template file (page.php)
        render($app, 'page', array('pageContent' => $pageContent));
});
</code></pre>
      </div>
      <p>
        To discover all the functions you can use to query your documents go to <a href="https://prismic.io/docs/custom-types#query?lang=javascript" target="_blank">the prismic documentation</a>
      </p>
      <h3 id="done"><span>3</span>Fill a template</h3>
      <p>Now all that's left to be done is insert your content into the template.<br/>You can get the content using the pageContent object we defined above. Each content field is accessed using the custom type API-ID and the field key defined in the custom type (for example 'page.image').</p>
      <div class="source-code">
        <pre><code>
&lt;!-- In views/page.pug --&gt;
&lt;?php
$prismic = $WPGLOBAL['prismic'];
$pageContent = $WPGLOBAL['pageContent'];
?&gt;

&lt;?php include 'header.php'; ?&gt;

&lt;div class="welcome"&gt;
        &lt;!-- This is how to get an image into your template --&gt;
        &lt;img class="star" src="&lt;?= $pageContent->getImage('page.image')->getUrl() ?&gt;"&gt;
        &lt;!-- This is how to get a structured text into your template --&gt;
        &lt;?= $pageContent->getStructuredText('page.title')->asHtml($prismic->linkResolver) ?&gt;
        &lt;!-- This is how to get a text into your template --&gt;
        &lt;?= $pageContent->getStructuredText('page.description')->asHtml($prismic->linkResolver) ?&gt;
&lt;/div&gt;

&lt;?php include 'footer.php'; ?&gt;
</code></pre>
      </div>
      <p>
        To discover how to get all the field go to <a href="https://prismic.io/docs/fields/structuredtext#?lang=javascript" target="_blank">the prismic documentation</a>
      </p>
    </section>
  </div>
</body>
