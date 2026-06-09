<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Registro</title>

    <link rel="stylesheet"
    href="http://medical_system.test/public/css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h1>Registro Usuario</h1>

        <form id="formRegister">

            <div class="input-group">

                <label>Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    required
                >

            </div>

            <div class="input-group">

                <label>Correo</label>

                <input
                    type="email"
                    name="correo"
                    required
                >

            </div>

            <div class="input-group">

                <label>Contraseña</label>

                <input
                    type="password"
                    name="password"
                    required
                >

            </div>

            <div class="g-recaptcha"
                data-sitekey="6Lf_pBQtAAAAACYb3ZWegzZDL_8ZKf3dObm5tnca">
            </div>

            <button class="btn-login">

                Registrarse

            </button>

        </form>

        <p style="margin-top:20px;">

            ¿Ya tienes cuenta?

            <a href="/login" class="btn-secondary">
                Iniciar sesión
            </a>

        </p>

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


<script>

const formRegister =
document.getElementById('formRegister');

formRegister.addEventListener(
    'submit',
    async (e) => {

    e.preventDefault();

    const formData =
    new FormData(formRegister);

    try{

        const response = await fetch(
            '/register',
            {
                method: 'POST',
                body: formData
            }
        );

       const data =
await response.json();

        if(data.success){

            toastr.success(data.message);

            formRegister.reset();

        }else{

            toastr.error(data.message);
        }

    }catch(error){


    toastr.error(error);
}

});

</script>

</body>
</html>