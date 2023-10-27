<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
    <header>
        <h1>INDEX de Compras</h1>
        <a href="index.php">Ir a inicio</a>
    </header>

    <main>
        <a href="?controller=Compras&function=create">Crear compra</a>
        <table>
            <caption>Compras</caption>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>DNI</th>
                    <th>Nombre Cliente</th>
                    <th>Juego Id</th>
                    <th>Nombre Juego</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                ComprasController::mostarCompra();
                ?>

            </tbody>
        </table>
    </main>
</body>

</html>