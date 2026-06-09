<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Médico</title>

    <link rel="stylesheet" href="http://medical_system.test/public/css/style.css">
</head>
<body>

    <div class="dashboard-container">

        <?php require_once 'app/views/partials/sidebar.php'; ?>

        <div class="main-content">

            <?php require_once 'app/views/partials/navbar.php'; ?>

            <div class="content">

                <?php require_once $view; ?>

            </div>

        </div>

    </div>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php if(isset($_SESSION['success'])): ?>

<script>

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000"
};

toastr.success("<?= $_SESSION['success'] ?>");
</script>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>

<?php if(isset($_SESSION['success'])): ?>

<script>

toastr.success(
    '<?= $_SESSION['success'] ?>'
);

</script>

<?php unset($_SESSION['success']); ?>

<?php endif; ?>


<?php if(isset($_SESSION['error'])): ?>

<script>

toastr.error(
    '<?= $_SESSION['error'] ?>'
);

</script>

<?php unset($_SESSION['error']); ?>

<?php endif; ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>