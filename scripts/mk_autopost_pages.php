#!/usr/bin/php
<?php
include 'include/upload_passwords.php';
foreach ($passwords as $password => $user) {
$page = <<<END
<!DOCTYPE html>
<html>
<head>
<title>UPLOAD document to OWINFS website</title>
</head>
<body>
<!-- autopost page for $user -->
<h1>UPLOAD document to OWINFS website</h1>
<noscript>
Since you have javascript disabled, one additional click is required to reach the
form for uploading documents to the OWINFS website:
</noscript>
<form name="go" method="post" action="upload.php">
  <input type="hidden" value="$password" name="password"></input>
  <p>
  <input type="submit" value="Go to the form for uploading documents!" >
</form>
<script type="text/javascript">
window.onload = function() {
   document.forms["go"].submit();
}
</script>
</body>
</html>
END;
  file_put_contents("upload_password=$password.html", $page);
}