<h1 class="dashboard-title">

    Editar Usuario

</h1>

<div class="patient-form">

    <form
        action="/usuarios/actualizar"
        method="POST"
    >

        <input
            type="hidden"
            name="id"
            value="<?= $usuario['id'] ?>"
        >

        <div class="form-grid">

            <div class="form-group">

                <label>Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    value="<?= $usuario['nombre'] ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Correo</label>

                <input
                    type="email"
                    name="correo"
                    value="<?= $usuario['correo'] ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Rol</label>

                <select name="rol">

                    <option
                        value="usuario"
                        <?= $usuario['rol'] == 'usuario'
                        ? 'selected' : '' ?>
                    >

                        Usuario

                    </option>

                    <option
                        value="admin"
                        <?= $usuario['rol'] == 'admin'
                        ? 'selected' : '' ?>
                    >

                        Admin

                    </option>

                </select>

            </div>

        </div>

        <button class="btn-primary">

            Actualizar Usuario

        </button>

    </form>

</div>