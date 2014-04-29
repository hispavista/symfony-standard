apt-get  install -y php5-cli curl git php5-gd php5-memcache mysql-server

echo Crear carpeta www/logs  y cache
mkdir /home/#servicio#/app/cache
mkdir /home/#servicio#/www/logs
chmod 777 /home/#servicio#/app/cache
chmod 777 /home/#servicio#/www/logs



echo Linkar las configuraciones de apache del servicio
cd /etc/apache2/sites-enabled
cp /vagrant/setup/service-resources/site.conf /etc/apache2/sites-available/#servicio#
ln -s /etc/apache2/sites-available/#servicio# /etc/apache2/sites-enabled/001-#servicio#
rm /etc/apache2/sites-enabled/000-default

#Include "conf/sites-enabled/"
echo Activando módulos
a2enmod rewrite
a2enmod headers


#echo "Montando la carpeta datos"
#echo "Creando enlance simbólico en /home/globedia2014/datos a /mnt/globedia2014_srv/globedia2014/datos"
#if [ -d /home/globedia2014/datos/ ] 
#then
#        echo El directorio existe
#else
#        ln -s /mnt/globedia2014_srv/globedia2014/datos /home/globedia2014/datos
#fi


echo "Instalar composer"
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

echo "composer update"
cd /home/#servicio#
composer update --no-interaction
php app/console doctrine:database:create  
php app/console doctrine:schema:create 
php app/console fos:user:create admin admin@email.com admin --super-admin

/etc/init.d/apache2 restart

