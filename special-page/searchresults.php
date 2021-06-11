<?php
$html_title="Search results | Our World Is Not For Sale";
include 'include/head_etc.php'
?>
  <div id="main" class="group">
<?php
$sidebar_title="About OWINFS";
include 'include/sidebar_about.php';
include 'include/navbar.php';
include 'include/date_format.php';
$query = (isset($_POST["query"]) ? $_POST["query"] : "");
$query = 'Deborah';

# simple wildcard-based date matching
$query = preg_replace('/(date:\d\d\d\d)($|[^-*])/', '$1*', $query);
$query = preg_replace('/(date:\d\d\d\d-\d\d)($|[^-*])/', '$1*', $query);
$query = preg_replace('/(date:\d\d\d\d-\d\d-\d\d)($|[^-*])/', '$1*', $query);

$html_sanitized_query = htmlspecialchars($query);

?>
    <div id="content" class="singlecolumn">
    <div id="content-header">
<?php
if (strlen($query)>2) {
?>
      <h1 class="title">Search results</h1>
    </div> <!-- /#content-header -->
    <div id="content-area">
<?php
  include 'include/solr_connect_cfg.php';
  $options = array
  (
    'hostname' => SOLR_SERVER_HOSTNAME,
    'port'     => SOLR_SERVER_PORT,
    'timeout'  => SOLR_SERVER_TIMEOUT,
    'path'     => SOLR_PATH,
  );
  $client = new SolrClient($options);
  $q = new SolrQuery();
  $q->setQuery($query);
  $q->setStart(0);
  $q->setRows(1000);
  $q->addField('before_title')->addField('title')->addField('after_title')->addField('id')
    ->addField('date')->addField('language');
  $q->addSortField('date', SolrQuery::ORDER_DESC);
  $q->setHighlight(true);
  $q->addHighlightField('content');
  $q->setHighlightSimplePre('<b>');
  $q->setHighlightSimplePost('</b>');
  $q->setHighlightSnippets(3);

  try {
    $query_response = $client->query($q);
    $response = $query_response->getResponse();
  }

  catch (Exception $e) {  
    #echo 'Exception Message: ' .$e->getMessage();  
    echo 'Exception!';  
  }

  $results_count = $response->response->numFound;
  if ($results_count==0) {
    echo 'Unfortunately, no matching documents were found!';
  } elseif ($results_count==1) {
    echo 'One matching document has been found:';
  } else {
    echo "$results_count matching documents have been found:";
  }

  foreach ($response->response->docs as $m) {
    $before_title=$m->before_title;
    $href=$m->id;
    $title=$m->title;
    $date=owinfs_date_format($m->date, $m->language);
    $after_title=$m->after_title;
    $after_title=preg_replace('/\)\(/', ', ', $after_title."($date)");
    echo "<p>$before_title <a href='$href'>$title</a> $after_title\n    <ul class='tail'>\n";
    $highlights=$response->highlighting->$href->content;
    foreach ($highlights as $h) {
      echo "      <li><i>$h</i>";
    }
    echo "    </ul>";
  }

  ?>
    <h1 class="title">In case you may want to modify your search query…</h1>
<?php
} else {
?>
      <h1 class="title">No search query!?</h1>
    </div> <!-- /#content-header -->
    <div id="content-area">
      The search action could not be carried out for lack of something to search for.
      <p>
      Please enter your search terms.
<?php
}
?>
      <p>
      <form action="searchresults.php" accept-charset="UTF-8" method="post">
	  <div class="form-item">
	     <label for="query">Search ourworldisnotforsale.net and the linked external documents for:</label>
	     <input id="query" type="text" name="query" size="60" value="<?php echo $html_sanitized_query ?>">
	  </div>
          <input type="submit" value="Find!">
      </form>
<?php
include 'include/search_instructions.php';
?>
    </div> <!-- /#content-area -->
    </div> <!-- /#content -->
  </div> <!-- /#main -->
<?php
include 'include/foot_etc.php'

?>
