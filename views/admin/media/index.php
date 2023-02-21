<h1>Administration des media</h1>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous êtes connecté!</div>
<?php endif ?>

<a href="<?= HREF_ROOT ?>admin/media/create" class="btn btn-success my-3">Créer un nouveau media</a>
<a href="<?= HREF_ROOT ?>admin/posts" class="btn btn-success my-3">Administation des Articles</a>
<a href="<?= HREF_ROOT ?>admin/tags" class="btn btn-success my-3">Administation des tags</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Texte</th>
            <th scope="col">Nom du fichier</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($params['media'] as $media) : ?>
            <tr>
                <th scope="row"><?= $media->med_id ?></th>
                <td><?= $media->name_media ?></td>
                <td><?= $media->alt_text ?></td>
                <td><?= $media->filename_media ?></td>
                <td>
                    <a href="<?= HREF_ROOT ?>admin/media/edit/<?= $media->med_id ?>" class="btn btn-warning">Modifier</a>
                    <form action="<?= HREF_ROOT ?>admin/media/delete/<?= $media->med_id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
