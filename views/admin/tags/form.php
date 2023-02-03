<script language=javascript>
function submitPostLink()
{    
    document.postlink.submit();
}
</script>

<h1><?= $params['tags']->title ?? 'Créer un nouvel tags' ?></h1>

<?php 
// var_dump($_REQUEST);
// $_REQUEST['url'] = "http://localhost/".$_REQUEST['url'];
// var_dump($_REQUEST);
?>

<form method="POST" name="postlink" action="<?= isset($params['tags']) ? HREF_ROOT."admin/posts/edit/{$params['tags']->id}" :  "../../admin/tags/create" ?>" >
    <div class="form-group">
        <label for="title">Titre de l'article</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $params['tags']->title ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="content">Contenu de l'article</label>
        <textarea name="content" id="content" rows="8" class="form-control"><?= $params['tags']->content ?? '' ?></textarea>
    </div>

    
    <button type="submit"  class="btn btn-primary"><?= isset($params['tags']) ? "Enregistrer les modifications" : "Enregistrer mon article" ?></button>
    
    </form>