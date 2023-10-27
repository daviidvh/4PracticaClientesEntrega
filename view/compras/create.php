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
    <a href="?controller=Compras&function=index">Atras</a>
        <form method="post" action="?controller=Compras&function=save">
        <label for="cliente_dni">Dni</label>
          <input type="cliente_dni" id="cliente_dni" name="cliente_dni" required><br>
          <label for="juego_id">Id Juego</label>
          <input type="number" min=1  id="juego_id" name="juego_id" required><br>
          <label for="cantidad">Cantidad</label>
          <input type="number" min=1 id="stock" name="cantidad" required><br>
          <label for="precio">precio</label>
          <input type="number" step="0.01" id="precio" name="precio" required><br>
          <label for="fecha">fecha</label>
          <input type=datetime-local step="1"  min="2011-02-20T20:20" max="2031-02-20T20:20" id="fecha" name="fecha" required><br>
          <br>
          <button id="enviar">Enviar</button>
        </form>

    </main>
</body>
</html>

