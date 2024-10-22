
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
        sudo apt update && sudo apt upgrade

        sudo apt install imagemagick
        ```
    2. Install PHP 8.1 and its dependancies
        ```bash
        sudo apt update && sudo apt upgrade

        sudo apt install software-properties-common apt-transport-https -y

        sudo add-apt-repository ppa:ondrej/php -y

        sudo apt install php8.1-fpm php8.1-common php8.1-mysql php8.1-xml php8.1-xmlrpc php8.1-curl php8.1-gd php8.1-imagick php8.1-cli php8.1-dev php8.1-imap php8.1-mbstring php8.1-opcache php8.1-soap php8.1-zip php8.1-intl php8.1-bcmath
        ```
    3. Install Composer (use vpn if download failed)
        ```bash
        sudo apt install unzip

        cd ~

        curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php

        HASH=`curl -sS https://composer.github.io/installer.sig`

        php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

        sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

        composer
        ```
    4. Install MySQL
        ```bash
        sudo apt install mysql-server

        sudo mysql
        ```
        ```sql
        create user 'your_username'@'localhost' identified by 'your_password';

        grant all privileges on *.* to 'your_username'@'localhost';

        create database `your_database_name`;

        exit;
        ```
    5. Install And Setup Apache 2
        ```bash
        sudo apt install apache2
        cd /etc/apache2/sites-available
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
        sudo apt install git
        ```
    7. SSH for Github
        SSH key generate (If already has one, skip)
        ```bash
        ssh-keygen
        ```

        SSH import to Github (use the existing ssh key if already generated)
        ```bash
        ssh-add ~/.ssh/id_rsa

        cat ~/.ssh/id_rsa.pub
        ```
        Copy the contents and paste to github ssh keys here
        <br><a href="https://github.com/settings/ssh/new">https://github.com/settings/ssh/new</a>

- Project Installation And Setup
    1. Clone project from github
        ```bash
        cd /var/www/html

        sudo chmod -R 777 ./

        git clone git@github.com:KaungHtunThant/SilverSea_Event_Registration_System.git

        cd SilverSea_Event_Registration_System

        composer install

        cp .env.example .env

        nano .env
        ```
        Add mysql username, password and database name in the file.

        Save (Ctrl+S) and close the editor (Ctrl+X)
        ```bash
        php artisan migrate --seed
        ```
    2. Enable site in Apache
        ```bash
        sudo a2dissite 000-default.conf

        sudo a2ensite event_pass.conf

        sudo a2enmod rewrite

        sudo systemctl restart apache2
        ```

- Default username and password
    >username: admin@email.com<br>password: admin123!
