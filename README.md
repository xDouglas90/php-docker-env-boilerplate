
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

2. Navigate to the cloned repository folder and:

    2.1 Create a folder called `.docker`, navigate to the `.docker` folder and create `nginx` folder
    
      2.1.1 In `nginx` folder, create a file called `Dockerfile` and add this content:
      ```
      FROM nginx:alpine

      RUN apk update && apk add bash

      RUN rm /etc/nginx/conf.d/default.conf
      COPY ./nginx.conf /etc/nginx/conf.d
      ```
      - The _1st line_ is to choose the _official **Nginx** image_, where we are getting the _latest version_ with _**Alpine**_ (since it is a lighter version);
      - On the _3rd line_ we are running the commands to _update_ and _install bash_, respectively, into **Alpine**;
      - On the _4th line_, we are running the command to _**delete**_ the _default settings_ file that **Nginx** creates every time we upload the container;
      - Finally, on the 5th line we are copying the configuration file that we will create in the next step, so the Nginx server can work normally.

      2.1.2 Still in the `/.docker/nginx` folder, create a file called `nginx.conf`, and add the following content:
      ```
      server {
          listen 80;
          index index.php index.html index.htm;
          root /var/www/public;

          location ~ \.php$ {
              try_files $uri = 404;
              fastcgi_split_path_info ^(.+\.php)(/.+)$;
              fastcgi_pass app:9000;
              fastcgi_index index.php;
              include fastcgi_params;
              fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
              fastcgi_param PATH_INFO $fastcgi_path_info;
          }

          location / {
              try_files $uri $uri/ /index.php?$query_string;
              gzip_static on;
          }
      } 

      ```
      - Where: on line 9, `app` is the application name, which will be set in the `docker-compose.yml` file;
      - And, `9000` is the **Nginx** port set and exposed in the main `Dockerfile`. _Both files are located in the root of this repository_.

3. Navigate to the root of repo folder and copy `.env-example` file and rename to `.env`.
    
    3.1 Open `.env` file and add the following values to the _variables_:
      ```   
      DB_DATABASE=your-database-name
      DB_USERNAME=your-mysql-username or root
      DB_PASSWORD=your-mysql-user-password or root
      DB_LOCAL_PORT=3306 (set a custom port if you need)
      
      NGINX_PORT=80 (set a custom port if you need)
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
- If you have any questions or problems, feel free to call me. My _contacts_ are in my [**README**](https://github.com/xDouglas90).

- In the not too distant future, I intend to _configure **Laravel**_ to also run in a _development environment_.

- In the future (_which I hope is not too far away_), I intend to _configure_ it to run in _test and production environments_.

- Last but not least, **feel free** to also `Fork` this project and _fix/add_ what you think is missing from it. It will be a _pleasure_ to _accept_ your `Pull Requests`.
