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

<form method="POST" name="postlink" action="<?= isset($params['post']) ? HREF_ROOT."admin/tags/edit/{$params['post']->id}" :  "../../admin/tags/create" ?>" >
    <div class="form-group">
        <label for="title">Nom</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $params['post']->name ?? '' ?>">
    </div>
    
    <button type="submit"  class="btn btn-primary"><?= isset($params['post']) ? "Enregistrer les modifications" : "Enregistrer mon article" ?></button>
    
    </form>