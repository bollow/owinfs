<?php
function article_links($inputfile, $language) {
  global $in_list;
  $in_list=FALSE;
  $in=fopen($inputfile, "r") or die("Unable to open file '$inputfile'!");
  while(!feof($in)) {
    $line=fgets($in);
    if (!(strpos($line, "HEADING")===FALSE)) {
      while (!feof($in) && $line!="\n") {
        $line=fgets($in);
        if (substr($line, 0, 2)==$language) {
          end_list();
          $h=substr($line, 3, -1);
          echo "<h2>$h</h2>\n";
        }
      }
    } else if (!(strpos($line, "ARTICLE")===FALSE)) {
      while (!feof($in) && $line!="\n") {
        $line=fgets($in);
        if (substr($line, 0, 2)==$language) {
          $sep=strpos($line, " ", 3);
	  $l=substr($line, 3, $sep-3);
	  $h=substr($line, $sep+1, -1);
          put_li("<a href=\"$l\">$h</a>");
        }
      }
    } else if ($line!="\n" && $line!="" && (strpos($line, "#")===FALSE))
      # ignore comments and empty lines if outside of a block, otherwise die
    {
      die("block keyword expected, but found: $line");
    }
  }
  end_list();
}

function put_li($text) {
  global $in_list;
  if (!$in_list) {
    echo "<ul>\n";
    $in_list=TRUE;
  }
  echo "  <li>$text\n";
}
function end_list() {
  global $in_list;
  if ($in_list) {
    echo "</ul>\n";
    $in_list=FALSE;
  }
}

?>
