<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$skills = $bdd->query("SELECT * FROM skills ORDER BY id_s DESC");

$mode_edition = 0;

if (isset($_POST['submit'])) {
    $libelle = $_POST['libelle'];
    $lvl = $_POST['lvl'];
    if ($libelle != "" && $lvl != "") {
        $check_libelle_exists = $bdd->prepare("SELECT libelle FROM skills WHERE libelle = :libelle");
        $check_libelle_exists->bindValue(':libelle', $libelle, PDO::PARAM_STR);
        $check_libelle_exists->execute();
        $check_libelle_exists = $check_libelle_exists->fetch();
        if (!$check_libelle_exists) {
            if ($lvl <= 100) {
                $insert = $bdd->prepare("INSERT INTO skills (libelle, lvl) VALUES (:libelle, :lvl)");
                $insert->bindValue(':libelle', $libelle, PDO::PARAM_STR);
                $insert->bindValue(':lvl', $lvl, PDO::PARAM_INT);
                $insert->execute();
                header('Location: skills');
            } else {
                Alerts::setFlash("Votre niveau ne doit pas dépassé 100", "danger");
            }
        } else {
            Alerts::setFlash("Cette compétence est déjà enregistrée", "danger");
        }
    } else {
        Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
    }
}

if (isset($_GET['id_s'])) {
    $id_s = $_GET['id_s'];
    $delete = $bdd->prepare("DELETE FROM skills WHERE id_s = :id_s");
    $delete->bindValue(':id_s', $id_s, PDO::PARAM_INT);
    $delete->execute();
    header('Location: skills');
}

require 'css_files.php';

?>
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Compétences</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_skill">
                        + Ajouter une compétence
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Compétence</th>
                            <th scope="col">Niveau</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($skills as $skill) { ?>
                            <tr>
                                <td><?= $skill['id_s']; ?></td>
                                <td><?= $skill['libelle']; ?></td>
                                <td><?= $skill['lvl']; ?> %</td>
                                <td>
                                    <a href="editSkill?edit=<?= $skill['id_s']; ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger font-weight-bolder" href="skills&id_s=<?= $skill['id_s']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cette compétence ?'));">
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

<div class="modal fade" id="modal_skill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une compétence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= $helper->input('libelle', 'Libellé', 'text'); ?>
                    <?= $helper->input('lvl', 'Niveau / 100', 'number'); ?>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $helper->button('submit', 'submit', 'success', 'Ajouter la catégorie'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
