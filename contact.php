#!/usr/bin/php
<?php
$html_title="Contact | Our World Is Not For Sale";
include './head_etc.php'
?>
  <div id="main" class="group">
<?php
$sidebar_title="About OWINFS";
include './sidebar_about.php';
include './navbar.php';
?>
    <div id="content" class="singlecolumn">
    <div id="content-header">
      <h1 class="title">Contact</h1>
    </div> <!-- /#content-header -->
    <div id="content-area">
      <form action="contactmsg" accept-charset="UTF-8" method="post">
        You can use this form to contact us.
	  <div class="form-item">
	     <label for="name">Your name: <font color="red">*</font></label>
	     <input id="name" type="text" maxlength="255" name="name" size="60" value="">
	  </div>
          <div class="form-item">
	    <label for="mail">Your e-mail address: <font color="red">*</font></label>
	    <input id="mail" type="text" maxlength="255" name="mail" size="60" value="">
	  </div>
          <div class="form-item">
	    <label for="subject">Subject: <font color="red">*</font></label>
	    <input id="subject" type="text" maxlength="255" name="subject" size="60" value="">
	  </div>
          <div class="form-item">
	    <label for="message">Message: <font color="red">*</font></label>
	    <textarea id="message" cols="60" rows="5" name="message"></textarea>
	  </div>
          <input type="submit" value="Send the message">
      </form>
    </div> <!-- /#content-area -->
    </div> <!-- /#content -->
  </div> <!-- /#main -->
<?php
include './foot_etc.php'
?>




