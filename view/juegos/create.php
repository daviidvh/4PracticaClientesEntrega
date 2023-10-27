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
        <form method="post" action="?controller=Juegos&function=save">
        <label for="id">id</label>
          <input type="number" min=1  id="id" name="id" required><br>
         <label for="nombre">nombre</label>
          <input type="text" id="nombre" name="nombre" required><br>
          <label for="descripcion">descripcion</label>
          <input type="text" id="descripcion" name="descripcion" required><br>
          <label for="stock">stock</label>
          <input type="number" id="stock" name="stock" required><br>
          <label for="precio">precio</label>
          <input type="number" step="0.01" id="precio" name="precio" required><br>
          <label for="tipo">tipo</label>
          <input type="text" id="tipo" name="tipo" required><br>
          <br>
          <button id="enviar">Enviar</button>
        </form>

    </main>
</body>
</html>