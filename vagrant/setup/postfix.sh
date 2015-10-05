debconf-set-selections <<< "postfix postfix/mailname string debian_wheezy.hispavistaroot.local"
debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"
export DEBIAN_FRONTEND=noninteractive
apt-get install -y  postfix
