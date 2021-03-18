#!/usr/bin/php
<?php
$html_title="";
include './head_etc.php'
?>
    <div id="main" class="group">
<?php
$sidebar_title="About us";
include './sidebar_about.php';
include './navbar.php';
?>

      <div id="content" class="singlecolumn">
        <div id="content-header">
          <h1 class="title"></h1>
	  <h4></h4>
        </div> <!-- /#content-header -->
        
        <div id="content-area" class="video-with-context">
	  <video width="568" height="320" poster="" controls>
            <source src="" type="video/mp4">
            Your browser does not support the video tag. You can still access the video
	    through <a href="">this link</a>.
          </video> 
</div> <!-- /#content-area -->
</div> <!-- /#content -->
</div> <!-- /#main -->
<?php
include './foot_etc.php'
?>
