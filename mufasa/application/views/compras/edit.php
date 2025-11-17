<?php
// Cambio añadido: Check de sesión redundante al inicio de la vista.
// Por qué: Aunque el controller ya verifica, añade una capa extra de seguridad en la vista.
// Qué función tiene: Redirige si no hay sesión, previniendo carga de datos sin autenticación.
// Para qué sirve: Refuerza el aislamiento, evitando que usuarios no logueados vean o editen formularios.
if (!$this->session->userdata('user_id')) {
    redirect('auth');
}
// Helper 'url' para base_url(), esencial en perfumería Mufasa para formularios dinámicos sin hardcode, mejora edición de compras.
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Compra - Mufasa Perfumería</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Íconos perfumes/león para branding Mufasa -->
  <style>
    /* Estilos para layout original diferente: Grid asimétrico de tarjetas flotantes azules, organización premium para edición de compras */
    body { 
      background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 50%, #90caf9 100%); /* Gradiente azul fresco, evoca fragancias frescas en perfumería Mufasa */
      margin: 0; padding: 20px; /* Padding para espacio, sin márgenes para inmersión */
      animation: bgPulse 15s infinite; /* Pulso sutil, simula aroma envolvente en tienda de perfumes */
    }
    @keyframes bgPulse { 0%,100% { filter: brightness(1); } 50% { filter: brightness(1.05); } } /* Pulso corto para ritmo relajante */

    .edit-container { 
      max-width: 900px; margin: 0 auto; /* Centro contenedor, organización simétrica */
      animation: containerZoom 1s ease; /* Zoom entrada para foco en edición */
    }
    @keyframes containerZoom { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } } /* Zoom simple */

    .header-title { 
      text-align: center; margin-bottom: 30px; color: #1976d2; /* Título azul centrado, organización clara */
      animation: titleGlow 1s ease; /* Glow para destacar */
    }
    @keyframes titleGlow { from { text-shadow: 0 0 5px #1976d2; } to { text-shadow: 0 0 15px #1976d2; } } /* Glow azul corto */

    .fields-grid { 
      display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; /* Grid asimétrico para tarjetas campos, organización original diferente */
      animation: gridExpand 1s ease; /* Expand entrada */
    }
    @keyframes gridExpand { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } } /* Expand simple */

    .field-card { 
      background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(25,118,210,0.1); /* Tarjetas azules flotantes */
      border: 2px solid #1976d2; /* Borde azul para tema Mufasa */
      animation: cardFloat 0.8s ease forwards; animation-delay: calc(var(--i) * 0.15s); /* Float escalonado */
    }
    @keyframes cardFloat { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } } /* Float corto */

    .field-card:hover { 
      transform: translateY(-5px) scale(1.02); box-shadow: 0 8px 20px rgba(25,118,210,0.2); transition: 0.3s; /* Hover flotante para interactividad */
    }

    .field-label { 
      color: #1976d2; font-weight: bold; margin-bottom: 8px; /* Etiquetas azules con íconos */
      animation: labelPulse 2s infinite; /* Pulso para atención */
    }
    @keyframes labelPulse { 0%,100% { opacity: 1; } 50% { opacity: 0.8; } } /* Pulso sutil */

    .form-input { 
      border: none; border-bottom: 3px solid #1976d2; background: transparent; width: 100%; padding: 8px; /* Inputs azules personalizados */
      transition: 0.3s; /* Focus suave */
    }
    .form-input:focus { 
      border-bottom-color: #0d47a1; box-shadow: 0 2px 8px rgba(25,118,210,0.3); transform: scale(1.01); /* Focus con glow azul */
    }

    .btn-update { 
      background: linear-gradient(45deg, #1976d2, #0d47a1); color: white; border: none; padding: 12px 25px; border-radius: 8px; /* Botón azul gradiente */
      animation: btnBounce 0.6s ease; /* Bounce entrada */
      transition: 0.3s; /* Hover suave */
    }
    @keyframes btnBounce { 0% { transform: scale(0); } 50% { transform: scale(1.2); } 100% { transform: scale(1); } } /* Bounce corto */
    .btn-update:hover { 
      transform: translateY(-3px) scale(1.05); box-shadow: 0 6px 15px rgba(25,118,210,0.4); /* Hover con lift y glow */
    }

    .actions-section { 
      text-align: center; margin-top: 30px; /* Centro acciones, organización clara */
      animation: slideUp 0.8s ease; /* Slide up */
    }
    @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } } /* Slide corto */
  </style>
</head>
<body>

  <div class="edit-container"> <!-- Contenedor centrado, organización simétrica -->
    <h4 class="header-title"><i class="fas fa-edit"></i> Editar Compra - Mufasa Perfumería</h4> <!-- Título con ícono edit, branding azul -->

    <form action="<?php echo base_url('compras/compras/actualizar') ?>" method="post"> <!-- Form POST intacto, funcionalidad original -->
      <div class="fields-grid"> <!-- Grid asimétrico para tarjetas campos, layout original diferente -->
        <div class="field-card" style="--i: 1;"> <!-- Tarjeta ID, animada primera -->
          <label class="field-label"><i class="fas fa-hashtag"></i> Identidad de la Compra</label> <!-- Etiqueta con ícono, destaca ID único en compras -->
          <input type="text" class="form-input" name="id_compra" readonly value="<?php echo $compras->id_compra?>"> <!-- Input readonly, evita edición accidental -->
        </div>
        <div class="field-card" style="--i: 2;"> <!-- Tarjeta fecha -->
          <label class="field-label"><i class="fas fa-calendar-alt"></i> Fecha</label> <!-- Etiqueta con ícono calendario, agendamiento compras -->
          <input type="date" class="form-input" name="fecha" value="<?php echo $compras->fecha?>"> <!-- Input fecha editable, reprogramación -->
        </div>
        <div class="field-card" style="--i: 3;"> <!-- Tarjeta proveedor -->
          <label class="field-label"><i class="fas fa-truck"></i> Proveedor</label> <!-- Etiqueta con ícono camión, suministro perfumes -->
          <input type="text" class="form-input" name="proveedor" value="<?php echo $compras->proveedor?>"> <!-- Input proveedor editable -->
        </div>
        <div class="field-card" style="--i: 4;"> <!-- Tarjeta perfume ID -->
          <label class="field-label"><i class="fas fa-spray-can"></i> Identidad del Perfume</label> <!-- Etiqueta con ícono spray, fragancias -->
          <input type="text" class="form-input" name="id_perfume" value="<?php echo $compras->id_perfume?>"> <!-- Input perfume editable -->
        </div>
        <div class="field-card" style="--i: 5;"> <!-- Tarjeta cantidad -->
          <label class="field-label"><i class="fas fa-boxes"></i> Cantidad</label> <!-- Etiqueta con ícono cajas, inventario -->
          <input type="text" class="form-input" name="cantidad" value="<?php echo $compras->cantidad?>"> <!-- Input cantidad editable -->
        </div>
        <div class="field-card" style="--i: 6;"> <!-- Tarjeta costo unitario -->
          <label class="field-label"><i class="fas fa-dollar-sign"></i> Costo Unitario</label> <!-- Etiqueta con ícono dólar, precios compras -->
          <input type="text" step="0.01" class="form-input" name="costo_unitario" value="<?php echo $compras->costo_unitario?>"> <!-- Input costo editable -->
        </div>
        <div class="field-card" style="--i: 7;"> <!-- Tarjeta total, span 2 columnas -->
          <label class="field-label"><i class="fas fa-calculator"></i> Total</label> <!-- Etiqueta con ícono calculadora, total compra -->
          <input type="text" step="0.01" class="form-input" name="total" value="<?php echo $compras->total?>"> <!-- Input total editable -->
        </div>
      </div>

      <div class="actions-section"> <!-- Sección acciones centrada -->
        <button type="submit" class="btn-update"><i class="fas fa-save"></i> Actualizar Compra</button> <!-- Botón submit con ícono save -->
      </div>
    </form>
  </div>

</body>
</html>