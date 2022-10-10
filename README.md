CT27502

## Sinh viên thực hiện:
* Lê Minh Triết B1910470
* Nguyễn Thành Vinh B1910483

## Cài đặt:
#### Composer
```bash
$ composer install
```

#### Vhost:
```
<VirtualHost *:80>
    DocumentRoot " .. /vnmart/public"
    ServerName localhost
    # Set access permission
    <Directory " .. /vnmart/public">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Database (mysql)
> Import file /vn_mart 10-10 v1.2.sql

###### Với thiết lập mặc định:
```bash
DB_HOST="localhost"
DB_NAME="vn_mart"
DB_USER="root"
DB_PORT="3306"
DB_PASS=""
```
