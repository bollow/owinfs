<?php

function readpair($openfile) {
  $line=fgets($openfile);
  $sep=strpos($line, " ");
  if ($sep===FALSE) {
    return array ("", "");
  }
  $a=substr($line, 0, $sep);
  $b=substr($line, $sep+1, -1);
  return array ($a, $b);
}

function hovermenu($datafile, $thispage, $widthclass, $override_title="") {
  global $prepend_path;
  $in=fopen($datafile, "r") or die("Unable to open file '$datafile'!");
  list($title_linktarget, $title)=readpair($in);
  if ($override_title!="") {
    $title=$override_title;
  }
  if ($title_linktarget=="**") {
    echo "    <li class='hovermenu'>$title\n";
  } else {
    echo "    <li class='hovermenu'><a href='$prepend_path$title_linktarget'>$title</a>\n";
  }
  echo "      <ul class='$widthclass'>\n";
  while(!feof($in)) {
    list($linktarget, $page)=readpair($in);
    if ($linktarget=="") {
      break;
    }
    if ($linktarget=="*") {
      # this is a heading, not a link entry
      echo "        <li><u><b>$page</b></u></li>\n";
    } else {
      if ($page==$thispage) {
        echo "        <li><a href='$prepend_path$linktarget' class='active'>$page</a></li>\n";
      } else {
        echo "        <li><a href='$prepend_path$linktarget'>$page</a></li>\n";
      }
    }
  }
?>
      </ul></li>
<?php
}
?>
