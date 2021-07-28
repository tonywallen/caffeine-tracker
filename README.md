# Caffeine Tracker Application Lumen backend API and React JS Frontend

## Running this project

- Copy caffeine-tracker-app `cd caffeine-tracker-app && cp .env.example .env`
- Execute composer install `cd caffeine-tracker-app && composer install`
- Build and run project `docker-compose --env-file caffeine-tracker-app/.env up --build`
- Execute migrations
    - `docker exec -it caffeine-tracker-app sh`
    - `cd ../ && php artisan migrate`
- Visit `http://localhost:4200/` for the UI and `http://localhost:8181/` for the API