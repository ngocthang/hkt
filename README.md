Framgia Hyakkaten - フランジア百貨店
=================

Framgia Hyakkaten is a web service made for Framgia's Members, created by HKT Team. 
It is powered by the [PhalconPHP framework](http://phalconphp.com). 

Requirements
-----------

* PHP 5.4 or higher (5.5 recommended)
* PhalconPHP 1.2.6 or higher
* Mysql 5.1 or higher (5.5 recommended)

Config
-----------

### Deploy
Deploy the website under the address localhost, or hkt.localhost instead of localhost/hkt.

### Cache folder
Change mode the folder `app/cache`
```bash
chmod 777 app/cache
```

### Database
```bash
CREATE USER 'hkt'@'localhost' IDENTIFIED BY 'hkt';
CREATE DATABASE hyakkaten CHARACTER SET utf8;
GRANT ALL ON hyakkaten.* to hkt@localhost;
FLUSH PRIVILEGES;
```
Change the username, password, and database name with the information configed in `app/config/config.php`
Then, run the sql files in `app/schemas` folder.

External Links
--------------

* [Framgia](http://framgia.com/)
* [Framgia Tech Blog](http://tech.blog.framgia.com/vn/)

