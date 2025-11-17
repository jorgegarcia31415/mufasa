<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registro</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            animation: rotate 6s linear infinite;
            pointer-events: none;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        h2 {
            text-align: center;
            color: #4a90e2;
            margin-bottom: 20px;
            font-size: 2em;
            animation: bounceIn 1s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        .error {
            color: #e74c3c;
            background: #ffeaea;
            border: 1px solid #e74c3c;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #34495e;
            margin-bottom: 5px;
            font-weight: bold;
            animation: fadeInUp 0.6s ease-out;
        }

        input {
            padding: 12px;
            border: 2px solid #bdc3c7;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 1em;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 10px rgba(74, 144, 226, 0.5);
            transform: scale(1.02);
        }

        button {
            background: linear-gradient(45deg, #4a90e2, #357abd);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        button:hover {
            background: linear-gradient(45deg, #357abd, #2c5aa0);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            animation: fadeInUp 0.6s ease-out;
        }

        .login-link a {
            color: #4a90e2;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #357abd;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 20px;
                margin: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrarse</h2>

        <?php echo validation_errors('<div class="error">', '</div>'); ?>

        <form action="<?php echo site_url('auth/register_post'); ?>" method="POST">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo set_value('nombre'); ?>" required minlength="2" maxlength="100" />

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" required />

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required minlength="6" />

            <label for="password_confirm">Confirmar Contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" required />

            <button type="submit">Registrarse</button>
        </form>

        <div class="login-link">
            <p>¿Ya tienes cuenta? <a href="<?php echo site_url('auth'); ?>">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>