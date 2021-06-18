#!/usr/bin/php
<?php
$html_title="OWINFS - Français";
include 'include/head_etc.php'
?>
    <div id="main">
<?php
$language="fr";
include 'include/sidebar_aboutpage.php';
include 'include/navbar_fr.php';
?>
      <div id="content" class="singlecolumn">
        <h1>Ressources actuelles en français</h1>
<?php
include 'include/article_links.php';
article_links("data/articles", "fr");
?>
      </div> <!-- /#content -->
    </div> <!-- /#main -->
<?php
include 'include/foot_etc.php'
?>
