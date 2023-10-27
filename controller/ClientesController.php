<?php
require_once 'Controller.php';

require_once 'db/datos.php';

class ClientesController implements Controller{

    /**
     * Funcion que recoge todos los coches y los muestyra en una vista
     */
    public static function index(){
        $clientes=$GLOBALS['clientes'];
        if(isset($_GET['orden'])){
            if($_GET['orden'] == 'desc'){
                $clientes = array_reverse($GLOBALS['clientes']);
                #Modificar el id
                foreach($clientes as $key => $value){
                    $key =intval($key-1);
                }
               }else{
               
            }
        }

        /**
         * Comprobamos si hay un error antes de enviarlo a la vista
         */
        
       
        include 'view/Clientes/index.php';
    }


    public static function create(){
        include 'view/Clientes/create.php';

    }

    

    public static function save(){
        if(isset($_POST)){
        $cliente=array(
                'nombre' => $_POST['nombre'],
                'dni' => $_POST['dni'],
                'telefono' =>$_POST['telefono'],
                'correo' => $_POST['correo'],
        );

        array_push($GLOBALS['clientes'],$cliente);
    }
        ClientesController::index();

    }

    public static function edit($id){

        $clientes =null;
           $clientes=$GLOBALS['clientes'];
           foreach ($clientes as $key => $value) {
               if ($key == $id) {
                   # pinto
                   $clientes=$value;
               }
           }
        include 'view/Clientes/edit.php';

    }




    public static function destroy($id){
        if(array_key_exists($id, $GLOBALS['clientes'])){
            unset($GLOBALS['clientes'][$id]);
        }else{
            #Respuesta si no existe
            $GLOBALS['error']="No se encuentra el cliente";
        }
        ClientesController::index();

    }



    public static function update($id)
    {


        $nombre=$_POST['nombre'];
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];


        $clientes=$GLOBALS['clientes'];
         foreach ($GLOBALS['clientes'] as $key => $value) {
            if ($key== $id) {
                # Si la clave es la misma que el id, Actualizo
                $GLOBALS['clientes'][$key]['nombre']=$nombre;
                $GLOBALS['clientes'][$key]['dni']=$dni;
                $GLOBALS['clientes'][$key]['telefono']=$telefono;    
                $GLOBALS['clientes'][$key]['correo']=$correo;


            }else{
                #Opcional mensaje de retorno de no poder actualizar
            }
         }
         ClientesController::index();
    }

 }


?>