<?php auth(1);

if (!isset($_SESSION['id_u'])) {
    header('Location: https://YassineBenHamdoune.fr/admin-panel');
    exit();
}

$images = $bdd->query("SELECT * FROM vImages ORDER BY id_p DESC");

if (isset($_POST['subaddimage'])) {
    $chemin = $_POST['chemin'];
    $extensions = array('jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG');
    $img1 = $_FILES['img1'];
    $id_p = $_POST['id_p'];
    $extension = pathinfo($img1['name'], PATHINFO_EXTENSION);
    if (in_array($extension, $extensions)) {
        $bdd->query("INSERT INTO images (id_p) VALUES ($id_p)");
        $image_id = $bdd->lastInsertId();
        $image_name = $image_id.".".$extension;
        move_uploaded_file($img1['tmp_name'], "assets/img/projects/".$image_name."");
        $bdd->query("UPDATE images SET nom = '$image_name', chemin = '$chemin', id_p = '$id_p' WHERE id_img = ".$image_id);
        header('Location: images');
    }
}

if (isset($_GET['id_img'])) {
    $id_img = $_GET['id_img'];
    $delete = $bdd->prepare("DELETE FROM images WHERE id_img = :id_img");
    $delete->bindValue(':id_img', $id_img, PDO::PARAM_INT);
    $delete->execute();
    header('Location: images');
}

require 'css_files.php';

?>
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-12 mt-5">
            <?= Alerts::getFlash(); ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Mes images</h3>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_image">
                        + Ajouter une image
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titre de l'image</th>
                            <th scope="col">Projet</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($images as $image) { ?>
                            <tr>
                                <td><?= $image['id_img']; ?></td>
                                <td><?= $image['nom']; ?></td>
                                <td><?= $image['id_p']; ?></td>
                                <td>
                                    <a href="editImage?edit=<?= $image['id_img']; ?>" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger font-weight-bolder" href="images&id_img=<?= $image['id_img']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cette image ?'));">
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

<div class="modal fade" id="modal_image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <?= $helper->input('img1', 'Image', 'file'); ?>
                    <div class="form-group mb-3">
                        <label for="chemin" class="form-label">Chemin d'accès de l'image</label>
                        <input type="text" name="chemin" id="chemin" class="form-control" value="assets/img/projects/" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="id_p" class="form-label">Projet</label>
                        <select name="id_p" id="id_p" class="form-select">
                            <?php
                            $query = $bdd->query("SELECT * FROM projects");
                            $projects = $query->fetchAll();
                            foreach ($projects as $project) {
                                ?>
                                <option value="<?= $project['id_p']; ?>"><?= $project['title']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <?= $helper->button('submit', 'subaddimage', 'success', 'Ajouter l\'image'); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'js_files.php'; ?>
