<h1>Editar Paciente</h1>

<div class="patient-form">

    <form action="/pacientes/actualizar" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $paciente['id'] ?>"
        >

        <div class="form-grid">

            <div class="form-group">

                <label>Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    value="<?= $paciente['nombre'] ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Edad</label>

                <input
                    type="number"
                    name="edad"
                    value="<?= $paciente['edad'] ?>"
                    required
                >

            </div>

            <div class="form-group">

                <label>Teléfono</label>

                <input
                    type="text"
                    name="telefono"
                    value="<?= $paciente['telefono'] ?>"
                >

            </div>

            <div class="form-group">

                <label>Correo</label>

                <input
                    type="email"
                    name="correo"
                    value="<?= $paciente['correo'] ?>"
                >

            </div>

        </div>

        <button class="btn-primary">
            Actualizar Paciente
        </button>

    </form>

</div>