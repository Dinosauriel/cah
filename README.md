# Installation (for Development):

1. Download the Project and navigate to the root folder in your terminal.
2. Download and install Docker using your preferred method.
3. Run the following commands _in order_.

    - `cp .env.example .env`
    - `docker-compose up --build composer` Wait for the install to finish.
    - `docker-compose up` This will start all the containers, including the local server. To terminate, hit CTRL+C.
    - `docker-compose exec app php artisan key:generate`

4. You can now run arbitrary commands in the app container thanks to the interface provided by docker:

    - `docker-compose exec app {{your command here}}`

5. Populate the database using `docker-compose exec app php artisan migrate:refresh --seed`.
6. (Optional:) Navigate your browser to: [http://127.0.0.1:8080]
7. (Optional:) Navigate your browser to: [http://127.0.0.1:8090] for database access. The credentials are stored in your `.env` file that you copied earlier.

# Commands

> :exclamation: Remember that you will need to __prefix__ these commands with `docker-compose exec app {{your command here}}` in order to run them inside Docker.

## Create a new player:

`php artisan player:create -u username -p password -ta`

| Option        |   Optional |                                                             Description |
| ------------- | ---------: | ----------------------------------------------------------------------: |
| `-u username` | _Required_ |                                              username of the new player |
| `-p password` | _Optional_ |                                              password of the new player |
| `-t`          | _Optional_ | create a temporary user (will automatically be deleted after some time) |
| `-a`          | _Optional_ |                         create an administrator user (can create games) |

## Start webpack bundling service:

`npm run watch`

> When editing _javascript_ or _sass_ files during development, __you will need__ to enable the npm watching service. This will detect when you edit a .js or .scss file in the assets directory and automatically bundle all the source files into one output file.

## Start the websocket server:

`php artisan websocket:start`

> The websocket server is required for playing!

## Import Cardsets from JSON:

`php artisan cards:update`

> Deletes all cards and cardsets from the database and re-imports them from `resources/cards/*.json`.
>
> If you would like to import your custom cardset you can do so by adding your own .json file and running this command. Use the following as reference for your json-file.

> :exclamation: the acronym property needs to be unique. it is a unique identifier that should represent the cardset name
>
> :exclamation: only enabled cardsets will be imported

```json
{
    "cardsets": [
        {
            "name": "Your Cardset Name",
            "acronym": "ycn",
            "enabled": true,
            "language": "en",
            "color": "424242", //optional, 6 digit hexcode for theme color
            "white": [
                {
                    "text": "RESPONSE A"
                },
                {
                    "text": "RESPONSE B"
                }
            ],
            "black": [
                {
                    "text": "Question {{}} A",
                    "number_to_draw": 1,
                    "number_to_play": 1
                },
            ]
        },
    ]
}
```
