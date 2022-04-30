<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$diplomes = $bdd->query("SELECT * FROM vSchools ORDER BY id_d DESC");

$mode_edition = 0;

if (isset($_POST['submit'])) {
    $libelle_d = $_POST['libelle_d'];
    $date_d = $_POST['date_d'];
    $id_school = $_POST['id_school'];
    if ($libelle_d != "" && $date_d != "") {
        $insert = $bdd->prepare("INSERT INTO diplomes (libelle_d, date_d, id_school) VALUES (:libelle_d, :date_d, :id_school)");
        $insert->bindValue(':libelle_d', $libelle_d, PDO::PARAM_STR);
        $insert->bindValue(':date_d', $date_d, PDO::PARAM_STR);
        $insert->bindValue(':id_school', $id_school, PDO::PARAM_INT);
        $insert->execute();
        header('Location: diplomes');
    } else {
        Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
    }
}

if (isset($_GET['id_d'])) {
    $id_d = $_GET['id_d'];
    $delete = $bdd->prepare("DELETE FROM diplomes WHERE id_d = :id_d");
    $delete->bindValue(':id_d', $id_d, PDO::PARAM_INT);
    $delete->execute();
    header('Location: diplomes');
}

require 'css_files.php';

?>
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Mes diplômes</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_diplome">
                        + Ajouter un diplôme
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom du diplôme</th>
                            <th scope="col">Date d'obtention</th>
                            <th scope="col">Établissement</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($diplomes as $diplome) { ?>
                            <tr>
                                <td><?= $diplome['id_d']; ?></td>
                                <td><?= $diplome['libelle_d']; ?></td>
                                <td><?= $diplome['date_d']; ?></td>
                                <td><?= $diplome['id_school']; ?></td>
                                <td>
                                    <a href="editDiplome?edit=<?= $diplome['id_d']; ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger font-weight-bolder" href="diplomes&id_d=<?= $diplome['id_d']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce diplôme ?'));">
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

<div class="modal fade" id="modal_diplome" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un diplôme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= $helper->input('libelle_d', 'Nom du diplôme', 'text'); ?>
                    <?= $helper->input('date_d', 'Date d\'obtention', 'date') ?>
                    <div class="form-group mb-3">
                        <label for="id_school" class="form-label">Établissement</label>
                        <select name="id_school" id="id_school" class="form-select">
                            <?php
                            $query = $bdd->query("SELECT * FROM schools");
                            $schools = $query->fetchAll();
                            foreach ($schools as $school) {
                                ?>
                                <option value="<?= $school['id_school']; ?>"><?= $school['school_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $helper->button('submit', 'submit', 'success', 'Ajouter le diplôme'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
