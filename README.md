Use the following steps to clone project from GitHUB

1.git clone https://github.com/antaraaghosh/Image-Managment-REST-API.git
2.git checkout master
3. git pull origin master
4. composer update
5. create .env file

My sample env file Connection details
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_laravel
DB_USERNAME=root
DB_PASSWORD=

7.php artisan migrate

it will create database(if not) with tables


8. php artisan server

  Server running on [http://127.0.0.1:8000].
9. on postman test the apis

(url from my end)
http://localhost:8000/api/login

insert demo email and password field in users table and login with credentials using above api

In Authrization ->Bearer Token -> <token> for authorization

http://localhost:8000/api/images - GET
http://localhost:8000/api/images - POST
http://localhost:8000/api/images/{id} - POST
http://localhost:8000/api/images/13

I have created a images folder inside public/storage to upload images.



