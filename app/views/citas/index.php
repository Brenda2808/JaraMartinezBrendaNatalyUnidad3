<div class="page-header">

    <h1>Citas Médicas</h1>

</div>

<div class="patient-form">

    <form id="formCita">

        <div class="form-grid">

            <div class="form-group">

                <label>Paciente</label>

                <select name="paciente_id" required>

                    <option value="">
                        Selecciona paciente
                    </option>

                    <?php foreach($pacientes as $paciente): ?>

                        <option value="<?= $paciente['id'] ?>">

                            <?= $paciente['nombre'] ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label>Fecha</label>

                <input
                    type="date"
                    name="fecha"
                    required
                >

            </div>

            <div class="form-group">

                <label>Hora</label>

                <input
                    type="time"
                    name="hora"
                    required
                >

            </div>

            <div class="form-group">

                <label>Motivo</label>

                <textarea
                    name="motivo"
                    placeholder="Motivo de consulta"
                ></textarea>

            </div>

        </div>

        <button type="submit" class="btn-primary">

            Registrar Cita

        </button>

    </form>

</div>

<div class="table-container">

    <table class="patient-table">

        <thead>

            <tr>

                <th>ID</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody id="tablaCitas">

            <?php foreach($citas as $cita): ?>

                <tr>

                    <td><?= $cita['id'] ?></td>

                    <td>
                        <?= $cita['paciente_nombre'] ?>
                    </td>

                    <td><?= $cita['fecha'] ?></td>

                    <td><?= $cita['hora'] ?></td>

                    <td><?= $cita['motivo'] ?></td>

                    <td><?= $cita['estado'] ?></td>

                    <td>

                        <?php if($cita['estado'] == 'Pendiente'): ?>

                            <button
                                class="btn-edit"
                                onclick="aprobarCita(
                                    <?= $cita['id'] ?>
                                )"
                            >
                                Aprobar
                            </button>

                            <button
                                class="btn-delete"
                                onclick="rechazarCita(
                                    <?= $cita['id'] ?>
                                )"
                            >
                                Rechazar
                            </button>

                        <?php else: ?>

                            <span>
                                Sin acciones
                            </span>

                        <?php endif; ?>

                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<script>

const formCita =
document.getElementById('formCita');

formCita.addEventListener('submit', async (e) => {

    e.preventDefault();

    const formData = new FormData(formCita);

    try{

        const response = await fetch(
            '/citas/guardar',
            {
                method: 'POST',
                body: formData
            }
        );

        const data = await response.json();
if(data.success){

    toastr.success(data.message);

    const cita = data.cita;

    const pacienteSelect =
    formCita.querySelector(
        'select[name="paciente_id"]'
    );

    const pacienteNombre =
    pacienteSelect.options[
        pacienteSelect.selectedIndex
    ].text;

    const totalFilas =
    document.querySelectorAll(
        '#tablaCitas tr'
    ).length;

    const nuevaFila = `
    
        <tr>

            <td>${totalFilas + 1}</td>

            <td>${pacienteNombre}</td>

            <td>${cita.fecha}</td>

            <td>${cita.hora}</td>

            <td>${cita.motivo}</td>

            <td>${cita.estado}</td>

        </tr>
    `;

    document
    .getElementById('tablaCitas')
    .insertAdjacentHTML(
        'beforeend',
        nuevaFila
    );

    formCita.reset();

}else{

    toastr.error(data.message);
}

    }catch(error){

        console.log(error);

        toastr.error('Error AJAX');
    }

});


function aprobarCita(id){

    Swal.fire({

        title: '¿Aprobar cita?',
        text: 'La cita será aprobada',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, aprobar',
        cancelButtonText: 'Cancelar'

    }).then((result) => {

        if(result.isConfirmed){

            window.location.href =
            '/citas/aprobar?id=' + id;
        }
    });
}

function rechazarCita(id){

    Swal.fire({

        title: '¿Rechazar cita?',
        text: 'La cita será rechazada',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, rechazar',
        cancelButtonText: 'Cancelar'

    }).then((result) => {

        if(result.isConfirmed){

            window.location.href =
            '/citas/rechazar?id=' + id;
        }
    });
}

</script>