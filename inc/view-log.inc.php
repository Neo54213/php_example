<?
if(file_exists("log/path.log")){
    $lines = file("log/path.log");
}
$i = 0;
while(isset($lines[$i + 1])){
    echo $lines[$i];
    $i++;
}    