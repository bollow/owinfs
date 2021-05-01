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
          $h=substr($line, 3, -1);
          echo "<h2>$h</h2>\n";
        }
      }
    } else if (!(strpos($line, "ARTICLE")===FALSE)) {
      while (!feof($in) && $line!="\n") {
        $line=fgets($in);
        if (substr($line, 0, 2)==$language) {
          $sep=strpos($line, " ", 3);
          $sep2=strpos($line, ". (", $sep);
	  if ($sep2===FALSE) {
            $sep2=strpos($line, "? (", $sep);
	  }
	  if ($sep2===FALSE) {
            $sep2=strpos($line, "! (", $sep);
	  }
	  if ($sep2===FALSE) {
	    $l=substr($line, 3, $sep-3);
	    $h=substr($line, $sep+1, -1);
            echo("<p>\n <i><a href=\"$l\">$h</a></i>");
	  } else {
	    $l=substr($line, 3, $sep-3);
	    $h=substr($line, $sep+1, $sep2-$sep-1);
	    $m=substr($line, $sep2, -1);
            echo("<p>\n <i><a href=\"$l\">$h</a></i>$m");
	  }
        }
      }
    } else if ($line!="\n" && $line!="" && (strpos($line, "#")===FALSE))
      # ignore comments and empty lines if outside of a block, otherwise die
    {
      die("block keyword expected, but found: $line");
    }
  }
}

?>
