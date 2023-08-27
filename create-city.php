<?php

$name = $_GET["nm"];

$link = mysqli_connect('127.0.0.1', 'root', '', 'myWeather');

if ($link == false) {
 echo '<p>Не удалось подключиться к MySQL.<br><code>'.mysqli_connect_error().'</code></p>';
} else {
 mysqli_set_charset($link, 'utf8');
 $sql1 = 'SELECT * FROM `cities`';
 $result1 = mysqli_query($link, $sql1);
 $row_cnt = mysqli_num_rows($result1);
 $id = $row_cnt+1;

 $sql = 'INSERT INTO `cities`(`id`, `name`) VALUES ("'.$id.'", "'.$name.'")';
 $result = mysqli_query($link, $sql);

 if ($result == false) {
  echo '<p>При выполнении запроса произошла ошибка.</p>';
 } else {
  echo '<p>Запрос успешно выполнен: город добавлен.<br><a href="/">Вернуться на главную</a></p>';
 }
}

echo "<script>setTimeout(() => window.location.href = '/', 1000);</script>";

?>