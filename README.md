

## Laravel finance app API with sail

---------------------
### Start and down project command
- start project       : ./vendor/bin/sail up -d
- start project       :  sail : sail up -d
- down project        :  ./vendor/bin/sail down
- down project        :  sail down
- re-create database  :  sail down -v
- database name       : financeDB
### Remove ./vendor/bin/sail
- alias sail="bash vendor/bin/sail" only run in terminal

### Run Seeder command
- sail artisan migrate:fresh --seed

### phpmyadmin address
- localhost:8081
- username : sail
- password : password

### phpmyadmin
-sail down -v
-sail build --no-cache
-sail up -d







