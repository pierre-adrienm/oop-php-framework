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
                <th scope="row"><?= $media->id ?></th>
                <td><?= $media->title ?></td>
                <td><?= $media->getCreatedAt() ?></td>
                <td>
                    <a href="<?= HREF_ROOT ?>admin/media/edit/<?= $media->id ?>" class="btn btn-warning">Modifier</a>
                    <form action="<?= HREF_ROOT ?>admin/media/delete/<?= $media->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
