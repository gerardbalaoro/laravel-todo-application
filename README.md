# Laravel Todo Application

A demo application for managing tasks built with the Laravel Framework.

## Installation

1. Configure environment variables.
    ```bash
    cp .env.example .env
    ```

2. Install project dependencies.
    ```bash
    composer install
    ```

3. Generate application key and run database migrations.
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

4. Serve the application.
    ```bash
    php artisan serve
    ```
