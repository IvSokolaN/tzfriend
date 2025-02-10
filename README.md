В проекте используется БД MySQL.

# Запуск

В проекте установлен [Laravel Sail](https://laravel.com/docs/11.x/sail).

Можно использовать его для запуска локального сервера (.env.example содержит настройки БД для sail):

```bash
    ./vendor/bin/sail up -d
```

ИЛИ без докера и sail:

```bash
  php artisan serve
```

# Установка

```bash
  composer install
```
Создайте новый файл .env или скопируйте .env.example в .env:

```bash
  cp .env.example .env
```

Если используете sail для запуска приложения, то все artisan команды должны выполняться через sail:

```bash
  ./vendor/bin/sail artisan key:generate
  ./vendor/bin/sail artisan migrate
```

## Заполнить данными БД

```bash
  ./vendor/bin/sail artisan db:seed
```  

Будет создан администратор с логином `admin@admin.rt` и паролем `123`.

Доступ к админ панели: http://localhost/admin
