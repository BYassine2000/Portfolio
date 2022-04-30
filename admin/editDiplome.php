<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_d = $_GET['edit'];
    $diplome = $bdd->prepare("SELECT * FROM diplomes WHERE id_d = :id_d");
    $diplome->bindValue(':id_d', $id_d, PDO::PARAM_INT);
    $diplome->execute();
    if ($diplome->rowCount() == 1) {
        $diplome = $diplome->fetch();
    }
} else {
    header('Location: diplomes');
}

if (isset($_POST['modifier'])) {
    $id_d = $_GET['edit'];
    $libelle_d = $_POST['libelle_d'];
    $date_d = $_POST['date_d'];
    $id_school = $_POST['id_school'];
    if ($libelle_d != "" && $date_d != "") {
        $update = $bdd->prepare("UPDATE diplomes SET libelle_d = :libelle_d, date_d = :date_d, id_school = :id_school WHERE id_d = :id_d");
        $update->bindValue(':libelle_d', $libelle_d, PDO::PARAM_STR);
        $update->bindValue(':date_d', $date_d, PDO::PARAM_STR);
        $update->bindValue(':id_school', $id_school, PDO::PARAM_INT);
        $update->bindValue(':id_d', $id_d, PDO::PARAM_INT);
        $update->execute();
        header('Location: diplomes');
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
                <a href="diplomes" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier un diplôme</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="text" name="libelle_d" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $diplome['libelle_d']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="date" name="date_d" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $diplome['date_d']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <select name="id_school" class="form-select">
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
