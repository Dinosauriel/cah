# Installation (for Development):

1. Download the Project and navigate to the root folder in your terminal.
2. Install MySQL, PHP, Composer, Node and NPM using your preferred method.
3. Check the installations using
    - `php -v` _tested with 7.1.16_
    - `composer -v` _tested with 1.6.5_
    - `node -v` _tested with 10.8.0_
    - `npm -v` _tested with 6.2.0_
    - `mysql -V` _tested with 8.0.11_
4. Install laravel using `composer global require "laravel/installer"`. More on that [here](https://laravel.com/docs/installation).
5. Install all the necessary node modules using `npm install`.
6. Create a MySQL database and enter it's credentials in the `/.env` file. (`DB_CONNECTION` to `DB_PASSWORD`)
7. Populate the database using `php artisan migrate:refresh --seed`.
8. (Optional:) Run the development server using `php artisan serve` and navigate in your browser to: [http://127.0.0.1:8000]
9. (Optional:) Run the command `npm run watch` to automatically compile your js and scss files on save.

# Commands

## Create a new player:

`php artisan player:create -u username -p password -ta`

| Option        |   Optional |                                                             Description |
| ------------- | ---------: | ----------------------------------------------------------------------: |
| `-u username` | _Required_ |                                              username of the new player |
| `-p password` | _Optional_ |                                              password of the new player |
| `-t`          | _Optional_ | create a temporary user (will automatically be deleted after some time) |
| `-a`          | _Optional_ |                         create an administrator user (can create games) |
