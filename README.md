
## Introduction

This code exercise is a demo application for a single-page booking form

##

> [!NOTE]
>  ### For Windows OS
> - Requires Ubuntu 20.04.6 LTS (Microsoft Store)
> - Requires Docker Desktop
>   ```
>   https://www.docker.com/products/docker-desktop/
>   ```
> - Requires installation of wsl2 for windows
>   ```
>   https://www.c-sharpcorner.com/article/how-to-install-windows-subsystem-for-linux-wsl2-on-windows-11/
>   ```


### Set up a local page for docker
Open Notepad as Administrator and navigate to:
```
C:\Windows\System32\drivers\etc
```
Select All files and open hosts
Add under your localhost:
```
#localhost
127.0.0.1 hotel-booking.local
```

Save and close the host file.
##

### Start the docker container to host the server

Get into the directory: 
```
cd mybookingrewards/docker 
```

In the docker directory execute the command to start the docker container:
```
docker compose up -d
```

Once all images are up execute the command to get into the server
```
docker compose exec php bash
```
##
### Get into the Laravel application
```
cd hotel-booking/
```

Once you're in the application's directory: `/var/www/hotel-booking#`

run composer install: 
```
composer install
```
### Add an .env file to the project
Copy the example file and create a new .env file in the project
```
cp .env.example  .env
```

Once the .env file is added run migration and seed the database
```
php artisan migrate:fresh --seed
```

### Add permissions for local environment
```
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```
### Open your preferred browser
```
http://hotel-booking.local/
```
