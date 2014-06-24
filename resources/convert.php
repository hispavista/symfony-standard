<?php
require_once "Spyc.php";

$file = $argv[1];
if (!file_exists($file)) {
    die("No existe el fichero");
}

$info = (pathinfo($file));
$filename = $info['basename'];
$path = $info['dirname'] ;
$hvClassName = str_replace('.orm.yml', '', $filename);
if ($hvClassName == $filename) {
    die("Fichero invalido debe ser extension orm.yml");
}

echo $className = convertName($hvClassName);

if ($className==$hvClassName){
    echo "No existen diferencias entre el nombre de la clase existente y la generada ($hvClassName == $className)";
    exit;
}

$newFileName="$path/$className.orm.yml";
$data = Spyc::YAMLLoad($file);
$newData=array();
echo "$hvClassName => $className";
foreach ($data as $key => $class){
    $newKey=str_replace($hvClassName,$className,$key);
    $newData[$newKey]=$data[$key];
    foreach ($data[$key] as $fieldIndex=>$value){
        
        if ($fieldIndex=='fields' || $fieldIndex=='id'){
            $newEntry=array();
            foreach ($value as $fieldKey=> $fieldValue){
                $newFieldKey=  convertName($fieldKey,false);
                $newEntry[$newFieldKey]=$fieldValue;
            }
        }
        else{
            $newEntry=$value;
        }
         $newData[$newKey][$fieldIndex]=$newEntry;
    }
}

file_put_contents($newFileName, Spyc::YAMLDump($newData,4) );
echo "\nSe crea el fichero $newFileName ";

    
function convertName($hvName,$isEntity=true) {
    $newName = preg_replace('/^t[0-9]+/i', '', $hvName);
    if ($newName==$hvName) {
        die("\nEl nombre de fichero ($hvName) no tiene el formato de Hv (Txxx_NOMBRE_TABLA)");
    }
    if ($isEntity){
        return calcularSingular(camelCase($newName,$isEntity));
    }
    else{
        return camelCase($newName,$isEntity);
    }
}

function camelCase($str, $isEntity = false) {
    if ($isEntity) {
        $str[0] = strtoupper($str[0]);
    }
    else{
        $str[0] = strtolower($str[0]);
    }
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $str);
}

function calcularSingular($palabra, $idioma='CASTELLANO') {

    $terminaciones = array('CASTELLANO' => array('iones' => 'ion', 'dades' => 'dad',
            'ales' => 'al', 'eles' => 'el', 'iles' => 'il', 'oles' => 'ol', 'ules' => 'ul',
            'anes' => 'an', 'enes' => 'en', 'ines' => 'in', 'ones' => 'on', 'unes' => 'un',
            'ares' => 'ar', 'eres' => 'er', 'ires' => 'ir', 'ores' => 'or', 'ures' => 'ur',
            'ases' => 'a', 'eses' => 'e', 'ises' => 'i', 'oses' => 'o', 'uses' => 'u',
            'as' => 'a', 'es' => 'e', 'is' => 'i', 'os' => 'o', 'us' => 'u'
        ),
        'INGLES' => array('ses' => 's', 'zes' => 'z', 'xes' => 'x', 'ches' => 'ch', 'shes' => 'sh',
            'ays' => 'ay', 'eys' => 'ey', 'iys' => 'iy', 'oys' => 'oy', 'uys' => 'uy',
            'ies' => 'y',
            'ves' => 'f',
            's' => ' '
        )
    );

    // SE OPTIMIZA EL INICIO DEL SUFIJO PARA NO DAR CICLOS EN BALDE
    $ciclos = array('CASTELLANO' => array(5, 4, 2),
        'INGLES' => array(3, 1),
    );

    //trace ("En moduloFiltradoTextos: En CalcularSingular: El idioma a usar es: ".$idioma, 0);
    // PARA CADA TAMANNO DE TERMINACION
    while (list($nulo, $i) = each($ciclos[$idioma])) {
        //trace ("En moduloFiltradoTextos: En CalcularSingular: El sufijo es: ".substr($palabra, (-1*$i)), 0);
        $sufijo = isset($terminaciones[$idioma][substr($palabra, (-1 * $i))])?$terminaciones[$idioma][substr($palabra, (-1 * $i))]:'';
        // SI HAY SUFIJO SINGULAR PARA LA PALABRA
        if ($sufijo != '') {
            // SE LE APLICA EL SUFIJO
            $palabra = substr($palabra, 0, (-1 * $i)) . trim($sufijo);
            return ($palabra);
        }
    } // FIN DEL PARA CADA TAMANNO DE TERMINACION
    return ($palabra);
}

// Fin CalcularSingular