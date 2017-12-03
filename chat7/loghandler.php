<!DOCTYPE html><html><body><?php
header("Access-Control-Allow-Origin: https://horrificallycoded.github.io");
$filename = $_GET["fchat"];
if (empty($filename)) {
 $filename = "log";
}
$filename = $filename . ".txt";
if (!file_exists($filename)) {
 $myfile = fopen($filename, w);
 while(!$myfile) {
  $myfile = fopen($filename, w);
 }
 fclose($myfile);
}
$contents = file_get_contents($filename);
$fname = htmlspecialchars($_GET["fname"]);
$fcontent = htmlspecialchars($_GET["fcontent"]);
if (empty($fcontent)) {
 $txt = $contents;
} else {
 $myfile = fopen($filename, "w");
 while(!$myfile) {
  $myfile = fopen($filename, "w");
 }
 
 if ($fcontent == "joined the chat" || $fcontent == "left the chat") {
  $txt = "! " . date('Y-m-d H:i:s') . " &-:-& " . $fname . " " . $fcontent . "<br>";
 } else {
  
  //put markdown here
  if (strpos($fcontent, "/bold ") !== false) {
   $fcontent = "<b>" . str_replace("/bold ", "", $fcontent) . "</b>";
  }
  
  //colors
  if (strpos($fcontent, "/red ") !== false) {
   $fcontent = "<p style=\"color:#FF5252;\">" . str_replace("/red ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/pink ") !== false) {
   $fcontent = "<p style=\"color:#FF4081;\">" . str_replace("/pink ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/purple ") !== false) {
   $fcontent = "<p style=\"color:#E040FB;\">" . str_replace("/purple ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/indigo ") !== false) {
   $fcontent = "<p style=\"color:#536DFE;\">" . str_replace("/indigo ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/blue ") !== false) {
   $fcontent = "<p style=\"color:#448AFF;\">" . str_replace("/blue ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/cyan ") !== false) {
   $fcontent = "<p style=\"color:#00B8D4;\">" . str_replace("/cyan ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/teal ") !== false) {
   $fcontent = "<p style=\"color:#00BFA5;\">" . str_replace("/cyan ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/green ") !== false) {
   $fcontent = "<p style=\"color:#00C853;\">" . str_replace("/green ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/lime ") !== false) {
   $fcontent = "<p style=\"color:#AEEA00;\">" . str_replace("/lime ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/yellow ") !== false) {
   $fcontent = "<p style=\"color:#FFD600;\">" . str_replace("/yellow ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/orange ") !== false) {
   $fcontent = "<p style=\"color:#FF6D00;\">" . str_replace("/orange ", "", $fcontent) . "</p>";
  }
  if (strpos($fcontent, "/brown ") !== false) {
   $fcontent = "<p style=\"color:#795548;\">" . str_replace("/brown ", "", $fcontent) . "</p>";
  }
  
  //images
  if (strpos($fcontent, "/img ") !== false) {
   $fcontent = "<img src=\"" . str_replace("/img ", "", $fcontent) . "\"></img>";
  }
  
  //links
  if (strpos($fcontent, "/link " ) !== false) {
   $fcontent = str_replace("/link ", "", $fcontent);
   $fcontent = "<a href=\"" . $fcontent ."\">" . $fcontent . "</a>";
  }
  
  $color = "#212121";
  $ip = $_GET["request"];
  switch($ip) {
   case 0 :
    $color = "#FF5252";
    break;
   case 1 :
    $color = "#448AFF";
    break;
   case 2 :
    $color = "#00BFA5";
    break;
   case 3 :
    $color = "#00C853";
    break;
   case 4 :
    $color = "#FF6D00";
    break;
   case 5 :
    $color = "#607D8B";
    break;
   case 6 :
    $color = "#536DFE";
    break;
   case 7 :
    $color = "#689f38";
    break;
   case 8 :
    $color = "#00C853";
    break;
   case 9 :
    $color = "#00B8D4";
    break;
  }
  
  $txt = $fname . " - " . date('Y-m-d H:i:s') . " &-:-& " . $fcontent . " &-:-& " . $color . "<br>";
 }
 if (strlen($txt) > 1000) $txt = substr($txt, 0, 10000) . "<br>...";
 fwrite($myfile, $txt);
 fclose($myfile);
}
echo $txt;
$lastedit = filemtime($filename);
if ($_GET["repeat"] == "true") {
 while(true) {
  sleep(0.2);
  if ($lastedit !== filemtime($filename)) {
   echo file_get_contents($filename);
   $lastedit = filemtime($filetime);
  }
 }
}
?></body></html>
