<?
$dt = time();
$page = $_SERVER['REQUEST_URI'];
$ref = $_SERVER['HTTP_REFERER'];
$path = "$dt|$page|$ref\n";
$f = fopen("log/path.log", 'a') or die("Не могу открыть файл!");
fputs($f, $path);
fclose($f);