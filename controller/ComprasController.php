<?php
require_once 'Controller.php';

require_once 'db/datos.php';

class ComprasController implements Controller
{

    public static function index()
    {
        $compras = $GLOBALS['compras'];
        include 'view/Compras/index.php';
    }

    public static function create()
    {
        include 'view/Compras/create.php';
    }
    /**
     * Función para la creacion de compras.
     * Recopila los datos del formulario y verifica si la compra ya existe en el array global de compras.
     * Agrega la compra si no existe o muestra un mensaje si ya existe.
     * Redirige a la página de índice de compras después de procesar.
     */
    public static function save()
    {
        //Crear idJuego  Cantidad precio y fecha

        if (isset($_POST)) {
            $compra = array(
                'cliente_dni' => $_POST['cliente_dni'],
                'juego_id' => $_POST['juego_id'],
                'precio' => $_POST['precio'],
                'cantidad' => $_POST['cantidad'],
                'fecha' => $_POST['fecha'],

            );
            $compraExiste = false;
            foreach ($GLOBALS['compras'] as $id => $value) {
                if ($value['cliente_dni'] == $compra['cliente_dni'] && $value['juego_id'] == $compra['juego_id']) {
                    $compraExiste = true;
                }
            }
            if (!$compraExiste) {
                array_push($GLOBALS['compras'], $compra);
            } else {
                echo 'Compra existente';
            }

            ComprasController::index();
        }
    }


    /**
     * Función para actualizar una compra existente.
     * Recibe un ID de compra, recopila los datos del formulario de actualización y actualiza la compra en el array global de compras.
     * Redirige a la página de índice de compras después de procesar.
     */
    public static function update($id){
        $id = $_GET['id'];
        if (isset($GLOBALS['compras'][$id])) {
            $cliente_dni = $_POST['cliente_dni'];
            $juego_id = $_POST['juego_id'];
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];
            $fecha = $_POST['fecha'];


            $compraActualizada = array(
                'cliente_dni' => $cliente_dni,
                'precio' => $precio,
                'juego_id' => $juego_id,
                'cantidad' => $cantidad,
                'fecha' => $fecha
            );
            $GLOBALS['compras'][$id] = $compraActualizada;
            var_dump($GLOBALS['compras'][$id]);

            ComprasController::index();
        }
    }


    /**
     * Función para editar una compra existente.
     * Recibe un ID de compra, busca la compra en el array global de compras y muestra el formulario de edición en la vista.
     */
    public static function edit($id)
    {
        $compras = $GLOBALS['compras'];
        foreach ($compras as $id => $value) {
            foreach ($value as $key => $value2) {
                if ($id == $key) {
                    # pinto
                    $compras = $value2;
                }
            }
        }
        include 'view/Compras/edit.php';
    }

    /**
    * Función para eliminar una compra.
    * Recibe un ID de compra desde la solicitud GET, verifica si el cliente DNI coincide con el DNI 
    * en la compra y elimina la compra del array global de compras si coinciden. 
    * Luego, redirige a la página de listado de compras.
    */
    public static function destroy($id)
    {
        $dni = $_GET['dni'];

        if ($dni == $GLOBALS['compras'][$id]['cliente_dni']) {
            unset($GLOBALS['compras'][$id]);
        } else {
            $GLOBALS['error'] = "No se encuentra la Compra";
        }

        ComprasController::index();
    }


    /**
    * Función para mostrar las compras realizadas por los clientes.
    * Recorre la matriz de juegos, clientes y compras para mostrar información relevante sobre las compras,
    * como ID de compra, DNI del cliente, nombre del cliente, ID del juego, nombre del juego, precio de la compra, 
    * cantidad de juegos comprados, costo total y fecha de la compra.
    */
    public static function mostarCompra()
    {
        $clientes = $GLOBALS['clientes'];
        $juegos = $GLOBALS['juegos'];
        $compras = $GLOBALS['compras'];
        // Recorre la matriz de juegos, donde $categoria es la categoría y $value es la lista de juegos en esa categoría.
        foreach ($juegos as $categoria => $value) {
            // Recorre los juegos en esa categoría, donde $key es la clave del juego y $value2 es el juego en sí.
            foreach ($value as $key => $value2) {
                $juegoId = $value2['id'];
                // Compara el DNI del cliente con el DNI registrado en las compras y el ID del juego con el ID registrado en las compras para determinar si este cliente ha comprado este juego.
                foreach ($clientes as $id => $value) {
                    $clienteDni = $value['dni'];
                    foreach ($compras as $id => $compra) {
                        //Compara los dni de los clientes con $clienteDni con el dni del array de clientes y compara el juego_id con el id del array de juegos
                        if ($compra['cliente_dni'] == $clienteDni && $compra['juego_id'] == $juegoId) {
                            // Crea una fila en la tabla con información relevante, como el ID de la compra, el DNI del cliente, el nombre del cliente, el ID del juego, el nombre del juego, el precio de la compra, la cantidad de juegos comprados, el costo total y la fecha de la compra.
                            echo '<tr>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $compra['cliente_dni'] . '</td>';
                            echo '<td>' . $value['nombre'] . '</td>';
                            echo '<td>' . $compra['juego_id'] . '</td>';
                            echo '<td>' . $value2['nombre'] . '</td>';
                            echo '<td>' . $compra['precio'] . '</td>';
                            echo '<td>' . $compra['cantidad'] . '</td>';
                            echo '<td>' . $compra['precio'] * $compra['cantidad'] . '</td>';
                            echo '<td>' . $compra['fecha'] . '</td>';
                            echo '<td>
                                    <a href="?controller=Compras&function=edit&id=' . $id . '">Editar</a>
                                    <a href="?controller=Compras&function=destroy&id=' . $id . '&dni=' . $compra['cliente_dni'] . '">Eliminar</a></td>';
                            echo '</tr>';
                        }
                    }
                }
            }
        }
    }

    /**
     * Función para editar una compra existente.
     * Permite editar los campos: cantidad, precio y fecha de una compra.´
     */
    public static function editarCompra()
    {
        //Editar precio cantidad y fecha
        $compra = $GLOBALS['compras'];
        $id = $_GET['id'];


        echo '<label for="cliente_dni">cliente_dni</label>';
        echo '<input value="' . $compra[$id]['cliente_dni'] . '" type="text" id="cliente_dni" name="cliente_dni" readonly><br>';
        echo '<label for="juego_id">juego_id</label>';
        echo '<input value="' . $compra[$id]['juego_id'] . '" type="text" id="juego_id" name="juego_id" readonly><br>';
        echo '<label for="cantidad">cantidad</label>';
        echo '<input value="' . $compra[$id]['cantidad'] . '" type="number" id="cantidad" name="cantidad" min="1" required><br>';
        echo '<label for="precio">precio</label>';
        echo '<input value="' . $compra[$id]['precio'] . '" type="number" step="0.01" id="precio" name="precio" required><br>';
        echo '<label for="fecha">fecha</label>';
        echo '<input value="' . $compra[$id]['fecha'] . '" type=datetime-local step="1"  min="2011-02-20T20:20" max="2031-02-20T20:20" id="fecha" name="fecha" required><br>';
        echo '<br>';
        echo '<button id="editar">Editar</button>';
    }
}

