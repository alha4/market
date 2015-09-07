<?
spl_autoload_register(function($className) {

    $className = ltrim($className, '\\');
    $fileName  = $_SERVER['DOCUMENT_ROOT'].'/myaccount/';
    $namespace = '';
 
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName.= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    
    $fileName.= $className.'.php';

    //echo file_exists($fileName),$fileName, ' <br> ';

    if(file_exists($fileName)) {
        require_once $fileName;
    }
});

$map = array(
    'iblock' => 'CIBlock CIBlockElement CIBlockSection',
    'catalog' => 'CCatalogProduct',
);
// ѕреобразуем карту в удобный дл€ обработки вид
$preparedMap = array();
foreach($map as $module => $classes) {
    foreach(explode(' ', $classes) as $class) $preparedMap[$class] = $module;
}


spl_autoload_register(function($classname) use ($preparedMap) {
    // ќпредел€ем к какому модулю принадлежит класс
    if (isset($preparedMap[$classname]) && $preparedMap[$classname]) {
        
        $MODULE_PATH = $_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/';

        $MODULE_PATH.= $preparedMap[$classname];

        $MODULE_PATH.= '/'.$preparedMap[$classname].'.php';

        require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
  
        // ... и подключаем этот модуль
  
        require($MODULE_PATH);

        CModule::IncludeModule($preparedMap[$classname]);
        // изменили код
        //CModule::RequireAutoloadClass($classname);
    }
});
?>