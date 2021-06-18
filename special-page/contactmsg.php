<?php
$html_title="Contact | Our World Is Not For Sale";
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
      <h1 class="title">Contact</h1>
    </div> <!-- /#content-header -->
    <div id="content-area">
<?php
if ((isset($_POST["name"]) or isset($_POST["mail"]) or isset($_POST["subject"])) and
    (preg_match(",\r|\n,", $_POST["name"]) or preg_match(",\r|\n,", $_POST["mail"]) or
     preg_match(",\r|\n,", $_POST["subject"]))) {
      # Probably an attempted injection attack
      echo "Invaid data.";
} elseif (isset($_POST["message"]) and strlen($_POST["message"])>2) {
    $to_email = "nb@bollow.ch";
    $subject = "OWINFS website: ".$_POST["subject"];
    $add_headers = "From: webform@ourworldisnotforsale.net\r\nReply-To: " . $_POST["name"] . " <" . $_POST["mail"] . ">" . "\r\n";
    $body = $_POST["message"];
    mail($to_email, $subject, $body, $add_headers);
    echo "Thank you. Your message has been received.";
} else {
    echo "You have not provided a message.";
}
?>
    </div> <!-- /#content-area -->
    </div> <!-- /#content -->
  </div> <!-- /#main -->
<?php
include 'include/foot_etc.php'
?>




