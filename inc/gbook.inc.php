<?php
/* Основные настройки */
const DB_HOST = 'localhost';
const DB_LOGIN = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'gbook';
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
/* Основные настройки */

/* Сохранение записи в БД */
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = trim(strip_tags($_POST['name']));
    $email =  trim(strip_tags($_POST['email']));
    $msg =  trim(strip_tags($_POST['msg']));
    $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo mysqli_error($link);
    }
}
/* Сохранение записи в БД */

/* Удаление записи из БД */
if(isset($_GET['del'])){
    $del = $_GET['del'];
    $sql = "DELETE FROM msgs WHERE id = $del";
    $result = mysqli_query($link, $sql);
    if($result){
        echo mysqli_error($link);
    }
}
/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>
<?php
/* Вывод записей из БД */
$sql = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt 
FROM msgs
ORDER BY id DESC";
$result = mysqli_query($link, $sql);
mysqli_close($link);
      
$row_count = mysqli_num_rows($result);
echo "<p>Всего записей в гостевой книге: $row_count</p>";
for($i = 0; $i < $row_count; $i++){
    echo "<p class='row'>";
    $row = mysqli_fetch_assoc($result);
    echo "<a href='mailto:{$row['email']}'>{$row['name']}</a>: {$row['msg']} ";
    echo "<a href='{$_SERVER['REQUEST_URI']}&del={$row['id']}'>Удалить</a>";
    echo "</p>";
}
/* Вывод записей из БД */
?>