export DEBIAN_FRONTEND=noninteractive
sh /vagrant/setup/bash.sh
apt-get update
#sh /vagrant/setup/service-user.sh
sh /vagrant/setup/des5.sh
sh /vagrant/setup/postfix.sh
sh /vagrant/setup/apache.sh
sh /vagrant/setup/service.sh
