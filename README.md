This is a simple PHP project that resets a registered user's password. 

The database used is Postgresql, use the following query to create the database.

CREATE TABLE users (
    id SERIAL PRIMARY KEY, 
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255), 
    token_expiry TIMESTAMP 
);

To run the application, you will have to :

1. First check if you have php installed by running 
   php -v
   
2. Install PHPMailer to enable email sharing by running
   composer require phpmailer/phpmailer      in your working directory
   
3. Activate the PHP server in your working directory by running
   php -S localhost:8080
   
4. navigate to a desired page for example:
   localhost:8080/signup.php
