<?php
include 'include/solr_connect_cfg.php';
include 'include/date_format.php';
function index_add_text($date, $id, $searchresult, $language, $extra_text, $text) {
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


function index_add_single_href($date, $href, $searchresult, $language, $extra_text) {
  if (strncasecmp($href,"http",4)==0) {
    echo "$href: Case of URLs not implemented yet.\n";
  } elseif (preg_match(',^/\d\d\d\d,',$href)) {
    # local pdf document
    $html=shell_exec("java -jar /home/norbert/docs/CustomerData/OWINFS/tika/tika-app-1.26.jar file:///home/norbert/docs/CustomerData/OWINFS/docs$href");
    $dom=new DOMDocument();
    $dom->loadHTML($html);
    $dom->getElementsByTagName('title')[0]->textContent="";
    # get rid of text that is repeated at the top of each page
    foreach ($dom->getElementsByTagName('div') as $pg) {
      $class=$pg->getAttribute('class');
      if ($class=="page") {
        $paras=$pg->getElementsByTagName('p');
        $paras[1]->textContent="";
      }
    }
    $textcontent=$dom->textContent;
  } else {
    # local html document
    $file="/home/norbert/docs/CustomerData/OWINFS/OWINFS-git/$href.html";
    $dom=new DOMDocument();
    $dom->loadHTMLFile($file);
    # get rid of the textContent of any video elements, as that is probably a variation of
    # “your browser does not support the <video> tag”
    foreach ($dom->getElementsByTagName('video') as $e) {
      $e->textContent="";
    }
    $textcontent=$dom->getElementById('content-area')->textContent;
  }
  index_add_text($date, $href, $searchresult, $language, $extra_text, $textcontent);
}


function index_add($date, $linkdata) {
  $language_names=[
    "en" => ["en" => "English", "es" => "Spanish", "fr" => "French"],
    "es" => ["en" => "inglés", "es" => "español", "fr" => "francés"],
    "fr" => ["en" => "anglais", "es" => "espagnol", "fr" => "français"],
  ];
  $lines=explode("\n", $linkdata);
  # Processing linkdata: Pass 1: Building a language => href array
  $hrefs=array();
  foreach ($lines as $l) {
    $language=substr($l, 0, 2);
    $sep=strpos($l, " ", 3);
    $href=substr($l, 3, $sep-3);
    $hrefs[$language]=$href;
  }
  # Processing linkdata: Pass 2: calling index_add_single_href for each line
  foreach ($lines as $l) {
    $language=substr($l, 0, 2);
    $sep=strpos($l, " ", 3);
    $href=substr($l, 3, $sep-3);
    $sep2=strpos($l, "|", $sep+1);
    $before_title=substr($l, $sep+1, $sep2-$sep-1);
    $sep3=strpos($l, "|", $sep2+1);
    $title=substr($l, $sep2+1, $sep3-$sep2-1);
    $after_title=substr($l, $sep3+1);
    $extra_text="$before_title $title $after_title";
    $formatted_date=owinfs_date_format($date, $language);
    $after_title=preg_replace('/\)\(/', ', ', $after_title."($formatted_date)");
    if (count($lines)>1) {
      $searchresult="$before_title <a href='$href'>$title</a> $after_title:";
      foreach ($hrefs as $lang => $linktarget) {
        $formatted_language=$language_names[$language][$lang];
        $searchresult.=" <a href='$linktarget'>$formatted_language</a>";
      }
      $searchresult.=".";
    } elseif (strlen($after_title)>0
              and ($title[-1]=="." or $title[-1]=="?" or $title[-1]=="!")) {
      $searchresult="$before_title <a href='$href'>$title</a> $after_title";
    } else {
      $searchresult="$before_title <a href='$href'>$title</a>. $after_title";
    }
    
    index_add_single_href($date, $href, $searchresult, $language, $extra_text);
  }
}