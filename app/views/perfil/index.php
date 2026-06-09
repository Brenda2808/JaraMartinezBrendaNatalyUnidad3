<h1 class="dashboard-title">

    Mi Perfil

</h1>

<div class="patient-form">

<?php if($perfil): ?>

<form
    action="/mi-perfil/actualizar"
    method="POST"
>

    <div class="form-grid">

        <div class="form-group">

            <label>Nombre</label>

            <input
                type="text"
                value="<?= $perfil['nombre'] ?>"
                disabled
            >

        </div>

        <div class="form-group">

            <label>Edad</label>

            <input
                type="number"
                name="edad"
                value="<?= $perfil['edad'] ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Teléfono</label>

            <input
                type="tel"
                name="telefono"
                maxlength="10"
                minlength="10"
                pattern="[0-9]{10}"
                value="<?= $perfil['telefono'] ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Correo</label>

            <input
                type="email"
                name="correo"
                value="<?= $perfil['correo'] ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Peso</label>

            <input
                type="text"
                name="peso"
                value="<?= $perfil['peso'] ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Estatura</label>

            <input
                type="text"
                name="estatura"
                value="<?= $perfil['estatura'] ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Historial Médico</label>

            <textarea
                name="historial"
            ><?= $perfil['historial'] ?></textarea>

        </div>

    </div>

    <button class="btn-primary">

        Actualizar Perfil

    </button>

</form>
<?php endif; ?>

</div>