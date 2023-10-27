<?php
require_once 'Controller.php';

require_once 'db/datos.php';

class JuegosController implements Controller
{


    public static function index(){
        $juegos = $GLOBALS['juegos'];
        if(isset($_GET['orden'])){
            if($_GET['orden'] == 'desc'){
                foreach ($juegos as $categoria => $value) {
                    foreach ($value as $key => $value2) {
                        $precio= $value2['precio'];
                        var_dump($precio);

                    }
                }
                var_dump($precio);
               }else{
               
        }
        }
        include 'view/Juegos/index.php';
    
    }

    public static function create()
    {
        include 'view/Juegos/create.php';
    }


    /**
     * @description el dia 20/10 hemos probado en clase que inserta y luego hemos colocado el header como redireccion al index
     * para solucionar el problema de la url que se quedaba en save y avanzaba a index 
     */
    public static function save()
    {

        if (isset($_POST)) {
            $juego = array(
                'id' => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'stock' => $_POST['stock'],
                'precio' => $_POST['precio'],
                'tipo' => $_POST['tipo']
            );

            if (array_key_exists($juego['tipo'], $GLOBALS['juegos'])) {
                array_push($GLOBALS['juegos'][$juego['tipo']], $juego);
            } else {
                echo 'No se puede almacenar este juego, ya que esa categoría no existe';
            }
        }

        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra?controller=Juegos&function=index");
        exit;
    }

    public static function edit($id)
    {
        $juegos = $GLOBALS['juegos'];
        foreach ($juegos as $id => $value) {
            foreach ($value as $key => $value2) {
                if ($id == $key) {
                    # pinto
                    $juegos = $value2;
                }
            }
        }
        include 'view/Juegos/edit.php';
    }




    public static function destroy($id)
    {
        $categoria = $_GET['categoria'];


        if (array_key_exists($id, $GLOBALS['juegos'][$categoria])) {
            unset($GLOBALS['juegos'][$categoria][$id]);
        } else {
            #Respuesta si no existe
            $GLOBALS['error'] = "No se encuentra el Juego";
        }

        JuegosController::index();
    }

    public static function update($id)
    {
        // Obtén la categoría y el ID desde la URL
        $categoria = $_GET['categoria'];
        $id = $_GET['id'];

        // Verifica si la categoría existe en los juegos
        if (isset($GLOBALS['juegos'][$categoria])) {
            foreach ($GLOBALS['juegos'][$categoria] as $key => $juego) {
                if ($juego['id'] == $id) {
                    // Obtiene los valores enviados por POST
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $stock = $_POST['stock'];
                    $precio = $_POST['precio'];
                    $tipo = $_POST['tipo'];

                    // Crea un nuevo juego con los valores actualizados
                    $juegoActualizado = array(
                        'id' => $id,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'stock' => $stock,
                        'precio' => $precio,
                        'tipo' => $tipo
                    );

                    // Reemplaza el juego existente con el juego actualizado
                    $GLOBALS['juegos'][$categoria][$key] = $juegoActualizado;

                    // Redirecciona a la página de juegos
                    JuegosController::index();
                }
            }
        } else {
            // La categoría o el juego con el ID especificado no existe
            echo 'La categoría o el juego no existe.';
        }
    }



    /**
     * La función 'filtrar' muestra juegos en función de la categoría especificada o muestra todos los juegos si no se especifica una categoría.
     *
     * Si se proporciona una categoría válida en 'tipo', recorre y muestra detalles de los juegos en esa categoría.
     * Si no se proporciona una categoría válida en 'tipo', o si no se proporciona en absoluto, recorre y muestra detalles de todos los juegos en todas las categorías.
     * Muestra información sobre cada juego, como ID, nombre, descripción, stock, precio y categoría.
     * Genera enlaces para editar o eliminar cada juego, incluyendo detalles como el ID del juego y su categoría.
     *
     * Esta función facilita la gestión de juegos y brinda a los usuarios la capacidad de ver, editar o eliminar juegos, mejorando la experiencia del usuario.
     */
    public static function filtrar()
    {
        $juegos = $GLOBALS['juegos'];

        if (isset($_POST['tipo']) && !empty($_POST['tipo'])) {
            $categoria = $_POST['tipo'];
            foreach ($juegos[$_POST['tipo']] as $key => $value2) {
                echo '<td>' . $value2['id'] . '</td>';
                echo '<td>' . $value2['nombre'] . '</td>';
                echo '<td>' . $value2['descripcion'] . '</td>';
                echo '<td>' . $value2['stock'] . '</td>';
                echo '<td>' . $value2['precio'] . '</td>';
                echo '<td>' . $_POST['tipo'] . '</td>';
                echo '<td>
                     <a href="?controller=Juegos&function=edit&id=' . $value2['id'] . '&categoria=' . $categoria . '">Editar</a>
                     <a href="?controller=Juegos&function=destroy&id=' .  $key . '&categoria=' . $categoria . '">Eliminar</a></td>';
                echo '</tr>';
            }
        } else {
            foreach ($juegos as $categoria => $value) {
                echo '<tr>';
                foreach ($value as $key => $value2) {
                    echo '<td>' . $value2['id'] . '</td>';
                    echo '<td>' . $value2['nombre'] . '</td>';
                    echo '<td>' . $value2['descripcion'] . '</td>';
                    echo '<td>' . $value2['stock'] . '</td>';
                    echo '<td>' . $value2['precio'] . '</td>';
                    echo '<td>' . $categoria . '</td>';
                    echo '<td>
                            <a href="?controller=Juegos&function=edit&id=' . $value2['id'] . '&categoria=' . $categoria . '">Editar</a>
                            <a href="?controller=Juegos&function=destroy&id='  . $key . '&categoria=' . $categoria . '">Eliminar</a></td>';
                    echo '</tr>';
                }
            }
        }
    }

    /**
     *  La función 'editar' permite editar un juego específico en función de su ID y categoría.
     */
    public static function editar(){
        $categoria = $_GET['categoria'];
        $id = $_GET['id'];

        if (isset($GLOBALS['juegos'][$categoria])) {
            foreach ($GLOBALS['juegos'][$categoria] as $juego) {
                if ($juego['id'] == $id) {
                    // Has encontrado el juego que coincide con el ID en la categoría especificada  
                    echo '<label for="id">id</label>';
                    echo '<input value="' . $juego['id'] . '" type="number" min=1 id="id" name="id" required><br>';
                    echo '<label for="nombre">nombre</label>';
                    echo '<input value="' . $juego['nombre'] . '" type="text" id="nombre" name="nombre" required><br>';
                    echo '<label for="descripcion">descripcion</label>';
                    echo '<input value="' . $juego['descripcion'] . '" type="text" id="descripcion" name="descripcion" required><br>';
                    echo '<label for="stock">stock</label>';
                    echo '<input value="' . $juego['stock'] . '" type="number" id="stock" name="stock"required><br>';
                    echo '<label for="precio">precio</label>';
                    echo '<input value="' . $juego['precio'] . '" type="number" step="0.01" id="precio" name="precio" required><br>';
                    echo '<label for="tipo">tipo</label>';
                    echo '<input value="' . $categoria . '" type="text" id="tipo" name="tipo" required><br>';
                    echo '<br>';
                    echo '<button id="editar">Editar</button>';

                    break;
                }
            }
        } else {
            echo 'Categoría no encontrada';
        }
    }

}