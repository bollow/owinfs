<?php global $prepend_path; include 'include/hovermenu.php';?>
<div id="navbar">
  <ul>
    <li><a href="<?php echo $prepend_path; ?>./">Accueil</a></li>
<?php global $this_aboutpage; hovermenu("data/aboutpages", $this_aboutpage, "width2", "À propos") ?>
    <!-- <li><a href="o/en/news">News</a></li> -->
<?php global $this_theme; hovermenu("data/themes", $this_theme, "width3", "Thèmes") ?>
    <li class="hovermenu"><a href="<?php echo $prepend_path; ?>o/en/node/24715">Ministérielles</a>
      <ul>
        <li><a href="<?php echo $prepend_path; ?>o/en/node/24715">11th Ministerial, Buenos Aires 2017</a></li>
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
