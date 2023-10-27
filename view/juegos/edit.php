<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./asset/css/styleForm.css">

</head>

<body>
    <main>
        <a href="?controller=Juegos&function=index">Atras</a>
        <form method="post" action="?controller=Juegos&function=update&id=<?php echo  $_GET['id'] ?>&categoria=<?php echo $_GET['categoria'] ?>">
            <?php
            JuegosController::editar();
            
            ?>
        </form>

    </main>
</body>

</html>