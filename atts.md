# Repository Updates

- ### 03/20/2022

	- Fix `APP_URL` default in `.env-example` file to: **http://localhost:80**;
	- Created `NGINX_LOCAL_PORT` environment variable in `.env-example` file and add:
	```yml
	nginx:
			build: ./docker/nginx
			container_name: ${APP_NAME}-nginx
			restart: unless-stopped
			ports:
				- ${NGINX_LOCAL_PORT}:80
	```
	- Set `APP_NAME`  environment variable in all `container_name` in `.yml` file
	- Set `REDIS_PORT` environment variable in `.yml` file;
	- Removed process of creating `.docker` folder and `nginx` folder inside it, as well as creating `Dockerfile` and `nginx.conf` files for **Nginx service**, making these folders permanent in the repository and correctly configuring the `.yml` file;
	- Created:
		```yml
		...
			db:
				volumes:
					- mysqldata:/var/lib/mysql
		...
		volumes:
    			mysqldata: {}
		```
		- This creates a special type of volume which isn’t mapped to the local filesystem. This will be where the data for MySQL is stored — all your tables, records etc. The reason to don't use a folder in the local file system is that when the application is uploaded to a real web server, don’t  overwrite the real database with your test one. All your test/development environment records will be stored in here. This allows you to have a different database on the live server and development server when you come to uploading your app.

- ### 03/26/2022

	- Changed the name of the folder with code files from `public` to `src`, as a matter of project architecture best practice, according to [PSR-4](https://www.php-fig.org/psr/psr-4/).

### End
