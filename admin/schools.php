<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$schools = $bdd->query("SELECT * FROM schools ORDER BY id_school DESC");

$mode_edition = 0;

if (isset($_POST['submit'])) {
    $school_name = $_POST['school_name'];
    $school_address = $_POST['school_address'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if ($school_name != "" && $school_address != "" && $start_date != "" && $end_date != "") {
        $insert = $bdd->prepare("INSERT INTO schools (school_name, school_address, start_date, end_date) VALUES (:school_name, :school_address, :start_date, :end_date)");
        $insert->bindValue(':school_name', $school_name, PDO::PARAM_STR);
        $insert->bindValue(':school_address', $school_address, PDO::PARAM_STR);
        $insert->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $insert->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $insert->execute();
        header('Location: schools');
    } else {
        Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
    }
}

if (isset($_GET['id_school'])) {
    $id_school = $_GET['id_school'];
    $delete = $bdd->prepare("DELETE FROM schools WHERE id_school = :id_school");
    $delete->bindValue(':id_school', $id_school, PDO::PARAM_INT);
    $delete->execute();
    header('Location: schools');
}

require 'css_files.php';

?>
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Établissements scolaire</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_school">
                        + Ajouter un établissement
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom de l'établissement</th>
                            <th scope="col">Adresse de l'établissement</th>
                            <th scope="col">Date début</th>
                            <th scope="col">Date fin</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($schools as $school) { ?>
                            <tr>
                                <td><?= $school['id_school']; ?></td>
                                <td><?= $school['school_name']; ?></td>
                                <td><?= $school['school_address']; ?></td>
                                <td><?= $school['start_date']; ?></td>
                                <td><?= $school['end_date']; ?></td>
                                <td>
                                    <a href="editSchool?edit=<?= $school['id_school']; ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger font-weight-bolder" href="schools&id_school=<?= $school['id_school']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cet établissement ?'));">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_school" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un établissement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= $helper->input('school_name', 'Nom de l\'établissement', 'text'); ?>
                    <?= $helper->input('school_address', 'Adresse de l\'établissement', 'text'); ?>
                    <?= $helper->input('start_date', 'Date début', 'date'); ?>
                    <?= $helper->input('end_date', 'Date fin', 'date'); ?>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $helper->button('submit', 'submit', 'success', 'Ajouter l\'établissement'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
