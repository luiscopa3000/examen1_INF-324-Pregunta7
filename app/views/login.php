<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <br><br><br><br>

    <div class="container">
        <h2>Iniciar Session</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="login_ver">

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php if(isset($_POST['correo'])) {echo $_POST['correo']; }?>" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="password" value="<?php if(isset($_POST['password'])) {echo $_POST['password']; }?>" required>

            <label for="tipo_usuario">Tipo de Usuario:</label>
            <select id="tipo_usuario" name="rol" required>
                <option value="Director">Director</option>
                <option value="gerente">Gerente</option>
                <option value="cliente">Cliente</option>
                <option value="cajero">Cajero</option>
            </select>

            <!-- Div flotante -->
            <?php if (isset($_POST['error'])) { ?>
                <p style="color:red">No se pudo encontrar al usuario</p>
            <?php } ?>

            <input type="submit" value="Registrar">
        </form>

    </div>
</body>

</html>