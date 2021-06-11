#!/usr/bin/php
<?php
$html_title="Search | Our World Is Not For Sale";
include 'include/head_etc.php'
?>
  <div id="main" class="group">
<?php
$sidebar_title="About OWINFS";
include 'include/sidebar_about.php';
include 'include/navbar.php';
?>
    <div id="content" class="singlecolumn">
    <div id="content-header">
      <h1 class="title">Search</h1>
    </div> <!-- /#content-header -->
    <div id="content-area">
      <form action="searchresults.php" accept-charset="UTF-8" method="post">
	  <div class="form-item">
	     <label for="query">Search ourworldisnotforsale.net and the linked external documents:</label>
	     <input id="query" type="text" name="query" size="60" value="">
	  </div>
          <input type="submit" value="Find!">
      </form>
<?php
include 'include/search_instructions.php';
?>
    </div> <!-- /#content-area -->
    </div> <!-- /#content -->
  </div> <!-- /#main -->
<?php
include 'include/foot_etc.php'
?>
