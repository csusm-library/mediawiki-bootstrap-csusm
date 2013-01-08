<?php
$targeturl = "https://biblio.csusm.edu/dashboard/subjects/business/xml";
$xml = simplexml_load_file($targeturl);
echo "<h2>Course Guides</h2>";
echo "<ul class=\"unstyled\">";
foreach($xml->entry as $tda) {
  $title = $tda->title;
  $link = $tda->link;
  $guideid = $tda->id;
  if($guideid != 164){
    echo "<li><a href=\"$link\" target=\"_blank\">$title</a></li>";
  }
}
echo "</ul>";
?>
