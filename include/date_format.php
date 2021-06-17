<?php
function owinfs_date_format($date, $language) {
  if ($language=="es") {
    $months=array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
                  'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
  } elseif ($language=="fr") {
    $months=array('janvier', 'février', 'mars', 'avril', 'mai', 'juin',
                  'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'décembre');
  } else {  # "en" or "other"
    $months=array('January', 'February', 'March', 'April', 'May', 'June',
                  'July', 'August', 'September', 'October', 'November', 'December');
  }
  $date_parts=preg_split('/-/', $date);
  if (count($date_parts)==1) {
    if ($date=="9999") {
      return "theme page";
    } elseif ($date=="9998") {
      return "OWINFS information page";
    } else  {
      return $date; # just a year number
    }
  }
  if (count($date_parts)==2) {
   return $months[intval($date_parts[1])-1]." ".$date_parts[0];
  }
  return intval($date_parts[2])." ".$months[intval($date_parts[1])-1]." ".$date_parts[0];
}
?>