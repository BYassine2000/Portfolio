<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_f = $_GET['edit'];
    $filter = $bdd->prepare("SELECT * FROM filters WHERE id_f = :id_f");
    $filter->bindValue(':id_f', $id_f, PDO::PARAM_INT);
    $filter->execute();
    if ($filter->rowCount() == 1) {
        $filter = $filter->fetch();
    }
} else {
    header('Location: filters');
}

if (isset($_POST['modifier'])) {
    $id_f = $_GET['edit'];
    $libelle = $_POST['libelle'];
    if ($libelle != "") {
        $update = $bdd->prepare("UPDATE filters SET libelle = :libelle WHERE id_f = :id_f");
        $update->bindValue(':libelle', $libelle, PDO::PARAM_STR);
        $update->bindValue(':id_f', $id_f, PDO::PARAM_STR);
        $update->execute();
        header('Location: filters');
    } else {
        Alerts::setFlash("Le champ ne doit pas être vides !","warning");
    }
}

require 'css_files.php';

?>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-4 mt-5 mt-lg-0">
            <?= Alerts::getFlash(); ?>
            <div class="d-flex justify-content-center mb-3">
                <a href="filters" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier un filtre</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="text" name="libelle" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $filter['libelle']; ?>" <?php } ?>>
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
