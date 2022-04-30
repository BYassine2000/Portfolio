<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$mode_edition = 0;

if (isset($_GET['edit'])) {
    $mode_edition = 1;
    $id_img = $_GET['edit'];
    $image = $bdd->prepare("SELECT * FROM images WHERE id_img = :id_img");
    $image->bindValue(':id_img', $id_img, PDO::PARAM_INT);
    $image->execute();
    if ($image->rowCount() == 1) {
        $image = $image->fetch();
    }
} else {
    header('Location: images');
}

if (isset($_POST['modifier'])) {
    $chemin = $_POST['chemin'];
    $extensions = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG');
    $img1 = $_FILES['img1'];
    $id_p = $_POST['id_p'];
    $extension = pathinfo($img1['name'], PATHINFO_EXTENSION);
    if (in_array($extension, $extensions)) {
        $bdd->query("UPDATE images SET id = '$id_p'");
        $image_id = $bdd->lastInsertId();
        $image_name = $image_id.".".$extension;
        move_uploaded_file($img1['tmp_name'], "assets/img/projects/".$image_name."");
        $bdd->query("UPDATE images SET nom = '$image_name', chemin = '$chemin', id_p = '$id_p' WHERE id_img = ".$image_id);
        header('Location: images');
    }
}

require 'css_files.php';

?>

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-4 mt-5 mt-lg-0">
            <?= Alerts::getFlash(); ?>
            <div class="d-flex justify-content-center mb-3">
                <a href="images" class="btn btn-lg btn-secondary">Retour</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Modifier une image</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <input type="file" name="img1" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $image['nom']; ?>" <?php } ?>>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="chemin" class="form-control" <?php if ($mode_edition == 1) { ?> value="<?= $image['chemin']; ?>" <?php } ?>>
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
