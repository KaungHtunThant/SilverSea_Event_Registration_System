
# Event Pass System

## Project Installation

### Tested System Requirements
1. PHP 8.1
2. Composer
3. Apache 2
4. MySQL
5. Ubuntu 20.04
6. Git

### Steps For Installation
- Environment Setup (If already setup, skip)
    1. Install Imagick Extention
        ```bash
        username@localhost:~$ sudo apt update && sudo apt upgrade

        username@localhost:~$ sudo apt install imagemagick
        ```
    2. Install PHP 8.1 and its dependancies
        ```bash
        username@localhost:~$ sudo apt update && sudo apt upgrade

        username@localhost:~$ sudo apt install software-properties-common apt-transport-https -y

        username@localhost:~$ sudo add-apt-repository ppa:ondrej/php -y

        username@localhost:~$ sudo apt install php8.1-fpm php8.1-common php8.1-mysql php8.1-xml php8.1-xmlrpc php8.1-curl php8.1-gd php8.1-imagick php8.1-cli php8.1-dev php8.1-imap php8.1-mbstring php8.1-opcache php8.1-soap php8.1-zip php8.1-intl php8.1-bcmath
        ```
    3. Install Composer (use vpn if download failed)
        ```bash
        username@localhost:~$ sudo apt install unzip

        username@localhost:~$ cd ~

        username@localhost:~$ curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

        username@localhost:~$ HASH=`curl -sS https://composer.github.io/installer.sig`

        username@localhost:~$ php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

        username@localhost:~$ sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

        username@localhost:~$ composer
        ```
    4. Install MySQL
        ```bash
        username@localhost:~$ sudo apt install mysql-server

        username@localhost:~$ sudo mysql

        mysql> create user 'your_username'@'localhost' identified by 'your_password';

        mysql> grant all privileges on *.* to 'your_username'@'localhost';

        mysql> create database `your_database_name`;

        mysql> exit;
        ```
    5. Install And Setup Apache 2
        ```bash
        username@localhost:~$ sudo apt install apache2
        username@localhost:~$ cd /etc/apache2/sites-available
        username@localhost:/etc/apache2/sites-available$ sudo nano event_pass.conf
        ```
        Paste the following configuration
        ```
        <VirtualHost *:80>
                ServerAdmin webmaster@localhost
                DocumentRoot /var/www/html/SilverSea_Event_Registration_System/public

                <Directory "/var/www/html/SilverSea_Event_Registration_System/public">
                    Options Indexes FollowSymLinks MultiViews
                    AllowOverride All
                    Require all granted
                    Order allow,deny
                    Allow from all
                </Directory>

                ErrorLog ${APACHE_LOG_DIR}/error.log
                CustomLog ${APACHE_LOG_DIR}/access.log combined
        </VirtualHost>
        ```
        Save (Ctrl+S) and close the editor (Ctrl+X)
    6. Install Git
        ```bash
        username@localhost:~$ sudo apt install git
        ```
    7. SSH for Github
        SSH key generate (If already has one, skip)
        ```bash
        username@localhost:~$ ssh-keygen
        ```

        SSH import to Github (use the existing ssh key if already generated)
        ```bash
        username@localhost:~$ ssh-add ~/.ssh/id_rsa

        username@localhost:~$ cat ~/.ssh/id_rsa.pub
        ```
        Copy the contents and paste to github ssh keys here
        <br><a href="https://github.com/settings/ssh/new">https://github.com/settings/ssh/new</a>

- Project Installation And Setup
    1. Clone project from github
        ```bash
        username@localhost:~$ cd /var/www/html

        username@localhost:/var/www/html$ sudo chmod -R 777 ./

        username@localhost:/var/www/html$ git clone git@github.com:KaungHtunThant/SilverSea_Event_Registration_System.git

        username@localhost:/var/www/html$ cd SilverSea_Event_Registration_System

        username@localhost:/var/www/html/SilverSea_Event_Registration_System$ composer install

        username@localhost:/var/www/html/SilverSea_Event_Registration_System$ cp .env.example .env

        username@localhost:/var/www/html/SilverSea_Event_Registration_System$ nano .env
        ```
        Add mysql username, password and database name in the file.

        Save (Ctrl+S) and close the editor (Ctrl+X)
        ```bash
        username@localhost:/var/www/html/SilverSea_Event_Registration_System$ php artisan migrate --seed
        ```
    2. Enable site in Apache
        ```bash
        username@localhost:~$ sudo a2dissite 000-default.conf

        username@localhost:~$ sudo a2ensite event_pass.conf

        username@localhost:~$ sudo a2enmod rewrite

        username@localhost:~$ sudo systemctl restart apache2
        ```

- Default username and password
    >username: admin@email.com
    <br>
    >password: admin123!