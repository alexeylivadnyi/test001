# Рекомендации по развёртке и запуску проекта

Предлагаемое решение [тестового задания](https://drive.google.com/drive/folders/181TZlWWmvUZh2CT4pBpoeaVmccuJT-qI?usp=sharing) (в дальнейшем - приложение) выполнено с использованием технологий `docker` и `docker-compose` - выбор их обусловлен возможностью настроить и контролировать среду выполнения - поэтому предполагается, что они установлены на машине для проверки. Также предполагается, что приложение будет запускаться на Unix-like OS. Если реальность расходится с данными предположениями, запуск приложения может осложниться.

## Описание приложения
#### Структура
Приложение представляет собой бекенд и фронтенд части, которые расположены в раздельных рабочих директориях - backend и panel соответсвенно. 
#### Зависимости
Бекенд часть выполнена с использованием фреймворка **Laravel**, базой данных выбрана **MySQL**. Фронтенд часть представляет собой **vue-cli** проект с использованием **ElementUI** в качестве библиотеки компонентов, **Vue-router** для обработки клиентской маршрутизации, библиотеки **axios** для выполнения сетевых запросов, css-препроцессор **SCSS** для некоторых стилей, **debounce** для отложенного выполнения серверных запросов.
#### Функциональные возможности
1. Приложение представляет собой, по сути, таблицу, с устанавливаемыми фильтрами, пагинацией и сортировкой по выборанному столбцу (но только одному).
2. Обеспечивается фильтрация / поиск данных согласно требований ТЗ.
3. В таблицу добавлен стандартный лоадер для отображения процесса сетевого взаимодействия.
4. Если произошла ошибка (4хх или 5хх), то пользователю покажется нотификация с уведомлением об ошибке.
3. По умолчанию БД заполняется 300 000 записей (что может занимать некоторое время при развёртывании проекта). Этого кол-ва достаточно для проверки быстродействия выполнения кода. При необходимости увеличить кол-во записей, необходимо указать желаемое кол-во в файле сидера `/backend/database/seeds/HouseSeeder.php`.
4. В приложении присутствуют тесты для бекенда. Чтобы запустить их, необходимо на развернутом проекте выполнить команду `docker-compose exec php-fpm bash php artisan test` из папки `/backend/docker`.

#### Особенности
Приложение запускается в браузере по адресу `http://hicaliber.test:8082`. Такой порт выбран умышленно, и веб-сервер настроен на обслуживание именно такого адреса фронтенд части приложения, чтобы при запуске веб-сервер не вызвал конфликтов с существующими службами OS.

При составлении решения был выбран определенный архитектурный подход, в рамках которого выполнялась реализация логики. Для непосредственного решения задачи он может быть воспринят как избыточный, однако выбор пал на него по причине наглядной демонстрации возможности расширения проекта и добавления нового функционала. Во фронтенд части был использован роутер и добавлены некоторые миксины для организации кода с целью демонстрации возможности дальнейшего масштабирования приложения. Во фронтенд части подключались только те компоненты, которые реально использовались. Это делалось с целью уменьшения объема результирующего бандла. С этой же целью использовался динамический импорт роута.

## Процесс развёртывания приложения
Решение представляет собой законченный проект, готовый к запуску вне окружения разработки. Перед развертываением приложения необходимо добавить в файл `/etc/hosts` следующие строки:
```
127.0.0.1       api.hicaliber.test
127.0.0.1       hicaliber.test
```

### Развёрывание приложения в "боевой" режим
1. Перейти в папку `/backend/docker`, где расположены файлы конфигурации докера и вспомогательные скрипты
2. Запустить скрипт `first.sh`, который выполнит сборку контейнеров, установку композер-пакетов, запуск миграций и сидеров, а также установку пакетов для фронтенд части приложения. Если в процессе одной из подзадач произойдёт сбой, то процесс придется производить вручную*.
3. Запустить скрипт `deploy.sh`, который выполнит продакшн-сборку фронтенд части и доставит ее в необходимую директория для последующего обслуживания веб-сервером.
4. Перейти в браузере по адресу `http://hicaliber.test:8082` и проверить работоспособность приложения.
5. Для завершения работы запустить скрипт `stop.sh`

### Развёрывание приложения в режим "разработки"

1. Перейти в папку `/backend/docker`
2. Запустить скрипт `build.sh` для сборки образов докера
2. Запустить скрипт `start.sh`
3. Выполнить команду `docker-compose exec php-fpm bash composer install`
4. Выполнить команду `docker-compose exec php-fpm bash php artisan migrate --seed`
5. Перейти в папку `/panel`
6. Выполнить команду `npm install && npm run serve`

### *Запуск в "ручном" режиме
1. Перейти в папку `/backend/docker`
2. Запустить скрипт `build.sh` для сборки образов докера
3. Выполнить команду `./run.sh up -d --build`
4. Выполнить команду `docker-compose exec php-fpm bash composer install`
5. Выполнить команду `docker-compose exec php-fpm bash php artisan migrate --seed`
6. Перейти в папку `/panel`
7. Выполнить команду `npm install && npm run serve`

## Известные проблемы
1. Странно работает слайдер - компонент для фильтрации по ценам. Функционально все работает правильно, т.е. в запросе уходят правильные данные, но поведение компонента "багует".
2. При сортировке столбца таблицы сначала срабатывает сортировка на клиенской стороне - встроенная сортировка компонента `el-table` - а затем отправляется запрос на сервер для получения отсортированных данных и после их доставки они отображаются в таблице. Для пользователя визуально это выглядит как повторная пересортировка.
3. По умолчанию компоненты локализованы по-русски, поэтому выводимые по умолчанию тексты на русском языке.
4. При выполнении продакшн-сборки фронта (`npm run build`) вылетает непонятная ошибка, поэтому в данном проекте решено использовать другую команду для билда, которая не вызывает проблем - `npx vue-cli-service build`
