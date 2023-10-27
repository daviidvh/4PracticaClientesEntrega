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
        <form method="post" action="?controller=Clientes&function=save">
          <label for="nombre">nombre</label>
          <input type="text" id="nombre" name="nombre" required><br>
         <label for="dni">dni</label>
          <input type="text" id="dni" name="dni" required><br>
          <label for="telefono">telefono</label>
          <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" id="telefono" name="telefono" required><br>
          <label for="correo">correo</label>
          <input type="email" id="correo" name="correo" required><br>
          <br>
          <button id="enviar">Enviar</button>
        </form>

    </main>
</body>
</html>