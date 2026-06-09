<?php if($_SESSION['rol'] === 'admin'): ?>

    <h1>Panel Administrativo</h1>

    <div class="stats-grid">

        <div class="stat-card">

            <h3>Total Pacientes</h3>

            <p><?= $totalPacientes ?></p>

        </div>

        <div class="stat-card">

            <h3>Total Usuarios</h3>

            <p><?= $totalUsuarios ?></p>

        </div>

        <div class="stat-card">

            <h3>Citas Pendientes</h3>

            <p>0</p>

        </div>

    </div>

<?php else: ?>

    <h1>

        Bienvenido
        <?= $_SESSION['usuario'] ?>

    </h1>

    <div class="stats-grid">

        <div class="stat-card">

            <h3>Mis Citas</h3>

            <p>0</p>

        </div>

        <div class="stat-card">

            <h3>Estado</h3>

            <p>Sin citas</p>

        </div>

    </div>

<?php endif; ?>