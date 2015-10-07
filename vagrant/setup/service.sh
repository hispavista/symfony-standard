apt-get  install -y php5-cli curl git php5-gd php5-memcache mysql-server

echo Crear carpeta www/logs  y cache
mkdir /home/#servicio#/app/cache
mkdir -p /home/#servicio#/www/logs
chmod 777 /home/#servicio#/app/cache
chmod 777 /home/#servicio#/www/logs



echo Linkar las configuraciones de apache del servicio
cd /etc/apache2/sites-enabled
cp /vagrant/setup/service-resources/site.conf /etc/apache2/sites-available/#servicio#
cp /vagrant/setup/service-resources/dir.conf /etc/apache2/mods-available/dir.conf
ln -s /etc/apache2/sites-available/#servicio# /etc/apache2/sites-enabled/001-#servicio#.conf
rm /etc/apache2/sites-enabled/000-default.conf

#Include "conf/sites-enabled/"
echo "Activando módulos"
a2enmod rewrite
a2enmod headers

echo "Creamos la bbdd"
mysql -u root -e  "create database prueba"

echo "Instalar composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

echo "composer install"
cd /home/#servicio#
composer install --no-interaction
php app/console doctrine:schema:create 
php app/console fos:user:create admin admin@email.com admin --super-admin

/etc/init.d/apache2 restart

