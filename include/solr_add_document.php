<?php
include 'include/solr_connect_cfg.php';
include 'include/date_format.php';
function solr_add_text($date, $id, $searchresult, $language, $extra_text, $text) {
  $options = array
  (
    'hostname' => SOLR_SERVER_HOSTNAME,
    'port'     => SOLR_SERVER_PORT,
    'timeout'  => SOLR_SERVER_TIMEOUT,
    'path'     => SOLR_PATH,
  );
  $client = new SolrClient($options);
  $doc = new SolrInputDocument();
  $doc->addField('date', $date);
  $doc->addField('id', $id);
  $doc->addField('searchresult', $searchresult);
  $doc->addField('language', $language);
  if ($language!='en' and $language!='es' and $language!='fr') {
    $language='other';
  }
  $doc->addField("text_$language", $extra_text." ".$text);
  $doc->addField('content', $text);
  $overwrite=true; # overwrite existing data for the same id
  $commitWithin=5000; # commit (i.e. make visible to searches) within 5000ms
  $updateResponse = $client->addDocument($doc, $overwrite, $commitWithin);
  print_r($updateResponse->getResponse());
}

function solr_add_htmlfile($date, $linkdata, $file) {
  $language=substr($linkdata, 0, 2);
  $sep=strpos($linkdata, " ", 3);
  $href=substr($linkdata, 3, $sep-3);
  $sep2=strpos($linkdata, "|", $sep+1);
  $before_title=$h=substr($linkdata, $sep+1, $sep2-$sep-1);
  $sep3=strpos($linkdata, "|", $sep2+1);
  $title=substr($linkdata, $sep2+1, $sep3-$sep2-1);
  $after_title=substr($linkdata, $sep3+1);
  $extra_text="$before_title $title $after_title";
  $dom=new DOMDocument();
  $dom->loadHTMLFile($file);
  # get rid of the textContent of any video elements, as that is probably a variation of
  # “your browser does not support the <video> tag”
  foreach ($dom->getElementsByTagName('video') as $e) {
    $e->textContent="";
  }
  $textcontent=$dom->getElementById('content-area')->textContent;
  $formatted_date=owinfs_date_format($date, $language);
  $after_title=preg_replace('/\)\(/', ', ', $after_title."($formatted_date)");
  $searchresult="$before_title <a href='$href'>$title</a> $after_title";
  solr_add_text($date, $href, $searchresult, $language, $extra_text, $textcontent);
}

function solr_add_pdf($before_title, $title, $after_title, $href, $date, $language) {
  $html=shell_exec("java -jar /home/norbert/docs/CustomerData/OWINFS/tika/tika-app-1.26.jar file:///home/norbert/docs/CustomerData/OWINFS/docs$href");
  $dom=new DOMDocument();
  $dom->loadHTML($html);
  foreach ($dom->getElementsByTagName('div') as $pg) {
    $class=$pg->getAttribute('class');
    if ($class=="page") {
      $paras=$pg->getElementsByTagName('p');
      $paras[1]->textContent="";
    }
  }
  $textcontent=$dom->textContent;
  solr_add_text($before_title, $title, $after_title, $href, $date, $language, $textcontent);
}