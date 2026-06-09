<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Nueva contraseña</title>

    <link rel="stylesheet"
    href="/public/css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h1>Nueva contraseña</h1>

        <form id="formReset">

            <input
                type="hidden"
                name="token"
                value="<?= $_GET['token'] ?>"
            >

            <div class="input-group">

                <label>Nueva contraseña</label>

                <input
                    type="password"
                    name="password"
                    required
                >

            </div>

            <button class="btn-login">

                Actualizar contraseña

            </button>

        </form>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

const formReset =
document.getElementById('formReset');

formReset.addEventListener(
'submit',
async(e)=>{

    e.preventDefault();

    const formData =
    new FormData(formReset);

    try{

        const response =
        await fetch(
            '/reset-password',
            {
                method:'POST',
                body:formData
            }
        );

        const data =
        await response.json();

        if(data.success){

            toastr.success(data.message);

            setTimeout(()=>{

                window.location =
                '/login';

            },2000);

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
