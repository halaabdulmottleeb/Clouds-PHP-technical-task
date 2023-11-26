# Cloud php Task Project


## Getting Started

### Prerequisites

- [Composer](https://getcomposer.org/download/)
- [PHP](https://www.php.net/downloads)

### Installation

1. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Open `.env` and update the database configuration:

    ```env
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

3. Install PHP dependencies with Composer:

    ```bash
    composer install
    ```

4. Generate an application key:

    ```bash
    php artisan key:generate
    ```

5. Run database migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

6. Compile frontend assets:

    ```bash
    npm install
    npm run dev
    ```

### Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

7. To access the admin section:

User: admin@admin.com
Password: password

