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
      <nav><a href="#config"><strong>Configure a repository</strong></a><a href="https://prismic.io/docs" class="doc">Documentation<img src="images/open.svg" alt=""/></a>
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
      <p>This is a help page included in your project, it has a few useful links and example snippets to help you getting started. You can access this any time by pointing your browser to /help.</p>
      <h2>Three more steps:</h2>
      <h3 id="config"><span>1</span>Bootstrap your project</h3>
      <p>If you haven't yet, create a prismic.io content repository. A repository is where your website’s content will live. Simply <a href="https://prismic.io/#create" target="_blank">create one</a> by choosing a repository name and a plan. We’ve got a variety of plans including our favorite, Free!</p>
      <h4>Add the repository URL to your configuration</h4>
      <p>Replace the repository url in your config file with your-repo-name.prismic.io</p>
      <div class="source-code">
        <pre><code>// In prismic.php
define("PRISMIC_URL", "https://levi-quickstart-php.prismic.io/api");</code></pre>
      </div>
      <h3 id="query"><span>2</span>Create a route and retrieve content</h3>
      <p>To add a page to your project, you need to first specify a route. The route contains the URL and performs queries for the needed content.<br/>In the following example we set a "/page/:uid" URL to fetch content of custom type "page" by its UID. The route then calls the "page" template and passes it the retrieved content.</p>
      <div class="source-code">
        <pre><code>
// Get page by UID
$app->get('/page/{uid}', function ($request, $response, $args) use ($app, $prismic) {

        // Retrieve the uid from the url
        $uid = $args['uid'];

        // Query the API by the uid
        $api = $prismic->get_api();
        $pageContent = $api->getByUID('page', $uid);

        // Render the page
        render($app, 'page', array('pageContent' => $pageContent));
});
</code></pre>
      </div>
      <h3 id="done"><span>3</span>Fill a template</h3>
      <p>Now all that's left to be done is insert your content into the template.<br/>You can get the content using the pageContent object we defined above. Each content field is accessed using the custom type API-ID and the field key defined in the custom type (for example 'page.image').</p>
      <div class="source-code">
        <pre><code>
&lt;?php
$prismic = $WPGLOBAL['prismic'];
$pageContent = $WPGLOBAL['pageContent'];
?&gt;

&lt;?php include 'header.php'; ?&gt;
    
&lt;div class="welcome"&gt;
        &lt;img class="star" src="&lt;?= $pageContent->getImage('page.image')->getUrl() ?&gt;"&gt;
        &lt;?= $pageContent->getStructuredText('page.title')->asHtml($prismic->linkResolver) ?&gt;
        &lt;?= $pageContent->getStructuredText('page.description')->asHtml($prismic->linkResolver) ?&gt;
&lt;/div&gt;

&lt;?php include 'footer.php'; ?&gt;
</code></pre>
      </div>
    </section>
  </div>
</body>