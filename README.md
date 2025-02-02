# Clone the repository 

# Add hotel-booking.local

Open Notepad as Administrator and navigate to:
C:\Windows\System32\drivers\etc
Select All files and open hosts

Add under your localhost
#localhost
127.0.0.1 hotel-booking.local


# Start docker container to host the server

Get into the directory: 
cd mybookingrewards/docker 

run:
docker compose up -d
docker compose exec php bash
cd hotel-booking/

Once you're in the director:
/var/www/hotel-booking#

run: composer install

# Create .env file
copy the example file and create new .env file in the project
cp .env.example  .env

# run permissions
chmod -R 777 storage
chmod -R 777 bootstrap/cache
