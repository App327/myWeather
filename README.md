# myWeather
Полезный и функциональный дневник погоды на каждый день.

# Установка
1. [Скачайте и установите веб-сервер, MySQL и PHP ](https://apache-windows.ru/%D0%BA%D0%B0%D0%BA-%D1%83%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%B8%D1%82%D1%8C-%D0%B2%D0%B5%D0%B1-%D1%81%D0%B5%D1%80%D0%B2%D0%B5%D1%80-apache-c-php-mysql-%D0%B8-phpmyadmin-%D0%BD%D0%B0-windows/) (инструкция для Windows). Главное — чтобы имя пользователя в MySQL было `root`, а пароль был пустым.
2. Скачайте последнюю версию «Дневника погоды» (ветка `master`).
3. Распакуйте скачанный ZIP-архив в `C:\Server\data\htdocs`.
4. В веб-браузере откройте [localhost/terminal.php](http://localhost/terminal.php). Это мини-терминал для выполнения некоторых операций с БД.
5. В поле «Команда» введите `--install` и нажмите «Enter» или кнопку со стрелкой вправо.
6. Если всё успешно завершено (результаты показываются в «textarea»), нажмите ссылку «На главную».

# Настройка
1. В «Параметрах» справа от поля выбора города нажмите «+».
2. В открывшемся окне введите название города, которое будет использоваться как ярлык.
3. Нажмите «✓» внизу окна.
4. Если всё будет успешно, Вы увидите сообщение об этом.
5. Через секунду Вы автоматически перенаправитесь на главную страницу. Если нет — нажмите на ссылку «Вернуться на главную».

# Использование
1. Откройте [Дневник погоды](http://localhost/) в своём веб-браузере.
2. Нажмите «Создать запись».
3. Введите и выберите нужные данные.
4. Нажмите «✓» внизу окна.
5. Как и при добавлении города, если всё будет успешно, Вы увидите соответствующее сообщение.
6. Через секунду Вы автоматически перенаправитесь на главную страницу. Если нет — нажмите на ссылку «Вернуться на главную».

# Советы
* Регулярно создавайте записи в своём Дневнике. Скоро добавиться новая функция — на основе Ваших записей система будет строить предполагаемый прогноз погоды.
* Если хотите полностью удалить все свои города и записи, откройте [терминал](http://localhost/terminal.php) и введите команду `--clear` и нажмите «Enter» или кнопку со стрелкой вправо. Таблицы в БД `myWeather` автоматически очистятся.
> [!WARNING]
> Все города и записи удалятся без возможности восстановления. Отменить удаление будет невозможно!

# Удаление
Если Вы, к сожалению, хотите удалить Дневник погоды, то вот инструкции:
* В браузере откройте [терминал](http://localhost/terminal.php).
* В поле «Команда» введите `--uninstall` и нажмите клавишу «Enter» или кнопку со стрелкой вправо.
* База данных `myWeather` полностью удалиться.
* Удалите файлы Дневника погоды из `C:\Server\data\htdocs`.
Готово! Удаление завершено.


_С уважением,

App327_
