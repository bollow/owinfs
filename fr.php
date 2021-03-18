#!/usr/bin/php
<?php
$html_title="OWINFS - Français";
include './head_etc.php'
?>
    <div id="main">
<?php
$sidebar_title="À propos de OWINFS";
include './sidebar_about_fr.php';
include './navbar_fr.php';
?>
      <div id="content" class="singlecolumn">
        <h1>Ressources actuelles en français</h1>
<?php
include 'article_links.php';
article_links("src", "fr");
?>
        <h1>Couverture médiatique en français</h1>
	<ol>
          <li><a href="https://mobile2.tdg.ch/articles/5a2d6944ab5c372cf1000001">Des ONG ont été
	      refoulées à la réunion de l'OMC</a>, <i>Tribune de Genève</i></li>
	</ol>
      </div> <!-- /#content -->
    </div> <!-- /#main -->
<?php
include './foot_etc.php'
?>
