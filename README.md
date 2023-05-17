## Getting started

#### Задача 1

```bash
SELECT user_id AS ID, CONCAT(first_name, " ", last_name) AS Name,
    author AS Author,
    Books FROM 
    (SELECT tb5.user_id AS user_id, tb5.author AS author,
        GROUP_CONCAT(name) AS Books FROM 
            (SELECT tb4.user_id, tb4.author, books.name 
            FROM 
            (SELECT tb3.user_id, author, COUNT(*) AS count 
            FROM(
                SELECT id AS tb2_user_id,tb2.user_id, book_id, get_date, return_date, 
                DATEDIFF(return_date, get_date) AS term  
                FROM            
                (SELECT * FROM             
                (SELECT user_id AS uid, COUNT(*) FROM user_books GROUP BY user_id HAVING COUNT(*)=2) AS tb1             
                JOIN user_books ON user_books.user_id=tb1.uid) AS tb2) AS tb3 
                JOIN books ON books.id=tb3.book_id 
                WHERE term<15 
                GROUP BY tb3.user_id, author) AS tb4 
                JOIN user_books ON tb4.user_id=user_books.user_id 
                JOIN books ON books.id=user_books.book_id 
                WHERE count = 2) AS tb5 GROUP BY user_id, author) AS tb6 
                JOIN (
                    SELECT id, first_name, last_name, birthday, DATE_SUB(CURDATE(),INTERVAL 17 YEAR) AS max_birthday,  
                    DATE_SUB(CURDATE(),INTERVAL 7 YEAR) AS min_birthday 
                    FROM `users`) AS users1 
                ON users1.id=tb6.user_id 
WHERE users1.birthday>max_birthday AND users1.birthday<min_birthday
```
#### Задача 1

#### Клонирование репозитория в директорию с проектами

```bash
$ cd ~/projects
$ git clone https://github.com/PavLikh/perfectPanel
```

Проверить .env файл

####  .env файл

#### MySQL settings
DB_CONNECTION=mysql \
DB_HOST=mysql \
DB_PORT=3306 \
DB_DATABASE={project_name} \
DB_USERNAME=sail \
DB_PASSWORD=password

#### Запуск контейнеров
Установить пакеты,
запустить контейнеры,
подготовить БД:
выполнить миграцию,
заполнить таблицы данными,

```bash
$ composer install
$ npm i
$ npm run build
$./vendor/bin/sail up
$ php artisan migrate
$ php artisan db:seed

```

> Перед запуском нужно убедиться что выключены другие контейнеры и службы, слушающие порт 80

Файл для тестирования API: testapi.yaml\