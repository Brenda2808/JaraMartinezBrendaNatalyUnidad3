<div class="page-header">

    <h1>Pacientes</h1>

</div>

<div class="patient-form">

    <form id="formPaciente" action="/pacientes/guardar" method="POST">

        <div class="form-grid">

            <div class="form-group">

                <label>Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    placeholder="Ingresa nombre"
                    required
                >

            </div>

            <div class="form-group">

                <label>Edad</label>

                <input
                    type="number"
                    name="edad"
                    placeholder="Edad"
                    required
                >

            </div>

            <div class="form-group">

                <label>Teléfono</label>

                <input
                    type="text"
                    name="telefono"
                    placeholder="Teléfono"
                >

            </div>

            <div class="form-group">

                <label>Correo</label>

                <input
                    type="email"
                    name="correo"
                    placeholder="Correo"
                >

            </div>

        </div>

        <button type="submit" class="btn-primary">
            Guardar Paciente
        </button>

    </form>

</div>

<div class="search-box">

    <input
        type="text"
        id="buscadorPaciente"
        placeholder="🔍 Buscar paciente..."
    >

</div>

<div class="table-container">

    <table class="patient-table">

        <thead>

            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody id="tablaPacientes">

            <?php foreach($pacientes as $paciente): ?>

                <tr>

                    <td><?= $paciente['id'] ?></td>
                    <td><?= $paciente['nombre'] ?></td>
                    <td><?= $paciente['edad'] ?></td>
                    <td><?= $paciente['telefono'] ?></td>
                    <td><?= $paciente['correo'] ?></td>

                    <td>

                        <a 
                            href="/pacientes/editar?id=<?= $paciente['id'] ?>"
                            class="btn-edit"
                        >
                            Editar
                        </a>

                        <a 
                            href="/pacientes/eliminar?id=<?= $paciente['id'] ?>"
                            class="btn-delete"
                            onclick="confirmarEliminacion(event, <?= $paciente['id'] ?>)"
                        >
                            Eliminar
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <div class="pagination" id="pagination"></div>

</div>

<script>

function confirmarEliminacion(event, id){

    event.preventDefault();

    Swal.fire({
        title: '¿Eliminar paciente?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if(result.isConfirmed){

            window.location.href =
            '/pacientes/eliminar?id=' + id;
        }

    });

}

let ultimoId =
document.querySelectorAll('#tablaPacientes tr').length;

const formPaciente =
document.getElementById('formPaciente');

formPaciente.addEventListener('submit', async (e) => {

    e.preventDefault();

    const formData = new FormData(formPaciente);

    try{

        const response = await fetch(
            '/pacientes/guardar',
            {
                method: 'POST',
                body: formData
            }
        );

        const data = await response.json();

        if(data.success){

            toastr.success(data.message);

            ultimoId++;

            const paciente = data.paciente;

            const nuevaFila = `
            
                <tr>

                    <td>${ultimoId}</td>
                    <td>${paciente.nombre}</td>
                    <td>${paciente.edad}</td>
                    <td>${paciente.telefono}</td>
                    <td>${paciente.correo}</td>

                    <td>

                        <?php if($_SESSION['rol'] === 'admin'): ?>

                            <a 
                                href="/pacientes/editar?id=<?= $paciente['id'] ?>"
                                class="btn-edit"
                            >
                                Editar
                            </a>

                            <a 
                                href="/pacientes/eliminar?id=<?= $paciente['id'] ?>"
                                class="btn-delete"
                                onclick="confirmarEliminacion(event, <?= $paciente['id'] ?>)"
                            >
                                Eliminar
                            </a>

                        <?php else: ?>

                            <span>
                                Sin permisos
                            </span>

                        <?php endif; ?>

                    </td>

                </tr>
            `;

            document
            .getElementById('tablaPacientes')
            .insertAdjacentHTML(
                'beforeend',
                nuevaFila
            );

            formPaciente.reset();

        }else{

            toastr.error(data.message);
        }

    }catch(error){

        console.log(error);

        toastr.error('Error AJAX');
    }

});

const buscador =
document.getElementById('buscadorPaciente');

buscador.addEventListener('keyup', () => {

    const texto =
    buscador.value.toLowerCase();

    const filas =
    document.querySelectorAll(
        '#tablaPacientes tr'
    );

    filas.forEach((fila) => {

        const contenido =
        fila.textContent.toLowerCase();

        if(contenido.includes(texto)){

            fila.style.display = '';

        }else{

            fila.style.display = 'none';
        }

    });

});

const filasPorPagina = 5;

const filasTabla =
Array.from(
    document.querySelectorAll(
        '#tablaPacientes tr'
    )
);

const pagination =
document.getElementById('pagination');

let paginaActual = 1;

function mostrarPagina(pagina){

    paginaActual = pagina;

    const inicio =
    (pagina - 1) * filasPorPagina;

    const fin =
    inicio + filasPorPagina;

    filasTabla.forEach((fila, index) => {

        if(index >= inicio && index < fin){

            fila.style.display = '';

        }else{

            fila.style.display = 'none';
        }

    });

    renderizarBotones();
}

function renderizarBotones(){

    pagination.innerHTML = '';

    const totalPaginas =
    Math.ceil(
        filasTabla.length / filasPorPagina
    );

    for(
        let i = 1;
        i <= totalPaginas;
        i++
    ){

        const boton =
        document.createElement('button');

        boton.innerText = i;

        boton.classList.add('page-btn');

        if(i === paginaActual){

            boton.classList.add('active-page');
        }

        boton.addEventListener('click', () => {

            mostrarPagina(i);

        });

        pagination.appendChild(boton);
    }
}

mostrarPagina(1);

</script>