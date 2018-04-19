<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>prismic.io tutorial page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link href="/stylesheets/reset.css" rel="stylesheet" >
  <link href="/stylesheets/style.css" rel="stylesheet">
  <link href="/stylesheets/vendor/tutorial.min.css" rel="stylesheet">
  <link href="/images/punch.png" rel="icon" type="image/png">
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script src="/javascript/vendor/highlight.min.js"></script>
</head>
<body>
  <div id="prismic-tutorial">

    <header>
      <nav><a href="#bootstrap"><strong>Configure a repository</strong></a><a href="https://prismic.io/docs/php/getting-started/with-the-php-starter-kit" target="_blank" class="doc">Documentation<img src="images/open.svg" alt="Open"></a>
      </nav>
      <div class="wrapper"><img src="images/rocket.svg" alt="Rocket">
        <h1>High five, you deserve it!</h1>
        <p>Grab a well deserved cup of coffee, you're just a few steps away from creating a page with dynamic content.</p>
      </div>
      <div class="hero-curve"></div>
      <div class="flip-flap">
        <div class="flipper">
          <div class="guide">
            <ul>
              <li><a href="#bootstrap"><span>1</span>Bootstrap your project<img src="images/arrow.svg" alt="Arrow"></a></li>
              <li><a href="#custom-type"><span>2</span>Setup a "Page" Custom Type<img src="images/arrow.svg" alt="Arrow"></a></li>
              <li><a href="#new-page"><span>3</span>Create your first page<img src="images/arrow.svg" alt="Arrow"></a></li>
              <li><a href="#route"><span>4</span>Create a route and retrieve content<img src="images/arrow.svg" alt="Arrow"></a></li>
              <li><a href="#template"><span>5</span>Fill a template<img src="images/arrow.svg" alt="Arrow"></a></li>
            </ul>
          </div>
          <div class="gif"></div>
        </div>
      </div>
    </header>

    <section>
      <p>This is a tutorial page included in this PHP Starter project, it has a few useful links and example snippets to help you get started. You can access this page at <a href="http://localhost:8000/tutorial">http://localhost:8000/tutorial</a>.</p>
      <h2>Follow these steps:</h2>

      <h3 id="bootstrap"><span>1</span>Bootstrap your project</h3>
      <h4>Create a Prismic content repository</h4>
      <p>A repository is where your website’s content will live. Simply <a href="https://prismic.io/#create" target="_blank">create one</a> choosing a repository name and a plan. We’ve got a variety of plans including our favorite, Free!</p>
      <h4>Configure your project</h4>
      <p>Open <code class="tag">config.php</code> and assign the API endpoint for your prismic.io repository to the <code class="tag">PRISMIC_URL</code> constant:</p>
      <div class="source-code">
        <pre><code>// In config.php
define("PRISMIC_URL", "https://your-repo-name.prismic.io/api/v2");
</code></pre>
      </div>
      <p>Next let's see how to create a page in your website filled with content retrieved from Prismic.</p>

      <h3 id="custom-type"><span>2</span>Setup a "Page" Custom Type</h3>
      <p></p>
      <h4>Create a new Custom Type</h4>
      Go to the repository backend you've just created. Navigate to the "Custom Types" section (icon on the left navbar) and create a new Repeatable Type. For this tutorial let's name it "Page".
      <span class="note">Before clicking on button "Create new custom type", make sure that the system automatically assigns this an API ID of <code class="tag">page</code>, because we'll use it later for querying the page.</span>
      Once the "Page" Custom Type is created, we have to define how we want to model it. Click on "JSON editor" (right sidebar) and paste the following JSON data into the Custom Type JSON editor. When you're done, hit the "Save" button.
      <p></p>
      <div class="source-code">
        <pre><code>{
  "Main" : {
    "uid" : {
      "type" : "UID",
      "config" : {
        "placeholder" : "UID"
      }
    },
    "title" : {
      "type" : "StructuredText",
      "config" : {
        "single" : "heading1",
        "placeholder" : "Title..."
      }
    },
    "description" : {
        "type" : "StructuredText",
        "config" : {
          "multi" : "paragraph,em,strong,hyperlink",
          "placeholder" : "Description..."
        }
    },
    "image" : {
      "type" : "Image"
    }
  }
}
</code></pre>
      </div>

      <h3 id="new-page"><span>3</span>Create your first page</h3>
      <p>The "Page" Custom Type you've just created contains a title, a paragraph, an image and a UID (unique identifier). Now it is time to fill in your first page!
        <br><br>
        Go to go to "<em>Content</em>" and hit "<em>New</em>" &amp; fill in the corresponding fields. 
        <span class="note">Note the value you filled in the UID field, because it will be a part of the page URL. For this example enter the value, <code class="tag">first-page</code>.</span>
        When you're done, hit "<em>Save</em>" then "<em>Publish</em>".
      </p>

      <h3 id="route"><span>4</span>Create a route and retrieve content</h3>
      <p>In the following example we set a <code class="tag">/page/{uid}</code> URL to fetch content of your custom type by its UID. The route then calls the <code class="tag">page</code> template and passes it the retrieved content.</p>
      <p>Add the following route to your <code class="tag">app/app.php</code> file:</p>
      <div class="source-code">
        <pre><code>// In app/app.php
 
// Get page by UID
$app->get('/page/{uid}', function ($request, $response, $args) use ($app, $prismic) {
  // Query the API
  $api = $prismic->get_api();
  $document = $api->getByUID('page', $args['uid']);

  // Render the page
  render($app, 'page', array('document' => $document));
});
</code></pre>
      </div>
      <p>To discover all the functions you can use to query your documents go to&nbsp;<a href="https://prismic.io/docs/php/query-the-api/how-to-query-the-api" target="_blank">the prismic documentation</a></p>

      <h3 id="template"><span>5</span>Fill your template</h3>
      <p>
        Now all that's left to be done is to insert your content into the template.
        <span class="note">You can get the content using the <code class="tag">document</code> object we defined above. All the content fields are accessed using their <code class="tag">API-IDs</code>.</span>
        Create a new template file named <code class="tag">page.php</code> inside the <code class="tag">app/views</code> folder.
      </p>
      <div class="source-code">
        <pre><code>&lt;!-- Create file app/views/page.php --&gt;

&lt;?php
use Prismic\Dom\RichText;

$document = $WPGLOBAL['document'];
?&gt;

&lt;?php include_once 'header.php'; ?&gt;
    
&lt;div&gt;
  &lt;h1&gt;&lt;?= RichText::asText($document-&gt;data-&gt;title) ?&gt;&lt;/h1&gt;
  &lt;div&gt;
    &lt;?= RichText::asHtml($document-&gt;data-&gt;description) ?&gt;
  &lt;/div&gt;
  &lt;img src="&lt;?= $document-&gt;data-&gt;image-&gt;url ?&gt;" alt="&lt;?= $document-&gt;data-&gt;image-&gt;alt ?&gt;"&gt;
&lt;/div&gt;

&lt;?php include_once 'footer.php'; ?&gt;
</code></pre>
      </div>

      <p>In your browser go to <a href="http://localhost:8000/page/first-page" target="_blank">localhost:8000/page/first-page</a> and you're done! You've officially created a page that pulls content from Prismic.<br></p>
      <p>To discover how to get all the different field types, check out&nbsp;<a href="https://prismic.io/docs/php/templating/the-response-object" target="_blank" rel="noopener">the Prismic documentation</a>.</p>
    </section>
  </div>
</body>
</html>
