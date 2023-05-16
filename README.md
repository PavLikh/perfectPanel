## Getting started

#### Клонирование репозитория в директорию с проектами

```bash
$ cd ~/projects
$ git clone https://github.com/PavLikh/perfectPanel
```

####  .env файл

#### MySQL settings
DB_CONNECTION=mysql \
DB_HOST=mysql \
DB_PORT=3306 \
DB_DATABASE=perfpanel \
DB_USERNAME=sail \
DB_PASSWORD=password

#### Запуск контейнеров

Вместо стандартного запуска контейнеров через ```docker-compose up``` можно исполнять файл ```up.sh```

```bash
$ sudo ./up.sh
```

> Перед запуском нужно убедиться что выключены другие контейнеры и службы, слушающие порт 80