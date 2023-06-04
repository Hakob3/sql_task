Задание: Работа с SQL

Проект был развернут с помощью Docker и docker-compose
Используемые контейнеры:
    -  php (С композером)
    -  mysql

Если вы также используете Docker и docker-compose, то можете развернуть проект выполняя
следующие действия
1. В командной строке перейдите в директорию приложения - ``cd sql_task``
2. Собрать контейнеры докера с помощью команды - ``docker-compose build --no-cache``.
3. Если у вас есть возможность использовать ``make`` команды, то можете запустить контейнеры через команду - ``make up``, если нет то выполните команду ``docker-compose up -d``
4. Далее надо выполнить команду - ``make composer-install`` или 
    ``docker-compose exec php composer install``

5. Для запуска приложения выполните команду ``make script`` или ``docker-compose exec app php public/index.php``

Все готово!
