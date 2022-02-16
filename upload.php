<?php
# file upload requires "file_uploads = On" in php.ini

if (preg_match('/test/', $_SERVER['REQUEST_URI'])) {
  $test_mode=true;
  $html_title="TEST document upload to OWINFS website";
  $test_extra_dir="/test";
} else {
  $test_mode=false;
  $html_title="UPLOAD document to OWINFS website";
  $test_extra_dir="";
}
chdir("/srv/owinfs-generate$test_extra_dir");

include 'include/head_etc.php';
?>
  <div id="main" class="group">
<?php
$overwrite_maxage_string="48 hours";
$overwrite_maxage=48*3600; # in seconds
$tmp_target_dir="uploads";
$final_target_dir="public";
$extra_data_dir="extra_data";

include 'include/upload_passwords.php';
$sidebar_title="About OWINFS";
include 'include/sidebar_about.php';
include 'include/navbar.php';
?>
    <div id="content" class="singlecolumn">
    <div id="content-header">
      <h1 class="title"><?php echo $html_title; ?></h1>
    </div> <!-- /#content-header -->
    <div id="content-area">

<?php
$authorized=false;
$document_in_tmpdir=false;
$show_form=true;
# echo phpinfo();

if (isset($_POST["password"]) and strlen($_POST["password"])>0 ) {
  $password=$_POST["password"];
  if (isset($passwords[$password])) {
    echo "<p>You are logged in as: <b>{$passwords[$password]}.</b></p>\n";
    $authorized=true;
  } else {
    echo("<p style='color:red'><b>Error: Invalid password.</b></p>\n");
    $show_form=false;
  }
} else {
  echo("<p style='color:red'><b>Error: Missing password.</b></p>\n");
  $show_form=false;
}

$fnam = (isset($_POST["fnam"]) ? preg_replace('/[^A-Za-z0-9._+-]/', '', $_POST["fnam"]) : "");
$title= (isset($_POST["title"]) ? $_POST["title"] : "");
$date = (isset($_POST["date"]) ? $_POST["date"] : "");
$add_to_homepage_checked = (isset($_POST["add_to_homepage"]) ? "checked" : "");
$file = "$tmp_target_dir/$fnam";
if (preg_match('/\d\d\d\d/', $date, $m)){
  $year=$m[0];
} else {
  $year=date("Y");
};
$final_file="$final_target_dir/$year/$fnam";
if ($authorized and isset($_FILES["doc"]) and $_FILES["doc"]["name"]) {
  if (isset($_POST["fnam"])) {
    if (file_exists($final_file) and time()-filemtime($final_file) > $overwrite_maxage) {
      echo("<p style='color:red'><b>Error: The document “$fnam” already exists on the server, and it is more than $overwrite_maxage_string old. It therefore cannot be updated by means of this form anymore.</b></p>\n");
    } elseif (strlen($fnam)>0) {
      if (strlen($fnam)<strlen($_POST["fnam"])) {
        $bad_char_count=strlen($_POST["fnam"])-strlen($fnam);
        $bad_char_count_string=($bad_char_count>1 ? strlen($_POST["fnam"])-strlen($fnam) . "characters" : "a character");
        echo "<p>NOTE: You specified the filename “" . htmlspecialchars($_POST["fnam"]) . "”. That filename will not be used as-is, because it contains $bad_char_count_string other than the allowed characters A-Z, a-z, '_', '-', '+', '.'. Instead, “{$fnam}” will be used.</p>\n";
      }
      if ($file == "." or $file == "..") {
        echo "<p style='color:red'><b>ERROR: The filename “$file” cannot be used for technical reasons.</b></p>\n";
      } elseif ($file == "test") {
        echo "<p style='color:red'><b>ERROR: The filename “$file” can only be used is test mode.</b></p>\n"; # because it otherwise conflicts with the "test" subdirectory
      } else {
        $orig_fnam=htmlspecialchars(basename( $_FILES["doc"]["name"]));
        if (move_uploaded_file($_FILES["doc"]["tmp_name"], $file)) {
          echo "<p style='color:green'><b>The OWINFS webserver has received a document from you. On your computer, this document had the filename “{$orig_fnam}”. On the OWINFS webserver, it has been uploaded under the filename “{$fnam}”.</b></p>\n";
	  $document_in_tmpdir=true;
        } else {
          echo "<p style='color:red'><b>Sorry, there was an unexpected technical error uploading your document.</b></p>\n";
	  $show_form=false;
        }
      }
    } else {
      if (strlen($_POST["fnam"])>0) {
        echo "<p style='color:red'><b>ERROR: You specified the filename “" . htmlspecialchars($_POST["fnam"]) . "”. That filename will not be used, because it does not contain the allowed characters A-Z, a-z, '_', '-', '+', '.'.</b></p>\n";
      } else {
        echo "<p style='color:red'><b>ERROR: No filename specified.</b></p>\n";
      }
    }
  } else {
    echo "<p style='color:red'><b>ERROR: No filename specified.</b></p>\n";
  }
} else {
  if ($authorized and strlen($fnam)>0 and file_exists($file) and $fnam!="." and $fnam!="..") {
    echo "<p>Working with the document “{$fnam}”.</p>\n";
    $document_in_tmpdir=true;
  }
}
if ($document_in_tmpdir) {
  if ($title=="") {
    echo "<p style='color:red'><b>ERROR: No title specified. You need to specify the title for the document, so that it can be used for linking to it.</b></p>\n";
  } elseif (strlen($title)<5) {
    echo "<p style='color:red'><b>ERROR: Title too short. You need to specify a reasonable title for the document, so that it can be used for linking to it.</b></p>\n";
  } elseif (file_exists($final_file) and $_POST["submit"]!="Proceed!") {
    echo "<p style='color:red'><b>WARNING: There is already a version of the document “" . $fnam . "” on the server. It is less than $overwrite_maxage_string old. If you proceed, it will be overwritten.</b></p>\n";
    echo "<p>Title: " . htmlspecialchars($title) . "</p>\n";
    echo "<p>Date: " . htmlspecialchars($date) . "</p>\n";
    echo "<p>Add to MC12 page: yes</p>\n";
    if (isset($_POST["add_to_homepage"])) {
      $checkbox_info='<input type="hidden" name="add_to_homepage" value="on">';
      echo "<p>Add to homepage: yes</p>\n";
    } else {
      $checkbox_info='<!-- no add_to_homepage -->';
      echo "<p>Add to homepage: no</p>\n";
    }
?>
<form method="post">
  <input type="hidden" name="fnam" value="<?php echo $fnam; ?>">
  <input type="hidden" name="date"  value="<?php echo htmlspecialchars($date); ?>">
  <input type="hidden" name="title"  value="<?php echo htmlspecialchars($title); ?>">
  <input type="hidden" name="password"  value="<?php echo htmlspecialchars($password); ?>">
  <?php echo $checkbox_info; ?>
  <p>
  <input type="submit" name="submit" value="Proceed!" style='color:red'>
</form>
<?php
    $show_form=false;
  } else {
    $show_form=false;
    rename($file, $final_file);
    if (file_exists($final_file)) {
      echo "<p style='color:green'><b>SUCCESS: The document is now available as:<br><a href='https://ourworldisnotforsale.net$test_extra_dir/$year/$fnam'>https://ourworldisnotforsale.net$test_extra_dir/$year/$fnam</a></b></p>\n";
      $title_string=htmlspecialchars(preg_replace("/\n/","",$title));
      $date_string=$date ? "(".htmlspecialchars(preg_replace("/\n/","",$date)).")" : "";
      update_page("WTO-MC-page", "MC12", "MC12 page", $fnam, "<p>\n<i><a href='$year/$fnam'>$title_string</a></i> $date_string\n");
      if (isset($_POST["add_to_homepage"])) {
        update_page("special-page", "index", "homepage", $fnam, "<p>\n<b><i><a href='$year/$fnam'>$title_string</a></i></b>\n");
      }
    } else {
          echo "<p style='color:red'><b>Sorry, an unexpected technical error occurred while publishing your document.</b></p>\n";
    }
  }
}
if ($show_form) {
?>
      <form accept-charset="UTF-8" method="post" enctype="multipart/form-data">
        <input type="hidden" name="password" value="<?php echo htmlspecialchars($password); ?>">
<?php
if ($document_in_tmpdir) {
?>
        <input type="hidden" name="fnam" value="<?php echo $fnam; ?>">
<?php
} else {
?>
	  <div class="form-item">
	     <label for="doc">Document upload:</label>
	     <input id="doc" type="file" name="doc">
          </div>
	  <div class="form-item">
	     <b>Typically, the filename which will be used for the document on the webserver
	     will be different from the filename that was used while preparing the document.</b>
	     Filename conventions for this site: If the document is a <b>L</b>etter or a
	     media <b>R</b>elease coordinated by the OWINFS network, start the filename with
	     “L_” or “R_” respectively. Otherwise start with a short indication of the origin
	     of the document followed by “_”. End the filename e.g. with “.pdf” if it’s a pdf,
	     etc. For documents in a language other than English, add e.g. “_ES” or “_FR”
	     right before the “.pdf” or equivalent. For example, if we had a document in English
	     and French from the UN Secretary General calling for the WTO to be dissolved, we
	     could use the filenames “UNSG_dissolve_WTO.pdf” and “UNSG_dissolve_WTO_FR.pdf”.
	     <p>
	     <label for="fnam">Specify a filename (max 33 characters; allowed: A-Z, a-z, "_", "-", "+", "."), which will be part of the URL:</label>
	     <input id="fnam" type="text" name="fnam" maxlength="33" size="33" value="<?php echo $fnam; ?>">
	  </div>
<?php
}
?>
	  <div class="form-item">
	     <label for="title">Document title, will be linked to the document:</label>
	     <input id="title" type="text" name="title" maxlength="300" size="90" value="<?php echo htmlspecialchars($title); ?>">
	  </div>
	  <div class="form-item">
	     <label for="date">Document date, the preferred format is like “1 January 2021”:</label>
	     <input id="date" type="text" name="date" maxlength="20" size="20" value="<?php echo $date; ?>">
	  </div>
	  For all files which are uploaded through this form, a link is added in a
	  “Recent documents” section of the <a href="MC12">MC12 page</a>; that section
	  exists only when there are recent documents that have been uploaded with this
	  form, and which have not yet been moved to the corresponding thematic section.
	  <div class="form-item">
	     <label for="add_to_homepage">Particularly important documents can also immediately be added to the homepage:</label>
	     <input id="add_to_homepage" name="add_to_homepage" type="checkbox" <?php echo $add_to_homepage_checked; ?>>
             Check this box to add a link to this document on the OWINFS homepage.
          </div>
          <input type="submit" name="submit" value="Upload!">
      </form>
    </div> <!-- /#content-area -->
    </div> <!-- /#content -->
  </div> <!-- /#main -->
<?php
}
include 'include/foot_etc.php';

function update_page($dir, $page, $page_description, $fnam, $additional_link) {
  global $extra_data_dir, $final_target_dir;
  
  # a separate lockfile is needed because of the trick with rename below
  $lockfile=fopen("$extra_data_dir/$page.lock", "w");
  if($lockfile===false) {
    echo "<p style='color:red'><b>ERROR: An unexpected technical problem occurred while ensuring lockfile existence the $page_description.</b></p>\n";
    return;
  }
  if(flock($lockfile, LOCK_EX)===false) {
    echo "<p style='color:red'><b>ERROR: An unexpected technical problem occurred while attempting to acquire a lock for updating $page_description.</b></p>\n";
    return;
  }
  $datafile="$extra_data_dir/$page.extra_data";
  $old_links=file_get_contents($datafile);
  if($old_links===false) {
    echo "<p style='color:red'><b>ERROR: An unexpected technical problem occurred while reading existing links for the $page_description.</b></p>\n";
    return;
  }
  # the caller is responsible for ensuring that the new link contains exactly two \n characters,
  # as expected, with no stray \n characters injected via the title and date fields, as that would
  # make the below logic invalid when the file is read again

  # replace any old link entries for the same file
  $qfnam=preg_quote($fnam);
  if (preg_match("/<p>\n(<b>)?<i><a href='....\/$qfnam'>/", $old_links)) {
    $new_links=preg_replace("/<p>\n(<b>)?<i><a href='....\/$fnam'>.*\n/", $additional_link, $old_links);
  } else {
    $new_links=$additional_link.$old_links;
  }
  # write to a new file and then rename, because the rename operation is atomic and hence
  # avoids data loss risks
  if(file_put_contents("$datafile.new", $new_links)===false) {
    echo "<p style='color:red'><b>ERROR: An unexpected technical problem occurred while writing data for the $page_description.</b></p>\n";
    return;
  }
  if(rename("$datafile.new", $datafile)===false) {
    # strangely, this case seems to be reached even if the rename was successful
    echo "<p style='color:red'><b>ERROR: An unexpected technical problem occurred while updating data for the $page_description.</b></p>\n";
    # return;
  }
  exec("/usr/bin/php $dir/$page.php > $final_target_dir/$page.html", $output, $result_code);
  if($result_code) {
    echo "<p style='color:red'><b>ERROR: An unexpected technical problem occurred while updating the $page_description.</b></p>\n";
    return;
  }
  echo "<p style='color:green'><b>SUCCESS: The $page_description has been updated.</b></p>\n";
  fclose($lockfile); # releases the lock
}

?>
