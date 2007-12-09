<?php
require_once 'XML/Unserializer.php'; 
// Include XML_Unserializer
require_once 'XML/Unserializer.php';

$file = 'researchers.xml'; 

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
foreach ($data['Researcher'] as $i => $row) { 
  $j=$i+1;
  echo "  r$j:\n";
  echo "    name: " . $row['Name'] . "\n";
  echo "    organization: " . $row['Organization'] . "\n";
  echo "    email: " . $row['Email'] . "\n";
  echo "    picture_link: " . $row['Picture-Link'] . "\n";
  echo "    bio_statement: " . $row['Bio-Statement-Link'] . "\n";

} 

?>
