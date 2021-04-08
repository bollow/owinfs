    <div id="sidebar">
      <div id="sidebar-inner">
        <h2 class="title">WTO Ministerials</h2>
  <div class="content">
    <ul class="menu">
<?php
global $this_mc;
global $prepend_path;
$inputfile="data/wto-mc";
$in=fopen($inputfile, "r") or die("Unable to open file '$inputfile'!");
while(!feof($in)) {
  $line=fgets($in);
  $sep=strpos($line, " ");
  if ($sep===FALSE) {
    break;
  }
  $link_target=substr($line, 0, $sep);
  $mc=substr($line, $sep+1, -1);
  if ($link_target=="*") {
    # this is a heading, not a theme link
    echo "     </ul><u><b>$mc</b></u><ul>\n";
  } elseif ($link_target!="**") {
    if ($mc==$this_mc) {
      echo "            <li><a href='$prepend_path$link_target' class='active'>$mc</a></li>\n";
    } else {
      echo "            <li><a href='$prepend_path$link_target'>$mc</a></li>\n";
    }
  }
}
?>
</ul>  </div>
        <h2 class="title">&nbsp;</h2>
        <img src="logo_owinfs_red.png" alt="Our World Is Not For Sale logo"
             width="230" height="225">
        <p>The “Our World is not for Sale” (OWINFS) network is a loose grouping of organizations,
        activists and social movements worldwide fighting the current model of corporate
        globalization embodied in global trading system. OWINFS is committed to a sustainable,
        socially just, democratic and accountable multilateral trading system.</p>
	<p><a href="statement-political-unity">Statement of political unity</a></p>
	<p><a href="https://ourworldisnotforsale.net/2017/OWINFS_Flyer.pdf">Our World is Not for Sale (OWINFS) one-page flyer</a></p>
      </div> <!-- /#sidebar-inner -->
    </div> <!-- /#sidebar -->
