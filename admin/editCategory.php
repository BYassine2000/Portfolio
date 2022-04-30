<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_cat = $_GET['edit'];
    $category = $bdd->prepare("SELECT * FROM vCategory WHERE id_cat = :id_cat");
    $category->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
    $category->execute();
    if ($category->rowCount() == 1) {
        $category = $category->fetch();
    }
} else {
    header('Location: category');
}

if (isset($_POST['modifier'])) {
    $id_cat = $_GET['edit'];
    $title = $_POST['title'];
    $id_f = $_POST['id_f'];
    if ($title != "" && $id_f != "") {
        $update = $bdd->prepare("UPDATE category SET title = :title, id_f = :id_f WHERE id_cat = :id_cat");
        $update->bindValue(':title', $title, PDO::PARAM_STR);
        $update->bindValue(':id_f', $id_f, PDO::PARAM_INT);
        $update->bindValue(':id_cat', $id_cat, PDO::PARAM_INT);
        $update->execute();
        header('Location: category');
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
                <a href="category" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier une catégorie</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <input type="text" name="title" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $category['title']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <select name="id_f" class="form-select">
                                <?php
                                $query = $bdd->query("SELECT * FROM filters");
                                $filters = $query->fetchAll();
                                foreach ($filters as $filter) {
                                    ?>
                                    <option value="<?= $filter['id_f']; ?>"><?= $filter['libelle']; ?></option>
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
