<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Класс для работы с API https://jsonplaceholder.typicode.com

## В этом классе реализованны методы :
- Метод для получения пользователей.
- Метод получения постов пользователя по ID.
- Метод получения заданий пользователя по ID.
- Метод получения инфорации пользователя по ID с его постами и заданиями.
- Метод для добавления поста.
- Метод для удаления поста.
- Метод для редактирования поста.

### !!!!!!

<h2>API:</h2>
<ul>

- GET/users - Получение списка юзеров.
- GET/users/{userId} - Получение инфорации пользователя по ID с его постами и заданиями.
- GET/users/{userId}/posts - Получение постов пользователя по ID.
- GET/users/{userId}/todos - Получение заданий пользователя по ID
- POST/posts - Создание поста.
- PUT/posts/{postId} - Редактирование поста.
- DELETE/posts/{postId} - Удаление поста.

</ul>

<h2>Чтобы запустить проект, выполните:</h2>

1. Установите зависимости:

```composer install```

2. Создайте контейнеры:

```docker compose build```

3. Запустите их:

```docker compose up -d```

4. Проверьте созданные docker-контейнеры:

```docker ps```
