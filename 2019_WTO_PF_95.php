#!/usr/bin/php
<?php
$html_title="Session #95 @ WTO Public Forum 2019";
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
          <h1 class="title">Future of WTO in a digitalised world</h1>
	  <h4>Session at the WTO Public Forum, 10 Oct 2019</h4>
        </div> <!-- /#content-header -->
        
        <div id="content-area" class="video-with-context">
	  <video width="568" height="320" poster="/2019/WTO_PF_95.jpg" controls>
            <source src="/2019/WTO_PF_95.mp4" type="video/mp4">
            Your browser does not support the video tag. You can still access the video
	    through <a href="/2019/WTO_PF_95.mp4">this link</a>.
          </video> 
</div> <!-- /#content-area -->
</div> <!-- /#content -->
</div> <!-- /#main -->
<?php
include './foot_etc.php'
?>
