<div id="navbar">
  <ul>
    <li><a href="./">Home</a></li>
    <li class="hovermenu"><a href="o/en/about">About us</a>
      <ul class="width2">
        <li><a href="o/en/node/4">What is the WTO?</a></li>
	<li><a href="o/en/node/2">Key positions and statements</a></li>
	<li><a href="members">Members</a></li>
	<li><a href="o/en/node/2254">Becoming an OWINFS member</a></li>
	<li><a href="o/en/node/3" title="WTO: Shrink or Sink! — A Critique of the WTO">Critique of the WTO</a></li>
      </ul></li>
    <li><a href="news">News</a></li>
    <li class="hovermenu"><a href="o/en/themes">Themes</a>
      <ul class="width3">
<?php
global $this_theme;
$inputfile="themes";
$in=fopen($inputfile, "r") or die("Unable to open file '$inputfile'!");
while(!feof($in)) {
  $line=fgets($in);
  $sep=strpos($line, " ");
  if ($sep===FALSE) {
    break;
  }
  $link_target=substr($line, 0, $sep);
  $theme=substr($line, $sep+1, -1);
  if ($theme==$this_theme) {
    echo "        <li><a href='$link_target' class='active'>$theme</a></li>\n";
  } else {
    echo "        <li><a href='$link_target'>$theme</a></li>\n";
  }
}
?>
      </ul></li>
    <li class="hovermenu"><a href="o/en/node/24715">WTO Ministerials</a>
      <ul>
        <li><a href="MC11">11th Ministerial, Buenos Aires 2017</a></li>
        <li><a href="o/en/ministerials/3260">10th Ministerial, Nairobi 2015</a></li>
        <li><a href="o/en/ministerials/3166">9th WTO Ministerial, Bali 2013</a></li>
        <li><a href="o/en/ministerials/3138">8th Ministerial, Geneva 2011</a></li>
        <li><a href="o/en/ministerials/3106">7th WTO Ministerial Geneva 2009</a></li>
        <li><a href="o/en/ministerials/3108">Mini Ministerial, Geneva 2008</a></li>
        <li><a href="o/en/ministerials/3097">6th Ministerial, Hong Kong 2005 </a></li>
        <li><a href="o/en/ministerials/3096">5th Ministerial, Cancùn 2003</a></li>
        <li><a href="o/en/ministerials/3098">4th Ministerial, Doha 2001 </a></li>
        <li><a href="o/en/ministerials/3109">3rd Ministerial, Seattle 1999</a></li>
      </ul></li>
    <li><a href="contact">Contact</a></li>
    <li class="unbold"><a href="https://twitter.com/owinfs">Follow @owinfs</a></li>
    <li><a href="https://www.facebook.com/owinfs/"><img src="f.png" width="14" height="14"></a></li>
  </ul>
</div>
