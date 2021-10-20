# Birthday Currency

This [adonis](https://adonisjs.com/) app allows users to discover the exchange rate for Hong Kong Dollar on the day of their birthday. Built with [laravel](https://www.laravel.com) and [fixer](https://fixer.io/).

## Requires

- [Docker-compose](https://docs.docker.com/compose/install/)

## Installation

```bash
cp .env.example .env
docker-compose build
```

## Usage

Check your `.env` file to map ports to your containers.

```bash
docker-compose up -d
```

## Run Database Migrations

```bash
docker exec ${APP_CONTAINER_ID} node ace migration:run
```

## Run pgAdmin

```bash
sudo apt-get install -y exo-utils && \
    exo-open http://localhost:8000
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[BSD](https://opensource.org/licenses/BSD-3-Clause)