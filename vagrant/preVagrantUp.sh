service=${PWD##*/};
echo "Servicio creado $service";
if ["$service" != "symfony-standard"]; then
    find vagrant -type f -exec sed -i "s/\#servicio\#/$service/g" {} \;
fi
exit 0;