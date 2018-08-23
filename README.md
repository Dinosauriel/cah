# Installation (for Development):

1. Download the Project and navigate to the root folder in your terminal.
2. Download and install Docker using your preferred method.
3. Run the following commands _in order_.

    - `docker-compose up --build composer`
    - `docker-compose up`
    - `cp .env.example .env`
    - `docker-compose exec app php artisan key:generate`

4. You can now run arbitrary commands in the app container thanks to the inerface provided by docker:

    - `docker-compose exec app {{your command here}}`

4. Populate the database using `php artisan migrate:refresh --seed`.
5. (Optional:) Navigate in your browser to: [http://127.0.0.1:8000]

# Commands

## Create a new player:

`php artisan player:create -u username -p password -ta`

| Option        |   Optional |                                                             Description |
| ------------- | ---------: | ----------------------------------------------------------------------: |
| `-u username` | _Required_ |                                              username of the new player |
| `-p password` | _Optional_ |                                              password of the new player |
| `-t`          | _Optional_ | create a temporary user (will automatically be deleted after some time) |
| `-a`          | _Optional_ |                         create an administrator user (can create games) |
