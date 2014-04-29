service=${PWD##*/};
if [ "$service" != "symfony-standard" ]; then
    echo "Remplazando \#service\# por $service en la configuracion de vagrant";
    find vagrant -type f -exec sed -i "s/\#servicio\#/$service/g" {} \;
fi
exit 0;