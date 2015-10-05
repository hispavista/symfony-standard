apt-get  install -y php5 php5-cli php5-cgi php5-mysql php5-curl apache2 libapache2-mod-php5 screen

echo Instalando arranque del servicio
cp /vagrant/setup/apache-resources/50-vagrant-mount.rules /etc/udev/rules.d/
