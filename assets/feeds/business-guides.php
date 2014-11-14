<?php
$jsondata = file_get_contents("https://biblio.csusm.edu/course-guides/json/business");
$jsondatanorm = json_decode($jsondata, true);

echo "<h2>Course Guides</h2>";
echo "<ul class=\"unstyled\">";
foreach($jsondatanorm as $cguide => $cguide_data) {
  $title = $cguide_data['title']['content'];
  $guidelink = $cguide_data['field_url_url']['content'];
  $guideid = $cguide_data['field_guide_id_value']['content'];
  if($guideid != 164){
    echo "<li><a class=\"external text guidelink\" href=\"$guidelink\" target=\"_blank\">$title</a></li>";
  }
}
echo "</ul>";

?>
