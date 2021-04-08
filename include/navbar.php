<?php global $prepend_path; include 'include/hovermenu.php';?>
<div id="navbar">
  <ul>
    <li><a href="<?php echo $prepend_path; ?>./">Home</a></li>
<?php global $this_aboutpage; hovermenu("data/aboutpages", $this_aboutpage, "width2") ?>
    <li><a href="<?php echo $prepend_path; ?>news">News</a></li>
<?php global $this_theme; hovermenu("data/themes", $this_theme, "width3") ?>
<?php global $this_mc; hovermenu("data/wto-mc", $this_mc, "") ?>
    <li><a href="<?php echo $prepend_path; ?>contact">Contact</a></li>
    <li class="unbold"><a href="https://twitter.com/owinfs">Follow @owinfs</a></li>
    <li><a href="https://www.facebook.com/owinfs/"><img src="<?php echo $prepend_path; ?>f.png" width="14" height="14"></a></li>
  </ul>
</div>
