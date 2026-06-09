<div class="sidebar">

    <h2 class="logo">

        Medical

    </h2>

    <ul class="menu">

        <li>

            <a href="/dashboard">

                Dashboard

            </a>

        </li>

        <?php if($_SESSION['rol'] === 'admin'): ?>

            <li>

                <a href="/pacientes">

                    Pacientes

                </a>

            </li>

            <li>

                <a href="/citas">

                    Citas

                </a>

            </li>

            <li>

                <a href="/usuarios">

                    Usuarios

                </a>

            </li>

        <?php else: ?>

            <li>

                <a href="/mi-perfil">

                    Mi Perfil

                </a>

            </li>

            <li>

                <a href="/mis-citas">

                    Mis Citas

                </a>

            </li>

        <?php endif; ?>

        <li>

            <a href="/chat">

                Chat

            </a>

        </li>

        <li>

            <a
                href="/logout"
                class="menu-item logout-btn"
            >

                Cerrar Sesión

            </a>

        </li>

    </ul>

</div>