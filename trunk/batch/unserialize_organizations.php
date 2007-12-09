<?php
require_once 'XML/Unserializer.php'; 
// Include XML_Unserializer
require_once 'XML/Unserializer.php';

$file = 'organizations.xml'; 

$handle = fopen($file,'r');

$doc = fread($handle, filesize($file));

fclose($handle);

// Instantiate the serializer
$Unserializer = &new XML_Unserializer();

// Serialize the data structure
$status = $Unserializer->unserialize($doc);

// Check whether serialization worked
if (PEAR::isError($status)) {
   die($status->getMessage());
}

// Display the PHP data structure
#var_dump($Unserializer->getUnserializedData());
$data = $Unserializer->getUnserializedData(); 
/*
echo '<pre>';
var_dump($data);
echo '</pre>';
*/

foreach ($data['Organization'] as $i => $row) { 
  $j = $i+1;
  echo "  o$j:\n";
  echo "    name: " . $row['Name'] . "\n";
  echo "    organization_type_id: " . $row['Type'] . "\n";
  echo "    country: " . $row['Country'] . "\n";
  echo "    home_page: " . $row['Home-Page'] . "\n";
  echo "    research_description: " . $row['Research-Description'] . "\n";
} 

?>
