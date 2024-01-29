<?php

header('HTTP/1.1 200 OK');
header('Content-Type: text/html');

$cmd = isset($_GET["cmd"])? $_GET["cmd"]: "[null]";
if ($cmd == '[null]') {
 $cmd_1 = '';
} else {
 $cmd_1 = &$cmd;
}

echo '<!DOCTYPE html>
<html lang="ru" dir="ltr">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Терминал | Дневник погоды</title>
  <link rel="stylesheet" href="/static/css/gen.css" media="all" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" media="all" type="text/css">
  <style type="text/css">
   input:not([type="submit"]), textarea {
    font-family: monospace;
   }
   input:not([type="submit"]) {
    width: 80%;
   }
  </style>
 </head>
 <body>
  <noscript><div class="notification warning"><img src="/static/img/ic/warning.png" alt="Значок предупреждения"> В этом браузере отключён JavaScript</div></noscript>
  <h2>Терминал</h2>
  <form action="/terminal.php" method="get">
   <input type="text" name="cmd" placeholder="Команда" value="'.$cmd_1.'">
   <input type="submit" class="material-symbols-outlined" value="arrow_right" aria-label="Выполнить введённую команду">
  </form><br>
  <textarea placeholder="Результат выполнения" cols="40" rows="10" readonly>';

if ($cmd == '[null]' || $cmd == '') {
 echo '';
} else if ($cmd == '--install') {
 $link = mysqli_connect('127.0.0.1', 'root', '');
 if ($link == false) {
  echo 'Ошибка подключения к MySQL: #'.mysqli_connect_errno().': '.mysqli_connect_error();
 } else {
  echo 'Соединение с MySQL успешно установлено.
----------------
Установка кодировки на UTF-8... ';
  mysqli_set_charset($link, 'utf8');
echo 'Готово
----------------
Создание базы данных «myWeather»... ';
$sql = 'CREATE DATABASE `myWeather`';
$result = mysqli_query($link, $sql);
if (!$link) {
 echo 'Ошибка
#'.mysqli_connect_errno().': '.mysqli_connect_error();
} else {
 echo 'Готово
----------------
Создание таблицы «cities»... ';
}
$sql = 'CREATE TABLE `myWeather`.`cities` (`id` INT NOT NULL , `name` TEXT NOT NULL ) ENGINE = MyISAM';
$result = mysqli_query($link, $sql);
if (!$link) {
 echo 'Ошибка
#'.mysqli_connect_errno().': '.mysqli_connect_error();
} else {
 echo 'Готово
----------------
Создание таблицы «weather_day»... ';
}
$sql = 'CREATE TABLE `myWeather`.`weather_day` (`date` DATE NOT NULL , `time` TIME NOT NULL , `cloudiness` INT NOT NULL , `phenomena` TEXT NOT NULL , `temperature` INT NOT NULL , `wind_speed` INT NOT NULL , `wind_direction` TEXT NOT NULL , `pressure` INT NOT NULL , `city` INT NOT NULL , `month` INT NOT NULL , `year` INT NOT NULL ) ENGINE = MyISAM';
$result = mysqli_query($link, $sql);
if (!$link) {
 echo 'Ошибка
#'.mysqli_connect_errno().': '.mysqli_connect_error();
} else {
 echo 'Готово
----------------
Ура! Всё ГОТОВО!
Перейдите на главную и в «параметрах» в строке «город» нажмите «+» и добавьте первый город в дневнике. Затем нажмите «Создать запись» и создайте первую запись в дневнике (не забудьте выбрать нужный город, если у Вас из несколько!). Нажмите «Условные обозначения», чтобы узнать, какие условные обозначения и сокращения что обозначают.

====== КОНЕЦ ======';
}
 }
} else if ($cmd == '--uninstall') {
 echo 'Сожалеем, что Вы хотите удалить «Дневник погоды».
***************
';
 $link = mysqli_connect('127.0.0.1', 'root', '');
 if ($link == false) {
  echo 'Ошибка подключения к MySQL: #'.mysqli_connect_errno().': '.mysqli_connect_error();
 } else {
  echo 'Соединение с MySQL успешно установлено.
----------------
Установка кодировки на UTF-8... ';
  mysqli_set_charset($link, 'utf8');
echo 'Готово
----------------
Удаление базы данных «myWeather»... ';
$sql = 'DROP DATABASE `myWeather`';
$result = mysqli_query($link, $sql);
if (!$link) {
 echo 'Ошибка
#'.mysqli_connect_errno().': '.mysqli_connect_error();
} else {
 echo 'Готово
----------------
ГОТОВО! Теперь Вы можете удалить файлы «Дневника погоды».
====== КОНЕЦ ======';
}
}
} else if ($cmd == '--clear') {
 $link = mysqli_connect('127.0.0.1', 'root', '', 'myWeather');
 if ($link == false) {
  echo 'Ошибка подключения к MySQL: #'.mysqli_connect_errno().': '.mysqli_connect_error();
 } else {
  echo 'Соединение с MySQL успешно установлено.
----------------
Установка кодировки на UTF-8... ';
  mysqli_set_charset($link, 'utf8');
echo 'Готово
----------------
Очистка таблицы «cities»... ';
$sql = 'TRUNCATE `cities`';
$result = mysqli_query($link, $sql);
if (!$link) {
 echo 'Ошибка
#'.mysqli_connect_errno().': '.mysqli_connect_error();
} else {
 echo 'Готово
----------------
Очистка таблицы «weather_day»... ';
}
$sql = 'TRUNCATE `weather_day`';
$result = mysqli_query($link, $sql);
if (!$link) {
 echo 'Ошибка
#'.mysqli_connect_errno().': '.mysqli_connect_error();
} else {
 echo 'Готово
----------------
ГОТОВО!
База данных очищена. Все Ваши города и записи были безвозвратно удалены.
====== КОНЕЦ ======';
}
}
} else {
  echo 'Неизвестная команда.';
}

echo '</textarea>
  <p align="right"><a href="/"><span class="material-symbols-outlined">home</span> На главную</a></p>
 </body>
</html>';

?>
