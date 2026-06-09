<h1 class="dashboard-title">

    Mis Citas

</h1>

<div class="patient-form">

    <form
        action="/mis-citas/guardar"
        method="POST"
    >

        <div class="form-grid">

            <div class="form-group">

                <label>Especialidad</label>

                <select
                    name="especialidad"
                    required
                >

                    <option value="">
                        Selecciona
                    </option>

                    <option value="Medicina General">
                        Medicina General
                    </option>

                    <option value="Cardiología">
                        Cardiología
                    </option>

                    <option value="Nutrición">
                        Nutrición
                    </option>

                    <option value="Psicología">
                        Psicología
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Motivo</label>

                <textarea
                    name="motivo"
                    required
                ></textarea>

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

        </div>

        <button class="btn-primary">

            Registrar Cita

        </button>

    </form>

</div>

<div class="table-container">

    <table class="patient-table">

        <thead>

            <tr>

                <th>ID</th>
                <th>Especialidad</th>
                <th>Motivo</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach($citas as $cita): ?>

                <tr>

                    <td><?= $cita['id'] ?></td>

                    <td>
                        <?= $cita['especialidad'] ?>
                    </td>

                    <td>
                        <?= $cita['motivo'] ?>
                    </td>

                    <td>
                        <?= $cita['fecha'] ?>
                    </td>

                    <td>
                        <?= $cita['hora'] ?>
                    </td>

                    <td>

                        <?php if($cita['estado'] == 'Pendiente'): ?>

                            <span class="badge-warning">
                                Pendiente
                            </span>

                        <?php elseif($cita['estado'] == 'Aprobada'): ?>

                            <span class="badge-success">
                                Aprobada
                            </span>

                        <?php else: ?>

                            <span class="badge-danger">
                                Rechazada
                            </span>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>