 # Job Network

 **Job Network** is a Laravel-powered job board for posting, browsing, and applying to job listings.

 ## Features
 - User registration & login
 - Profile management (first & last name)
 - CRUD operations for jobs
 - **My Jobs**: dashboard for your own postings
 - Favorites: bookmark jobs for later
 - Cover-letter-only job applications
 - Sent & Received application lists
 - Responsive UI with Tailwind CSS and Alpine.js (dark mode)

 ## Tech Stack
 - PHP 8+, Laravel Framework
 - MySQL (or Postgres)
 - Tailwind CSS for styling
 - Alpine.js for interactive components

 ## Installation
 1. Clone repository
    ```bash
    git clone https://github.com/lisan-5/job-network.git
    cd job-network
    ```
 2. Install PHP dependencies
    ```bash
    composer install
    ```
 3. Copy and configure environment
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
 4. Set database credentials in `.env`
 5. Run migrations and seed sample data
    ```bash
    php artisan migrate --seed
    ```
 6. Install JS dependencies & build assets
    ```bash
    npm install
    npm run dev  # or npm run build for production
    ```
 7. Serve the application
    ```bash
    php artisan serve
    ```

 ## Usage
 - Register and log in
 - Post, edit, or delete your jobs via **My Jobs**
 - Browse jobs and save favorites
 - Apply to jobs with a custom cover letter

 ## Testing
 Run PHPUnit tests:
 ```bash
 php artisan test
 ```

 ## License
 MIT License. See [LICENSE](LICENSE) for details.
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
