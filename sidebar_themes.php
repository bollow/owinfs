    <div id="sidebar">
      <div id="sidebar-inner">
        <h2 class="title">Themes</h2>
        <div class="content">
          <ul class="menu">
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
    echo "            <li><a href='$link_target' class='active'>$theme</a></li>\n";
  } else {
    echo "            <li><a href='$link_target'>$theme</a></li>\n";
  }
}
?>
          </ul>
        </div> <!-- /content -->

       <h2 class="title">&nbsp;</h2>
       <img src="logo_owinfs_red.png" alt="Our World Is Not For Sale logo"
             width="230" height="225">
        <h2 class="title">About us</h2>
        <p>The “Our World is not for Sale” (OWINFS) network is a loose grouping of organizations,
        activists and social movements worldwide fighting the current model of corporate
        globalization embodied in global trading system. OWINFS is committed to a sustainable,
        socially just, democratic and accountable multilateral trading system.</p>
	<p><a href="statement-political-unity">Statement of political unity</a></p>
	<p><a href="https://ourworldisnotforsale.net/2017/OWINFS_Flyer.pdf">Our World is Not for Sale (OWINFS) one-page flyer</a></p>
      </div> <!-- /#sidebar-inner -->
    </div> <!-- /#sidebar -->
