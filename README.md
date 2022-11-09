1. composer update (Подтягиваем зависимости).
2. cp .env.example .env (Копируем файл с env).
3. docker-compose up -d (Поднимаем docker контейнеры).
4. Настройка подключения дб .env
      DB_CONNECTION=mysql <br>
      DB_HOST=db <br>
      DB_PORT=3306 <br>
      DB_DATABASE=laravel <br>
      DB_USERNAME=root <br>
      DB_PASSWORD=root
5. docker-compose exec --user=1000 app bash (Заходим внутрь контейнера php).
6. php artisan key:generate (Гинерируем ключ).
7. php artisan storage:link (Гинерируем линк storage).
8. php artisan migrate (Заполним дб таблицами).
9. Route (
   http://localhost:81/api/documentation
   ). OpenApi 
