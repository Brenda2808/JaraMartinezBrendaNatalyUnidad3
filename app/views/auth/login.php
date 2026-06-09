<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Médico</title>

    <link rel="stylesheet" href="http://medical_system.test/public/css/style.css">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<body>

    <div class="login-container">

        <div class="login-card">

            <h1>Sistema Médico</h1>

            <form action="/login" method="POST">

                <div class="input-group">

                    <label>Correo</label>

                    <input 
                        type="email"
                        name="correo"
                        placeholder="Ingresa tu correo"
                        required
                    >

                </div>

                <div class="input-group">

                    <label>Contraseña</label>

                    <input 
                        type="password"
                        name="password"
                        placeholder="Ingresa tu contraseña"
                        required
                    >

                </div>

                <button class="btn-login">
                    Iniciar Sesión
                </button>


                <p style="margin-top:15px;">

                    <a href="/forgot-password">
                        ¿Olvidaste tu contraseña?
                    </a>

                </p>
            </form>

        </div>

    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>    

<?php if(isset($_SESSION['error'])): ?>

<script>

toastr.error(
    '<?= $_SESSION['error'] ?>'
);

</script>

<?php unset($_SESSION['error']); ?>

<?php endif; ?>



</body>
</html>