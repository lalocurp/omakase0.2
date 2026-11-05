<?php
include('conexion.php');

$query = "SELECT * FROM productos WHERE categoria = 'Streetwear'";
$resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMAKASE | Streetwear Culinario</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <h1>OMAKASE<span class="dot">.</span></h1>
            <span class="subtext">URBAN CHEFWEAR</span>
        </div>
        <nav class="nav-links">
            <a href="index.html">Inicio</a>
            <a href="filipinas.php">Filipinas</a>
            <a href="delantales.php">Delantales</a>
            <a href="streetwear.php" class="active">Streetwear</a>
            <a href="admin.html" class="btn-salmon-sm">Panel BD</a>
        </nav>
    </header>

    <main class="main-content">
        <div class="section-header">
            <h2>Categoría: Streetwear</h2>
            <p>Productos cargados dinámicamente desde la base de datos MySQL.</p>
        </div>

        <div class="products-grid">
            <?php 
            if (mysqli_num_rows($resultado) > 0) {
                while ($producto = mysqli_fetch_assoc($resultado)) { 
            ?>
                    <div class="product-card">
                        <div class="badge-tag">Talla <?php echo $producto['talla']; ?></div>
                        <h3><?php echo $producto['nombre']; ?></h3>
                        <span class="category-tag"><?php echo $producto['categoria']; ?></span>
                        <p class="price">$<?php echo number_format($producto['precio'], 2); ?> MXN</p>
                        <p class="stock">Stock: <?php echo $producto['stock']; ?> dispon.</p>
                        <button class="btn-salmon full-width">Comprar</button>
                    </div>
            <?php 
                }
            } else {
                echo "<p>No hay productos registrados en esta categoría.</p>";
            }
            ?>
        </div>
    </main>

</body>
</html>