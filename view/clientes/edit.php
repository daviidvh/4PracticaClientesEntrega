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
    <a href="?controller=Clientes&function=index">Atras</a>
     <form method="post" action="?controller=Clientes&function=update&id=<?php echo $id ?>">
          <label for="nombre">nombre</label>
          <input value="<?php echo $clientes['nombre']; ?>" type="text" id="nombre" name="nombre"><br>
         <label for="dni">dni</label>
          <input value="<?php echo $clientes['dni']; ?>" type="text" id="dni" name="dni"><br>
          <label for="telefono">telefono</label>
          <input value="<?php echo $clientes['telefono']; ?>"type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"  id="telefono" name="telefono"><br>
          <label for="correo">correo</label>
          <input value="<?php echo $clientes['correo']; ?>" type="email" id="correo" name="correo"><br>
          <br>
          <button id="editar">Editar</button>
        </form>

        <div id="coches">
        </div>
    </main>
</body>
</html>