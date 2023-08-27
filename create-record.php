<?php

date_default_timezone_set('Europe/Moscow');

$date = date('o-m-d');
$time = date('H:i:s');
$when = $_GET["when"];
$cldns = $_GET["cloudiness"];
$temp = $_GET["temp"];
$windd = $_GET["windd"];
$winds = $_GET["winds"];
$prs = $_GET["pressure"];
$city = $_GET["city"];
$phenomena = $_GET["phenomena"];
$year = date('o');
$month = date('m');

$link = mysqli_connect('127.0.0.1', 'root', '', 'myWeather');

if ($link == false) {
 echo '<p>Не удалось подключиться к MySQL.<br><code>'.mysqli_connect_error().'</code></p>';
} else {
 mysqli_set_charset($link, 'utf8');
 $sql = "INSERT INTO `weather_day`(`date`, `time`, `when`, `cloudiness`, `phenomena`, `temperature`, `wind_speed`, `wind_direction`, `pressure`, `city`, `month`, `year`) VALUES ('".$date."','".$time."','".$when."','".$cldns."','".$phenomena."','".$temp."','".$winds."','".$windd."','".$prs."','".$city."','".$month."','".$year."')";
 $result = mysqli_query($link, $sql);

 if ($result == false) {
  echo '<p>При выполнении запроса произошла ошибка.</p>';
 } else {
  echo '<p>Запрос успешно выполнен: запись добавлена.<br><a href="/">Вернуться на главную</a></p>';
 }
}

echo "<script>setTimeout(() => window.location.href = '/', 1000);</script>";

?>