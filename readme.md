~~~
1 - Clone repositorie.
2 - Execute "composer install".
3 - Generate tables with "php artisan migrate".
4 - Generate test data into table "users" with "php artisan db:seed --class=UserSeeder".
~~~

~~~
Postman test Import file PXSOL.postman_collection.json.
~~~

~~~
Setting virutal host:

<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /var/www/html/pxsol/public/
    <Directory /var/www/html/pxsol/public/>
    	AllowOverride All
    	Order allow,deny
    	Allow from All
    </Directory>
</VirtualHost>
~~~
