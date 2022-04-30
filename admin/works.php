<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$works = $bdd->query("SELECT * FROM vWorks ORDER BY id_w DESC");

$mode_edition = 0;

if (isset($_POST['submit'])) {
    $libelle_w = $_POST['libelle_w'];
    $id_comp = $_POST['id_comp'];
    if ($libelle_w != "") {
        $insert = $bdd->prepare("INSERT INTO works (libelle_w, id_comp) VALUES (:libelle_w, :id_comp)");
        $insert->bindValue(':libelle_w', $libelle_w, PDO::PARAM_STR);
        $insert->bindValue(':id_comp', $id_comp, PDO::PARAM_INT);
        $insert->execute();
        header('Location: works');
    } else {
        Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
    }
}

if (isset($_GET['id_w'])) {
    $id_w = $_GET['id_w'];
    $delete = $bdd->prepare("DELETE FROM works WHERE id_w = :id_w");
    $delete->bindValue(':id_w', $id_w, PDO::PARAM_INT);
    $delete->execute();
    header('Location: works');
}

require 'css_files.php';

?>
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Projets réalisés</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_work">
                        + Ajouter un projet
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom du projet</th>
                            <th scope="col">Entreprise</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($works as $work) { ?>
                            <tr>
                                <td><?= $work['id_w']; ?></td>
                                <td><?= $work['libelle_w']; ?></td>
                                <td><?= $work['id_comp']; ?></td>
                                <td>
                                    <a href="editWork?edit=<?= $work['id_w']; ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger font-weight-bolder" href="works&id_w=<?= $work['id_w']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce projet ?'));">
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

<div class="modal fade" id="modal_work" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un projet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= $helper->input('libelle_w', 'Nom du projet', 'text'); ?>
                    <div class="form-group mb-3">
                        <label for="id_comp" class="form-label">Entreprise</label>
                        <select name="id_comp" id="id_comp" class="form-select">
                            <?php
                            $query = $bdd->query("SELECT * FROM company");
                            $company = $query->fetchAll();
                            foreach ($company as $comp) {
                                ?>
                                <option value="<?= $comp['id_comp']; ?>"><?= $comp['company_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $helper->button('submit', 'submit', 'success', 'Ajouter le projet'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
