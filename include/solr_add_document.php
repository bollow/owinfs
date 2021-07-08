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

function pdf_html_textcontent($html) {
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
  $textcontent=preg_replace('/|•/', '', $textcontent);
  return $textcontent;
}

function index_add_single_href($date, $href, $searchresult, $language, $extra_text) {
  if (strncasecmp($href,"http",4)==0) {
    # a remote pdf document or html page
    if (preg_match(',\.pdf$,i', $href)) {
      $html=shell_exec("java -jar ".TIKA_PATH." $href");
      $textcontent=pdf_html_textcontent($html);
    } else {
      # assume it's html
      $dom=new DOMDocument();
      $dom->loadHTMLFile($href);
      $textcontent="";
      foreach ($dom->getElementsByTagName('div') as $d) {
        $class=$d->getAttribute('class');
        if ($class=="WordSection1") {
	  # many TWN pages have such a div; the first paragraph is redundant
	  $first_p=$d->getElementsByTagName('p')->item(0);
	  try {
	    $d->removeChild($first_p);
	  } catch (Exception $e) {
            echo "Caught exception: Could not directly remove first paragraph of WordSection1 in $href\n";
          }
          $textcontent.=$d->textContent." ";
        } elseif ($class=="long content") {
	  # pages from UNCTAD's Drupal
          $textcontent.=$d->textContent." ";
        }
      }
      if ($textcontent=="") {
        $textcontent=$dom->textContent;
      }
      print $textcontent;
    }
  } elseif (preg_match(',^/\d\d\d\d,',$href)) {
    # local pdf document
    $html=shell_exec("java -jar ".TIKA_PATH." file://".DOCUMENT_ROOT.$href);
    $textcontent=pdf_html_textcontent($html);
  } else {
    # local html document
    $file=DOCUMENT_ROOT.$href.".html";
    $dom=new DOMDocument();
    $dom->loadHTMLFile($file);
    if ($date=="9999") {
      # special case of a theme page
      $textcontent="";
      foreach ($dom->getElementsByTagName('div') as $d) {
        $class=$d->getAttribute('class');
        if ($class=="searchable") {
          $textcontent.=$d->textContent." ";
        }
      }
      foreach ($dom->getElementsByTagName('h2') as $h) {
        $class=$h->getAttribute('class');
        if ($class!="title") {
          $textcontent.=" | ".$h->textContent.". | ";
        }
      }
      echo "[[$textcontent]]\n";
    } else {
      # get rid of the textContent of any video elements, as that is probably a variation of
      # “your browser does not support the <video> tag”
      foreach ($dom->getElementsByTagName('video') as $e) {
        $e->textContent="";
      }
      $textcontent=$dom->getElementById('content-area')->textContent;
    }
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