<?php
// Incluye el archivo del controlador de clientes
require_once 'controller/ClientesController.php';

// Incluye el archivo del controlador de juegos
require_once 'controller/JuegosController.php';

// Incluye el archivo del controlador de compras
require_once 'controller/ComprasController.php';

// Incluye el archivo de datos (posiblemente relacionado con la base de datos)
require_once 'db/datos.php';

// Asigna la información de clientes juegos y compras a una variable global
$GLOBALS['clientes'] = $datos['Clientes'];
$GLOBALS['juegos'] = $datos['Juegos'];
$GLOBALS['compras'] = $datos['Compras'];

// Verifica si se han proporcionado los parámetros 'controller' y 'function' en la URL
if (isset($_GET['controller']) && isset($_GET['function'])) {
    // Obtiene el valor de 'controller' de la URL y lo asigna a la variable $controller
    $controller = $_GET['controller'];

    // Agrega 'Controller' al final del valor de $controller
    $controller = $controller . 'Controller';

    // Capitaliza la primera letra del valor de $controller (convención de nomenclatura)
    $controller = ucfirst($controller);

    // Obtiene el valor de 'function' de la URL y lo asigna a la variable $function
    $function = $_GET['function'];

    // Verifica si la clase correspondiente al controlador existe
    if (class_exists($controller)) {
        // Verifica si la función especificada existe dentro del controlador
        if (method_exists($controller, $function)) {
            // Si se proporciona 'id' en la URL, llama a la función del controlador con 'id'
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                call_user_func($controller . '::' . $function, $id);
            } else {
                // Si no se proporciona 'id', llama a la función del controlador sin 'id'
                call_user_func($controller . '::' . $function);
            }
        } else {
            // Si la función especificada en el controlador no existe, muestra un mensaje de error y una página de error (404)
            include('view/error/404.php');
            echo 'ERROR: no existe la función que buscas en el controlador. Revisa tu proyecto';
        }
    } else {
        // Si el controlador especificado no existe, muestra un mensaje de error y una página de error (404)
        echo 'ERROR: No existe el controlador que buscas. Revisa tu proyecto';
        include('view/error/404.php');
    }
} else {
    // Si no se proporcionan 'controller' y 'function' en la URL, incluye una página de inicio (index.php)
    include('view/index.php');
}
?>
