<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <header>
    <h1>INDEX de Clientes</h1>
            <a href="index.php">Ir a inicio</a>
    </header>

    <main>
        <a href="?controller=Clientes&function=create">Crear cliente</a>
            <table>
            <caption>Clientes
                &nbsp;
                <a class="btn" href="?controller=Clientes&function=index&orden=asc">Ascendente</a>
                &nbsp;
                <a class="btn" href="?controller=Clientes&function=index&orden=desc">Descendente</a></td>
            </caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>        
                </thead>
                <tbody>
                  <?php
                    if(isset($clientes)){
                        foreach ($clientes as $id => $value) {
                        echo '<tr>';
                        echo '<td>'.$id .'</td>';
                        echo '<td>'.$value['nombre'].'</td>';
                        echo '<td>'.$value['dni'].'</td>';
                        echo '<td>'.$value['telefono'].'</td>';
                        echo '<td>'.$value['correo'].'</td>';
                        echo '<td>
                              <a href="?controller=Clientes&function=edit&id='.$id.'">Editar</a>
                              <a href="?controller=Clientes&function=destroy&id='.$id.'">Eliminar</a></td>';
                        echo '</tr>';
                        }
                    }
                ?>
                  </tbody>
            </table>
    </main>
</body>
</html>