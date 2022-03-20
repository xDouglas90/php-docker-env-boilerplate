
  <h1 align="center">PHP Dev Environment in Docker</h1>

  <p align="center">Boilerplate for PHP development environment by Docker.</p>

![Badge](https://img.shields.io/badge/Language-PHP-%23777BB4?style=for-the-badge&logo=php)
![Badge](https://img.shields.io/badge/Platform-Docker-%232496ED?style=for-the-badge&logo=docker)
![Badge](https://img.shields.io/badge/Server-Nginx-%23009639?style=for-the-badge&logo=nginx)
![Badge](https://img.shields.io/badge/SQL-MySQL-%234479A1?style=for-the-badge&logo=mysql)
![Badge](https://img.shields.io/badge/NoSQL-Redis-%23DC382D?style=for-the-badge&logo=redis)

Includes the services:
  - PHP 7.4-fpm
  - Nginx
  - MySQL 5.7
  - Redis 

File with updates information, in case you want to know: [click here](https://github.com/xDouglas90/php-docker-env-boilerplate/blob/main/atts.md)

_____
### Prerequisites
The only prerequisites for creating the local development environment are [Docker](https://docs.docker.com/get-docker/) and [docker-compose](https://docs.docker.com/compose/install/).

_____
### Init
Once you have Docker and docker-compose installed and configured, follow these steps:

1. Clone this repository:
```bash
git clone git@github.com:xDouglas90/php-docker-env-boilerplate.git
```

2. Navigate to the repo folder and copy `.env-example` file and rename to `.env`.
    
    2.1 Open `.env` file and add the following values to the _variables_:
      ```   
      APP_NAME=your-app-name
      
      DB_DATABASE=your-database-name
      DB_USERNAME=your-mysql-username or root
      DB_PASSWORD=your-mysql-user-password or root
      DB_LOCAL_PORT=3306 (set a custom port if you need)      
    
      NGINX_LOCAL_PORT=80 (set a custom port if you need)
      
      REDIS_PORT=6379 (set a custom port if you need)
      ```
4. Now, init the containers:
```bash
docker-compose up -d
```

5. Confirm that you uploaded everything correctly with `docker-compose ps`.
    In the column `State` all must contain the word `up`.

6. Run the following command in the terminal, in the project root folder, to _install all **Composer** packages_:
```bash
docker-compose exec app composer install
```
_____
### Use
Open the browser and add the following link [http://localhost/](http://localhost/). 

**CAUTION**: If you have added any **custom ports** in the `NGINX_PORT=xxxx` environment variable, **you must then open the link localhost:xxxx**.

If everything is ok, you will see the following content on the rendered page: **MySQL version:5.7.37**

_____
### Notes
- If you have any questions or problems, feel free to call me. My _contacts_ are in my profile [**README**](https://github.com/xDouglas90).

- In the not too distant future, I intend to _configure **Laravel**_ to also run in a _development environment_.

- In the future (_which I hope is not too far away_), I intend to _configure_ it to run in _test and production environments_.

- Last but not least, **feel free** to also `Fork` this project and _fix/add_ what you think is missing from it. It will be a _pleasure_ to _accept_ your `Pull Requests`.
