<?php 

interface Controller{
    #Funcion abstracta index que muestra todos los elementos (tabla)
    public static function index();

    #Funcion abstaracta create que muestra un formulario para agregar un eleemnto
    public static function create();
    #Funcion abstaracta save que inserta en la BD los elementos recogidos del formulario
    public static function save();


    #Funcion abstracta edit que recibe un $id de un elemento y muestra un formulario con su dato

    public static function edit($id);

    #Funcion abstracta update que recibe un $id de un elemento y actualiza su contenido 
    public static function update($id);

    #Funcion abstracta destroy que recibe un $id de un elemento y lo elimina de la bd

    public static function destroy($id);

}   
?>