<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Recuperar contraseña</title>

    <link rel="stylesheet"
    href="/public/css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h1>Recuperar contraseña</h1>

        <form id="formForgot">

            <div class="input-group">

                <label>Correo</label>

                <input
                    type="email"
                    name="correo"
                    required
                >

            </div>

            <button class="btn-login">

                Enviar enlace

            </button>

        </form>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

const formForgot =
document.getElementById('formForgot');

formForgot.addEventListener(
'submit',
async(e)=>{

    e.preventDefault();

    const formData =
    new FormData(formForgot);

    try{

        const response =
        await fetch(
            '/forgot-password',
            {
                method:'POST',
                body:formData
            }
        );

        const text =
await response.text();

console.log(text);

const data =
JSON.parse(text);

        console.log(data);

        if(data.success){

            toastr.success(data.message);

            formForgot.reset();

        }else{

            toastr.error(data.message);
        }

    }catch(error){

        console.log(error);

        toastr.error(
            'Error del servidor'
        );
    }

});

</script>

</body>
</html>