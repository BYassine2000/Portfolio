<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_w = $_GET['edit'];
    $work = $bdd->prepare("SELECT * FROM works WHERE id_w = :id_w");
    $work->bindValue(':id_w', $id_w, PDO::PARAM_INT);
    $work->execute();
    if ($work->rowCount() == 1) {
        $work = $work->fetch();
    }
} else {
    header('Location: works');
}

if (isset($_POST['modifier'])) {
    $id_w = $_GET['edit'];
    $libelle_w = $_POST['libelle_w'];
    $id_comp = $_POST['id_comp'];
    if ($libelle_w != "") {
        $update = $bdd->prepare("UPDATE works SET libelle_w = :libelle_w, id_comp = :id_comp WHERE id_w = :id_w");
        $update->bindValue(':libelle_w', $libelle_w, PDO::PARAM_STR);
        $update->bindValue(':id_comp', $id_comp, PDO::PARAM_INT);
        $update->bindValue(':id_w', $id_w, PDO::PARAM_INT);
        $update->execute();
        header('Location: works');
    } else {
        Alerts::setFlash("Les champs ne doivent pas être vides !","warning");
    }
}

require 'css_files.php';

?>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-4 mt-5 mt-lg-0">
            <?= Alerts::getFlash(); ?>
            <div class="d-flex justify-content-center mb-3">
                <a href="projects" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier un projet</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="text" name="libelle_w" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $work['libelle_w']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <select name="id_comp" class="form-select">
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
                                <?= $helper->button('submit', 'modifier', 'primary', 'Valider'); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'js_files.php'; ?>
