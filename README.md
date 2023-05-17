
# Cilsy.ID Clone
Cilsy ID is a web-based application to learn Linux, networking, DevOps, etc. This repository contains source code of Cilsy ID, that deployed to vuln.cilsy.ID



## Requirements

The specification of this lab is shown below.

- Ubuntu Server 18.04 LTS
- 2 Core CPU
- 4 GBs RAM
## Deployment

### Update Ubuntu VPS

Update & upgrade using command below.

```bash
sudo apt update  -y && sudo apt upgrade -y
```

If using IDCloudHost server, sometimes you'll meet these errors when updating the server :

```bash
sudo apt update  -y && sudo apt upgrade -y
Hit:1 http://archive.ubuntu.com/ubuntu bionic InRelease                    
Hit:2 http://archive.ubuntu.com/ubuntu bionic-updates InRelease                
Hit:3 http://archive.ubuntu.com/ubuntu bionic-backports InRelease        
Hit:4 http://security.ubuntu.com/ubuntu bionic-security InRelease
Reading package lists... Done                      
Building dependency tree       
Reading state information... Done
168 packages can be upgraded. Run 'apt list --upgradable' to see them.
E: Could not get lock /var/lib/dpkg/lock-frontend - open (11: Resource temporarily unavailable)
E: Unable to acquire the dpkg frontend lock (/var/lib/dpkg/lock-frontend), is another process using it?
```

Solution:

- Run this commands one by one

```bash
sudo lsof /var/lib/dpkg/lock
sudo lsof /var/lib/apt/lists/lock
sudo lsof /var/cache/apt/archives/lock
```

- It’s possible that the commands don’t return anything, or return just one number. If they do return at least one number, use the number(s) and kill the processes like this (replace the <process_id> with the numbers you got from the above commands):

```bash
sudo kill -9 <process_id>
```

- You can now safely remove the lock files using the commands below:

```bash
sudo rm /var/lib/apt/lists/lock
sudo rm /var/cache/apt/archives/lock
sudo rm /var/lib/dpkg/lock
```

- After that, reconfigure the packages:

```bash
sudo dpkg --configure -a
```

Reboot if necessary

```bash
sudo reboot
```

### Install Nginx

At this point, you need to install NGINX 1.14 on our system. This option is available by default in the Ubuntu repository. You should install it using the following command:

```bash
sudo apt install nginx -y
```

After the installation process, start the NGINX service and set it to run automatically on system boot. Get help with following command:

```bash
sudo systemctl start nginx
sudo systemctl enable nginx
```

As you know, NGINX works on port 80. Check the status quo using the following command:

```bash
netstat -plntu
curl -I localhost
```

### Install PHP 7.1

PHP 7.1 is not provided by the official repository so you have to add “PPA” repo in order to install it easily.

First, install Python Software Package with the following command:

```bash
sudo apt-get install python-software-properties
```

Now you can add the preferred repository:

```bash
sudo add-apt-repository ppa:ondrej/php
```

Update your repository list to fetch the latest packages with the command below:

```bash
sudo apt-get update
```

execute the command below to easily install PHP 7.1 and the needed extensions:

```bash
sudo apt install php7.1 php7.1-xml php7.1-mbstring php7.1-mysql php7.1-json php7.1-curl php7.1-cli php7.1-common php7.1-mcrypt php7.1-gd libapache2-mod-php7.1 php7.1-zip
```

In Ubuntu by default, PHP-FPM runs under sock file supervision. Check this file using the following command:

```bash
netstat -pl | grep php7.1-fpm
```

### Install MariaDB Database

You can install the database from the repository using the following command:

```bash
sudo apt install mariadb-server mariadb-client -y
```

After the installation process is complete, run MariaDB and get it ready for boot on the system.

```bash
sudo systemctl start mysql && sudo systemctl enable mysql
```

This database works on port 3306. Check it out with the following command:

```bash
netstat -plntu
```

Now specify the database password using the following command:

```bash
sudo mysql_secure_installation
```

Enter the root password, delete the anonymous user, and remove the remote root login:

```bash
Set root password? [Y/n] Y

Remove anonymous users? [Y/n] Y

Disallow root login remotely? [Y/n] Y

Remove test database and access to it? [Y/n] Y

Reload privilege tables now? [Y/n] Y
```

Database installation and configuration is also done.

### Create Database for VULN Server

```bash
sudo mysql -u root -p
Enter password: 
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 9
Server version: 8.0.31-0ubuntu0.20.04.2 (Ubuntu)

Copyright (c) 2000, 2022, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> create user 'vulncilsyuser'@'localhost' identified by 'c0c0d0tB4u';
Query OK, 0 rows affected (0.02 sec)

mysql> create database vulndatabasehacker character set utf8mb4;
Query OK, 1 row affected (0.01 sec)

mysql> grant all on vulndatabasehacker.* to 'vulncilsyuser'@'localhost';
Query OK, 0 rows affected (0.01 sec)

mysql> exit;
Bye
```

### Install PHP Composer

Composer is a package manager for PHP programming language. This option was created in the Year 2011. On the Ubuntu 18.04 VPS, the composer is available in the repository and you can install it with the apt command.

```bash
sudo apt install composer -y
```

After the installation process is complete, run the following command to see the result.

```bash
composer
```

### Clone Repository

Clone the repo from github

```bash
cd /var/www/html/
git clone https://github.com/nendon/hacker.git
```

### Rename Directory Name

```bash
sudo mv hacker/ vuln/
```

### Move to Repository Directory

```bash
cd vuln
```

### Install dependencies

```bash
composer install --ignore-platform-reqs
```

### Create .env file

```bash
cp .env.example .env
```

```bash
APP_ENV=local
APP_KEY=base64:SdBOznhSE6R6AT7ComorkOgS0FLoPffu5K3wIgCcLpw=
APP_DEBUG=false
APP_LOG_LEVEL=debug
APP_URL=vps1.cilsy.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3036
DB_DATABASE=vulndatabasehacker
DB_USERNAME=vulncilsyuser
DB_PASSWORD=c0c0d0tb4u

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=noreplycilsy@gmail.com
MAIL_PASSWORD=41Q66TRRr1QON7KKUkOW
MAIL_ENCRYPTION=tls

VT_SECRET_PRODUCTION=VT-server-_cXc9tYjPxt4JEX7B7qDSQP_
VT_CLIENT_PRODUCTION=VT-client-k5fqb2fcVyb_sH5J

VT_SECRET_LOCAL=VT-server-4O7hlRyievnwHHB5b0J-z-xf
VT_CLIENT_LOCAL=VT-client-A8TyaVnM8gpmQACA

PUSHER_APP_ID=
PUSHER_KEY=
PUSHER_SECRET=
```

### Generate APP_KEY

```bash
php artisan key:generate
Application key [base64:UPcKQ3i4arfBe5...] set successfully.
```

### Update permission for storage directory

```bash
sudo chown www-data: -R storage
```

### Configure Virtual Host

```bash
sudo nano /etc/nginx/sites-available/vuln.cilsy.id
```

```bash
server {
        root /var/www/html/vuln/public;
        index index.php index.html;
        server_name vuln.cilsy.id;
        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php7.2-fpm.sock;
        }
        location ~ /\.ht {
                deny all;
        }

    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/vuln.cilsy.id/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/vuln.cilsy.id/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

}
server {
    if ($host = vuln.cilsy.id) {
        return 301 https://$host$request_uri;
    } # managed by Certbot

        server_name vuln.cilsy.id;
    listen 80;
    return 404; # managed by Certbot

}
```

### Make Symbolic Link

```bash
sudo ln -s /etc/nginx/sites-available/vuln.cilsy.id /etc/nginx/sites-enabled/
```

### Setup Databases

Create new database

```bash
sudo mysql -u root -p
Enter password: 
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 31
Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1 Ubuntu 18.04

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> CREATE DATABASE vulndatabasehacker;
Query OK, 1 row affected (0.00 sec)

MariaDB [(none)]> GRANT ALL PRIVILEGES ON vulndatabasehacker.* TO 'vulncilsyuser'@'localhost' IDENTIFIED BY 'c0c0d0tb4u';
Query OK, 0 rows affected (0.00 sec)

MariaDB [(none)]> FLUSH PRIVILEGES;
Query OK, 0 rows affected (0.00 sec)

MariaDB [(none)]> EXIT
Bye
```

Import database from repository

```bash
cd /var/www/html/vuln
mysql -u vulncilsyuser vulndatabasehacker < dev_cilsy.sql -p
```

### Install PHPMyAdmin

```bash
sudo apt-get install phpmyadmin -y
```

