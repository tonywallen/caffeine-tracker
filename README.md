# Caffeine Tracker Application Lumen backend API and React JS Frontend

## Running this project

- Copy caffeine-tracker-app .env.example to .env
- Run `docker-compose --env-file caffeine-tracker-app/.env up --build`
- Execute migrations
    - `docker exec -it caffeine-tracker-app sh`
    - `cd ../ && php artisan migrate`
- Visit `http://localhost:4200/` for the UI and `http://localhost:8181/` for the API