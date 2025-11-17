<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>

    <!-- Bootstrap 4.5.2 (mantengo la versión original) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* ====== ESTILO GENERAL ====== */
        body {
            background-color: #f8f9fa; /* Mismo color original */
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* ====== IMÁGENES LATERALES ====== */
        .side-image {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            object-fit: contain;
            opacity: 0.95;
        }

        .side-left {
            left: 180px;
            width: 78px;
            height: 480px;
        }

        .side-right {
            right: 40px;
            width: 180px;
            height: auto;
        }

        /* ====== CONTENEDOR PRINCIPAL ====== */
        .menu-container {
            text-align: center;
            width: 100%;
            max-width: 900px;
            z-index: 2;
        }

        .menu-title {
            margin-bottom: 40px;
            font-weight: bold;
            font-size: 1.8rem; /* Mismo tamaño original */
        }

        .menu-button {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 15px;
            font-size: 1.2rem;
            border-radius: 25px;
            background-color: #007bff; /* Usa el color de btn-primary de Bootstrap */
            color: #fff;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animación añadida: escalado y sombra */
            animation: fadeIn 1s ease-in; /* Animación de aparición */
        }

        .menu-button:hover {
            transform: scale(1.05); /* Escalado al hover */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Animación CSS para fade-in */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ====== SECCIÓN CONTÁCTANOS ====== */
        .contact-section {
            margin-top: 40px; /* Separación del menú principal */
            padding: 20px;
            border-top: 2px solid #007bff; /* Línea separadora simple */
            animation: fadeInContact 1.5s ease-in; /* Animación específica para esta sección */
        }

        @keyframes fadeInContact {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .contact-title {
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .contact-list {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        .contact-list li {
            margin: 10px 0;
            font-size: 1.1rem;
            transition: color 0.3s ease; /* Animación para los enlaces */
        }

        .contact-list li a {
            text-decoration: none;
            color: #007bff; /* Color de enlace predeterminado */
        }

        .contact-list li a:hover {
            color: #0056b3; /* Cambio sutil al hover */
        }

        /* Pantalla de carga mejorada */
        .loading-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(210, 180, 140, 0.9); /* Mismo color original */
            z-index: 9999;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
            opacity: 1;
        }

        .loading-modal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loading-content {
            text-align: center;
        }

        .loading-text {
            color: #8B4513; /* Mismo color original */
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>  
    <?php
    // ================= IMÁGENES LATERALES =================
    $img_izquierda = FCPATH . 'imagenes/lado_izquierdo.png';
    $img_derecha = FCPATH . 'imagenes/lado_derecho.png';

    $url_izquierda = base_url('imagenes/' . (file_exists($img_izquierda) ? 'lado_izquierdo.png' : 'no-disponible.png'));
    $url_derecha = base_url('imagenes/' . (file_exists($img_derecha) ? 'lado_derecho.png' : 'no-disponible.png'));
    ?>

    <!-- Imagen izquierda -->
    <img src="<?php echo $url_izquierda; ?>" alt="Imagen izquierda" class="side-image side-left">

    <!-- Imagen derecha -->
    <img src="<?php echo $url_derecha; ?>" alt="Imagen derecha" class="side-image side-right">

    <!-- ============== CONTENIDO PRINCIPAL DEL MENÚ ============== -->
    <div class="menu-container">
        <h2 class="menu-title">Menú Principal</h2>

        <div class="d-flex flex-column align-items-center"> <!-- Contenedor para botones en columna -->
            <?php foreach ($menu as $item): ?>
                <?php if (in_array(strtolower($item->nombre), ['ventas', 'perfumes'])) continue; ?>
                <a href="<?php echo site_url($item->url); ?>" class="menu-button"><?php echo $item->nombre; ?></a>
            <?php endforeach; ?>

            <!-- Botón para descargar PDF DOCUMENTACION -->
            <a href="<?php echo base_url('documentos/DOCUMENTACION.pdf'); ?>" download class="menu-button">
                Descargar Manual de Usuario
            </a>
        </div>

        <!-- Sección separada y organizada para Contáctanos -->
        <div class="contact-section">
            <h3 class="contact-title">Contáctanos</h3>
            <ul class="contact-list">
                <li><a href="https://www.instagram.com/mufasacolombi" target="_blank">Instagram</a></li>
                <li><a href="mailto:mufasacolombia@gmail.com">Gmail</a></li>
                <li><a href="https://wa.me/573054437050" target="_blank">WhatsApp / Teléfono</a></li>
            </ul>
        </div>
    </div>

    <!-- Modal de pantalla de carga -->
    <div class="loading-modal" id="loadingModal">
        <div class="loading-content">
            <p class="loading-text">Cargando</p>
        </div>
    </div>

    <!-- ============== CHAT TAWK.TO Y JS DE CARGA ============== -->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/68dd9f34b16811194df755c5/1j6grbpej';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();

    function hideLoadingModal() {
        const loadingModal = document.getElementById('loadingModal');
        loadingModal.classList.add('hidden');
        setTimeout(() => {
            loadingModal.style.display = 'none';
        }, 500);
    }

    window.addEventListener('load', function() {
        const loadingModal = document.getElementById('loadingModal');
        loadingModal.style.display = 'flex';
        setTimeout(hideLoadingModal, 1500);
    });

    const menuButtons = document.querySelectorAll('.menu-button');
    const loadingModal = document.getElementById('loadingModal');

    menuButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && !href.includes('#')) {
                e.preventDefault();
                loadingModal.style.display = 'flex';
                loadingModal.classList.remove('hidden');
                setTimeout(() => {
                    try {
                        window.location.href = href;
                    } catch (error) {
                        console.error('Error en redirección:', error);
                        hideLoadingModal();
                    }
                }, 2000);
            }
        });
    });
    </script>
    <script>
    // JS para mostrar/ocultar el modal al cargar esta vista
    function initLoadingModal() {
        const loadingModal = document.getElementById('loadingModalVista');
        if (!loadingModal) return; // Si no existe, no hace nada

        // Mostrar modal al cargar la página
        loadingModal.style.display = 'flex';

        // Ocultar después de 1.5 segundos (ajusta si quieres más tiempo)
        setTimeout(() => {
            loadingModal.classList.add('hidden');
            setTimeout(() => {
                loadingModal.style.display = 'none';
            }, 500); // Tiempo del fade-out
        }, 1500);
    }

    // Ejecutar cuando el DOM esté listo (más rápido que 'load')
    document.addEventListener('DOMContentLoaded', initLoadingModal);

    // Opcional: Si la página tiene contenido dinámico (AJAX), llama initLoadingModal() cuando termines de cargar
</script>
</body>
</html>
 