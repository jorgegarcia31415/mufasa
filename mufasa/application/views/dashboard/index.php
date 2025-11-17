<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Reinicio de márgenes/padding para evitar que el layout viejo empuje contenido */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100%;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;  /* centra horizontal */
            align-items: center;      /* centra vertical */
        }

        /* Forzar que el menú esté por encima de todo */
        .menu-container {
            position: relative;
            z-index: 9999;
            text-align: center;
            width: 100%;
            max-width: 1000px;
            padding: 20px;
        }

        .menu-title {
            margin-bottom: 40px;
            font-weight: bold;
            font-size: 1.8rem;
        }

        .card {
            text-align: center;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
            height: 100%;
            background: white;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .menu-img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin: 20px auto 10px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .btn-primary {
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <h2 class="menu-title">Menú Principal</h2>
        <div class="row justify-content-center">
            <?php foreach ($menu as $item): ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card flex-fill">
                        <?php
                        // Nombre de la imagen (ej: marcas.png, inventario.png, etc.)
                        $img_filename = strtolower($item->nombre) . ".png";  
                        $ruta_fisica = FCPATH . 'imagenes/' . $img_filename;

                        // Verifica si existe la imagen, si no, carga no-disponible.png
                        $img_url = base_url('imagenes/' . (file_exists($ruta_fisica) ? $img_filename : 'no-disponible.png'));
                        ?>
                        <img src="<?php echo $img_url; ?>" alt="<?php echo $item->nombre; ?>" class="menu-img">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item->nombre; ?></h5>
                            <a href="<?php echo site_url($item->url); ?>" class="btn btn-primary">Ir</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
