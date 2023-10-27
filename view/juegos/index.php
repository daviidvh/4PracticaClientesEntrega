<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juegos</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <header>
    <h1>INDEX de Juegos</h1>
            <a href="index.php">Ir a inicio</a>
    </header>
    <main>
        <a href="?controller=Juegos&function=create">Crear Juego</a>
        <form method="post" action="">
            <label for="tipo">Selecciona el tipo de juego:</label>
            <select name="tipo" id="tipo">
                <option value="Accion">Acción</option>
                <option value="Aventura">Aventura</option>
                <option value="Deportes">Deportes</option>
                <option value="">Mostrar Todos</option>
            </select>
            <input type="submit" value="Filtrar">
        </form>
            <table>
            <caption>Juegos</caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Stock</th>
                        <th>Precio
                            &nbsp;
                            <a class="btn" href="?controller=Juegos&function=index&orden=asc">Ascendente</a>
                            &nbsp;
                            <a class="btn" href="?controller=Juegos&function=index&orden=desc">Descendente</a></td>
                        </th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>        
                </thead>
                <tbody>
                    <?php
                      JuegosController::filtrar();
                     ?>
                  </tbody>
            </table>
    </main>
</body>
</html>