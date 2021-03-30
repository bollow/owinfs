<?php global $prepend_path; ?>
<div id="navbar">
  <ul>
    <li><a href="<?php echo $prepend_path; ?>./">Home</a></li>
    <li class="hovermenu"><a href="<?php echo $prepend_path; ?>o/en/about">About us</a>
      <ul class="width2">
        <li><a href="<?php echo $prepend_path; ?>o/en/node/4">What is the WTO?</a></li>
	<li><a href="<?php echo $prepend_path; ?>o/en/node/2">Key positions and statements</a></li>
	<li><a href="<?php echo $prepend_path; ?>members">Members</a></li>
	<li><a href="<?php echo $prepend_path; ?>o/en/node/2254">Becoming an OWINFS member</a></li>
	<li><a href="<?php echo $prepend_path; ?>o/en/node/3" title="WTO: Shrink or Sink! — A Critique of the WTO">Critique of the WTO</a></li>
      </ul></li>
    <li><a href="<?php echo $prepend_path; ?>news">News</a></li>
    <li class="hovermenu"><a href="<?php echo $prepend_path; ?>o/en/themes">Themes</a>
      <ul class="width3">
<?php
global $this_theme;
$inputfile="data/themes";
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
    echo "        <li><a href='$prepend_path$link_target' class='active'>$theme</a></li>\n";
  } else {
    echo "        <li><a href='$prepend_path$link_target'>$theme</a></li>\n";
  }
}
?>
      </ul></li>
    <li class="hovermenu"><a href="<?php echo $prepend_path; ?>o/en/node/24715">WTO Ministerials</a>
      <ul>
        <li><a href="<?php echo $prepend_path; ?>MC11">11th Ministerial, Buenos Aires 2017</a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3260">10th Ministerial, Nairobi 2015</a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3166">9th WTO Ministerial, Bali 2013</a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3138">8th Ministerial, Geneva 2011</a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3106">7th WTO Ministerial Geneva 2009</a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3108">Mini Ministerial, Geneva 2008</a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3097">6th Ministerial, Hong Kong 2005 </a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3096">5th Ministerial, Cancùn 2003</a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3098">4th Ministerial, Doha 2001 </a></li>
        <li><a href="<?php echo $prepend_path; ?>o/en/ministerials/3109">3rd Ministerial, Seattle 1999</a></li>
      </ul></li>
    <li><a href="<?php echo $prepend_path; ?>contact">Contact</a></li>
    <li class="unbold"><a href="https://twitter.com/owinfs">Follow @owinfs</a></li>
    <li><a href="https://www.facebook.com/owinfs/"><img src="<?php echo $prepend_path; ?>f.png" width="14" height="14"></a></li>
  </ul>
</div>
