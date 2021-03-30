    <div id="sidebar">
      <div id="sidebar-inner">
        <h2 class="title">About us</h2>
        <div class="content">
        <p>The “Our World is not for Sale” (OWINFS) network is a loose grouping of organizations,
        activists and social movements worldwide fighting the current model of corporate
        globalization embodied in global trading system. OWINFS is committed to a sustainable,
        socially just, democratic and accountable multilateral trading system.</p>
          <ul>
	    <li><a href="<?php global $prepend_path; echo $prepend_path; ?>o/en/about">About us</a>
<?php
global $this_aboutpage;
$inputfile="data/aboutpages";
$in=fopen($inputfile, "r") or die("Unable to open file '$inputfile'!");
while(!feof($in)) {
  $line=fgets($in);
  $sep=strpos($line, " ");
  if ($sep===FALSE) {
    break;
  }
  $link_target=substr($line, 0, $sep);
  $aboutpage=substr($line, $sep+1, -1);
  if ($aboutpage==$this_aboutpage) {
    echo "            <li><a href='$prepend_path$link_target' class='active'>$aboutpage</a></li>\n";
  } else {
    echo "            <li><a href='$prepend_path$link_target'>$aboutpage</a></li>\n";
  }
}
?>
          </ul>
        </div> <!-- /content -->
        <img src="<?php echo $prepend_path; ?>logo_owinfs_red.png" alt="Our World Is Not For Sale logo"
             width="230" height="225">
      </div> <!-- /#sidebar-inner -->
    </div> <!-- /#sidebar -->
