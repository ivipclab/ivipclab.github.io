


<?php 
file_put_contents('users.txt', 'testing' . "\n", FILE_APPEND); 

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "Bill Gates\n";
fwrite($myfile, $txt);
$txt = "Steve Jobs\n";
fwrite($myfile, $txt);
fclose($myfile);

?>