#!/usr/bin/env bash

Update () {
    echo "-- Update packages --"
    sudo apt-get update -y
    sudo apt-get upgrade -y
}
Update

echo "-- Install tools and helpers --"
sudo apt-get install -y --force-yes python-software-properties software-properties-common vim htop curl git

echo "-- Install packages --"
sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
Update
sudo apt-get install -y --force-yes apache2
sudo apt-get install -y --force-yes php7.0-common php7.0-dev php7.0-json php7.0-opcache php7.0-cli libapache2-mod-php7.0 php7.0 php7.0-mysql php7.0-fpm php7.0-curl php7.0-gd php7.0-mcrypt php7.0-mbstring php7.0-bcmath php7.0-zip php7.0-xml

echo "-- Configure PHP &Apache --"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.0/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.0/apache2/php.ini
sudo a2enmod rewrite

echo "-- Creating virtual hosts --"
cat << EOF | sudo tee -a /etc/apache2/sites-available/default.conf
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    ServerName recipeapp.vm
    ServerAlias www.recipeapp.vm

    DocumentRoot /vagrant/public
    <Directory /vagrant/public>
        Options +Indexes
        DirectoryIndex index.php
        Require all granted
        AllowOverride All
    </Directory>
</VirtualHost>

EOF
sudo a2ensite default.conf

sudo rm /etc/apache2/sites-enabled/000-default.conf

echo "-- Restart Apache --"
sudo service apache2 restart

echo "-- Install Composer --"
curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

echo  "Installing composer dependencies"
cd /vagrant/
composer install
composer dump-autoload

sudo apt-get autoremove -y
