CT27502

Sinh viên thực hiện:
Lê Minh Triết B1910470 & Nguyễn Thành Vinh B1910483

Cài đặt:
Composer install

Vhost:
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