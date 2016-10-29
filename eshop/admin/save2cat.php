<?php
	// подключение библиотек
	require_once "secure/session.inc.php";
	require_once "../inc/config.inc.php";
	require_once "../inc/lib.inc.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $title = trim(strip_tags($_POST['title']));
        $author = trim(strip_tags($_POST['author']));
        $pubyear = (int)$_POST['pubyear'];
        $price = (int)$_POST['price'];
        if(!addItemToCatalog($title, $author, $pubyear, $price)){
            echo "Произошла ошибка при добавлении товара в каталог";
        }else{
            header("Location: add2cat.php");
            exit;
        }
    }