<h1 class="dashboard-title">

    Usuarios Registrados

</h1>

<div class="table-container">

    <table class="patient-table">

        <thead>

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach($usuarios as $usuario): ?>

                <tr>

                    <td>
                        <?= $usuario['id'] ?>
                    </td>

                    <td>
                        <?= $usuario['nombre'] ?>
                    </td>

                    <td>
                        <?= $usuario['correo'] ?>
                    </td>

                    <td>
                        <?= $usuario['rol'] ?>
                    </td>

                    <td>

                        <a
                            href="/usuarios/editar?id=<?= $usuario['id'] ?>"
                            class="btn-edit"
                        >

                            Editar

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>