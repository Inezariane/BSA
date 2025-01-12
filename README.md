This is a simple PHP project that resets a registered user's password. 

The database used is **Postgresql**, use the following query to create the database.
```bash
CREATE TABLE users (
    id SERIAL PRIMARY KEY, 
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255), 
    token_expiry TIMESTAMP 
);
```
---

## Getting Started 

**1. First check if you have php installed by running**
```bash   
   php -v
```
**2. Install PHPMailer to enable email sharing by running**
```bash
   composer require phpmailer/phpmailer      
```
in your working directory
**3. Activate the PHP server in your working directory by running**
```bash
   php -S localhost:8080
```
**4. navigate to a desired page for example**
```bash
   localhost:8080/signup.php
```
