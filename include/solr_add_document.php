<?php
include 'include/solr_connect_cfg.php';
function solr_add_text($before_title, $title, $after_title, $href, $date, $language, $text) {
  $options = array
  (
    'hostname' => SOLR_SERVER_HOSTNAME,
    'port'     => SOLR_SERVER_PORT,
    'timeout'  => SOLR_SERVER_TIMEOUT,
    'path'     => SOLR_PATH,
  );
  $client = new SolrClient($options);
  $doc = new SolrInputDocument();
  if ($language!='en' and $language!='es' and $language!='fr') {
    $language='other';
  }
  $doc->addField('date', $date);
  $doc->addField('language', $language);
  $doc->addField('before_title', $before_title);
  $doc->addField('title', $title);
  $doc->addField('after_title', $after_title);
  $doc->addField('id', $href);
  $doc->addField("text_$language", "$before_title $title $after_title ".$text);
  $doc->addField('content', $text);
  $overwrite=true; # overwrite existing data for the same id
  $commitWithin=5000; # commit (i.e. make visible to searches) within 5000ms
  $updateResponse = $client->addDocument($doc, $overwrite, $commitWithin);
  print_r($updateResponse->getResponse());
}

function solr_add_htmlfile($before_title, $title, $after_title, $href, $date, $language, $file) {
  $dom=new DOMDocument();
  $dom->loadHTMLFile($file);
  # get rid of the textContent of any video elements, as that is probably a variation of
  # “your browser does not support the <video> tag”
  foreach ($dom->getElementsByTagName('video') as $e) {
    $e->textContent="";
  }
  $textcontent=$dom->getElementById('content-area')->textContent;
  solr_add_text($before_title, $title, $after_title, $href, $date, $language, $textcontent);
}