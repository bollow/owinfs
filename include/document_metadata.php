<?php
$output=null;
exec("/usr/bin/java -jar /opt/tika/tika-app.jar -m $file", $output);
foreach ($output as $line) {
  if (strncmp($line, "Author: ", 8)===0) {
    $author=substr($line, 8);
  } elseif (strncmp($line, "Creation-Date: ", 15)===0) {
    $date=substr($line, 15, 10);
  } elseif (strncmp($line, "language: ", 10)===0) {
    $lang=substr($line, 10, 2);
  }
}
?>
