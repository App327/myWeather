<?php
header('HTTP/1.1 200 OK');
header('Content-Type: text/html');

$city = isset($_GET["city"])? $_GET["city"]: "1";
$month = isset($_GET["month"])? $_GET["month"]: getdate()["mon"];
$year = isset($_GET["year"])? $_GET["year"]: "2023";

echo '<!DOCTYPE html>
<html lang="ru" dir="ltr">
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Дневник погоды</title>
  <link rel="stylesheet" href="/static/css/gen.css" media="all">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
 </head>
 <body>
  <noscript><div class="notification warning"><img src="/static/img/ic/warning.png" alt=""> В этом браузере отключён JavaScript</div></noscript>
  <h1>Дневник погоды</h1>
  <form action="/" method="get">
   <fieldset>
    <legend>Параметры</legend>
    ';

$link = mysqli_connect('127.0.0.1', 'root', '', 'myWeather');

if ($link == false) {
 echo '<div class="notification error"><img src="/static/img/ic/error.png" alt=""> Ошибка подключения к MySQL<br><code>'.mysqli_connect_error().'</code></div>';
} else {
 echo '<label>Город: <select name="city">';
 mysqli_set_charset($link, 'utf8');
 $sql = 'SELECT `id`, `name` FROM `cities`';
 $result = mysqli_query($link, $sql);
 while ($row = mysqli_fetch_array($result)) {
  echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
 }
 echo '</select> <input type="button" onclick="addCity()" class="material-symbols-outlined btn" value="add"></label><br>
';

 echo '  <label>Месяц: <select name="month"><option value="1">Январь</option><option value="2">Февраль</option><option value="3">Март</option><option value="4">Апрель</option><option value="5">Май</option><option value="6">Июнь</option><option value="7">Июль</option><option value="8">Август</option><option value="9">Сентябрь</option><option value="10">Октябрь</option><option value="11">Ноябрь</option><option value="12">Декабрь</option></select></label><br>
  <label>Год: <select name="year"><option>2023</option></select></label><br>
  <input type="submit" style="float: right" class="material-symbols-outlined btn" value="check">
   </fieldset>
  </form>
  <button onclick="addRecord()">Добавить запись</button> <button onclick="showSymbols()" class="btn_alt">Условные обозначения</button>
';
 echo '  <div class="window" id="win-add-city" style="display: none">
   <button onclick="closeWindow(\'win-add-city\')" class="material-symbols-outlined win-close">close</button>
   <h2>Добавление города</h2>
   <form action="/create-city.php" method="get">
    <label>Название: <input type="text" style="width: 90%" name="nm" placeholder="Название города"></label>
    <input type="button" class="btn_alt win-action1 material-symbols-outlined" value="close" onclick="closeWindow(\'win-add-city\')">
    <button class="win-action2 material-symbols-outlined">check</button>
   </form>
  </div>
  <div class="window" id="win-add-record" style="display: none">
   <button onclick="closeWindow(\'win-add-record\')" class="material-symbols-outlined win-close">close</button>
   <h2>Добавление записи</h2>
   <form action="/create-record.php" method="get">
    <label>Когда: <select name="when"><option value="day">Днём</option><option value="night">Ночью</option></select></label><br>
    <label>Облачность: <select name="cloudiness"><option value="0">Ясно</option><option value="1">Малооблачно</option><option value="2">Облачно</option><option value="3">Пасмурно</option></select></label><br>
    <label>Явления: <select name="phenomena"><option value="none">[Нет]</option><option value="rain">Дождь</option><option value="thunderstorm">Гроза</option><option value="snow">Снег</option><option value="frost">Иней</option><option value="hail">Град</option><option value="fog">Туман</option><option value="dew">Роса</option><option value="blizzard">Метель</option></select><br>
    <label>Температура: <input type="number" name="temp" placeholder="Число"> °C</label><br>
    <label>Ветер: <select name="windd"><option value="n">⬇️ С</option><option value="s">⬆️ Ю</option><option value="e">➡️ В</option><option value="w">⬅️ З</option><option value="nw">↙️ СЗ</option><option value="sw">↖️ ЮЗ</option><option value="ne">↘️ СВ</option><option value="se">↗️ ЮВ</option></select>, <input type="number" placeholder="Скорость" name="winds"> м/с</label><br>
    <label>Давление: <input type="number" name="pressure" placeholder="Число"> мм рт. ст.</label><br>
    <input type="hidden" value="'.$city.'" name="city">
    <input type="button" class="btn_alt win-action1 material-symbols-outlined" value="close" onclick="closeWindow(\'win-add-record\')">
    <button class="win-action2 material-symbols-outlined">check</button>
   </form>
  </div>
  <div class="window" id="win-symbols" style="display: none">
   <button onclick="closeWindow(\'win-symbols\')" class="material-symbols-outlined win-close">close</button>
   <h2>Условные обозначения</h2>
   <div class="scroll">
    <h3>Облачность</h3>
    <ul>
     <li><img src="/static/img/w/c/0.svg" alt="Ясно"> — Ясно</li>
     <li><img src="/static/img/w/c/1.svg" alt="Малооблачно"> — Малооблачно</li>
     <li><img src="/static/img/w/c/2.svg" alt="Облачно"> — Облачно</li>
     <li><img src="/static/img/w/c/3.svg" alt="Пасмурно"> — Пасмурно</li>
    </ul>
    <h3>Погодные явления</h3>
    <ul>
     <li><img src="/static/img/w/p/-.svg" alt="Нет явлений"> — Нет явлений</li>
     <li><img src="/static/img/w/p/rain.svg" alt="Дождь"> — Дождь</li>
     <li><img src="/static/img/w/p/snow.svg" alt="Снег"> — Снег</li>
     <li><img src="/static/img/w/p/frost.svg" alt="Иней"> — Иней</li>
     <li><img src="/static/img/w/p/hail.svg" alt="Град"> — Град</li>
     <li><img src="/static/img/w/p/fog.svg" alt="Туман"> — Туман</li>
     <li><img src="/static/img/w/p/dew.svg" alt="Роса"> — Роса</li>
     <li><img src="/static/img/w/p/thunderstorm.svg" alt="Гроза"> — Гроза</li>
     <li><img src="/static/img/w/p/blizzard.svg" alt="Метель"> — Метель</li>
    </ul>
    <h3>Направление ветра</h3>
    <ul>
     <li><img src="/static/img/w/wd/s.svg" alt="Южный"> — Южный</li>
     <li><img src="/static/img/w/wd/sw.svg" alt="Юго-западный"> — Юго-западный</li>
     <li><img src="/static/img/w/wd/w.svg" alt="Западный"> — Западный</li>
     <li><img src="/static/img/w/wd/nw.svg" alt="Северо-западный"> — Северо-западный</li>
     <li><img src="/static/img/w/wd/n.svg" alt="Северный"> — Северный</li>
     <li><img src="/static/img/w/wd/ne.svg" alt="Северо-восточный"> — Северо-восточный</li>
     <li><img src="/static/img/w/wd/e.svg" alt="Восточный"> — Восточный</li>
     <li><img src="/static/img/w/wd/se.svg" alt="Юго-восточный"> — Юго-восточный</li>
    </ul>
    <h2>Сокращения</h2>
    <ul>
     <li><b>°C</b> — градусы Цельсия</li>
     <li><b>м/с</b> — метры в секунду</li>
     <li><b>мм рт. ст.</b> — миллиметры ртутного столба</li>
    </ul>
   </div>
   <button class="win-action1" style="width: 100%" onclick="closeWindow(\'win-symbols\')">Закрыть</button>
  </div>
  <table style="margin-top: 20px" align="left" bgcolor="#fff" border="3" bordercolor="dodgerblue" cellpadding="5px" cellspacing="0" cols="12" frame="border" rules="all" summary="Таблица — дневник погоды">
   <thead>
    <tr>
     <th>Дата и время</th>
     <th>Когда</th>
     <th>Облачность</th>
     <th>Явления</th>
     <th>Температура</th>
     <th>Ветер</th>
     <th>Давление</th>
    </tr>
   </thead>
   <tbody>
';

 $sql = "SELECT * FROM `weather_day` WHERE `city` = \"".$city."\" AND `month` = \"".$month."\" AND `year` = \"".$year."\";";
 $result = mysqli_query($link, $sql);
 if ($result == false) {
  echo '   </tbody>
  </table>
  <p>ОШИБКА: ';
  if (mysqli_errno($link) == '1064') {
   echo 'по Вашему запросу ничего не найдено. <a href="javascript:addRecord()">Создайте</a> новую запись в Дневнике по текущим данным о погоде.</p>
  <label>Если хотите, можете связаться по поводу ошибки по <a href="mailto:urinatatana57@gmail.com?subject=Сообщение%20об%20ошибке%20в%20«Дневнике%20погоды»&body=Здравствуйте!%0A%0AУ меня возникла проблема при работе с «Дневником погоды». Вот сведения об ошибке:%0A%0A[вставьте сюда сведения об ошибке]">эл. почте</a>. В письме предоставьте следующие данные:<br><textarea cols="50" rows="10" readonly="">
Тип ошибки: Ошибка MySQL
---
Код ошибки: '.mysqli_errno($link).'
---
Ответ MySQL: '.mysqli_error($link).'</textarea>';
  }
 } else {
  while ($row = mysqli_fetch_array($result)) {
   if ($row["phenomena"] == "none") {
    $row["phenomena"] = "-";
   }
   if ($row["when"] == "day") {
   $when = "днём";
   }
   if ($row["when"] == "night") {
    $when = "ночью";
   }
   echo '    <tr><td>'.$row["date"].', '.$row["time"].'</td><td>'.$when.'</td><td><img src="/static/img/w/c/'.$row["cloudiness"].'.svg" alt="Облачность" height="20px"></td><td><img src="/static/img/w/p/'.$row["phenomena"].'.svg" height="20px" alt="Погодное явления"></td><td>'.$row["temperature"].'°C</td><td><img src="/static/img/w/wd/'.$row["wind_direction"].'.svg" height="20px" alt="Направление ветра"> '.$row["wind_speed"].' м/с</td><td>'.$row["pressure"].' мм рт. ст.</tr>';
  }
 }
}


echo '
   </tbody>
  </table>
  <script>
   document.getElementsByName(\'city\')[0].value = "'.$city.'";
   document.getElementsByName(\'month\')[0].value = "'.$month.'";
   document.getElementsByName(\'year\')[0].value = "'.$year.'";
  </script>
  <script src="/static/js/gen.js"></script>
 </body>
</html>';
?>