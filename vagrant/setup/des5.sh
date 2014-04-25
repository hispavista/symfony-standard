apt-get -y install nfs-client
echo "Montando des-5 en /mnt/"
mount -t nfs 192.168.100.5:/home /mnt
echo "Añadiendo des-5 a fstab para su montaje automatico"
echo  "192.168.100.5:/home/ /mnt       nfs     rsize=32768,wsize=32768,hard,intr  0    0 " >> /etc/fstab
echo "Creando enlance simbólico en /home/nfs a /mnt/nfs_srv/nfs"
ln -s /mnt/nfs_srv/nfs /home/nfs
