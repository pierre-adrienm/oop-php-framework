<script language=javascript>
function submitPostLink()
{    
    document.postlink.submit();
}
</script>

<h1><?= $params['medias']->name_media ?? 'Créer un nouveau media' ?></h1>

<?php 
// var_dump($_REQUEST);
// $_REQUEST['url'] = "http://localhost/".$_REQUEST['url'];
// var_dump($_REQUEST);
?>
<?php
// echo "<pre>";
// var_dump("POST:",$_POST, "</br>");
// var_dump($params);
// echo "</pre>";
?>
<form method="POST" name="postlink" action="<?= isset($params['medias']) ? HREF_ROOT."admin/medias/edit/{$params['medias']->id}" :  "../../admin/medias/create" ?>" >
    <div class="form-group">
        <label for="title">Nom</label>
        <input type="text" class="form-control" name="name_media" id="name_media" value="<?= $params['medias']->name_media ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="title">Text</label>
        <input type="text" class="form-control" name="alt_text" id="alt_text" value="<?= $params['medias']->alt_text ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="title">Nom du fichier</label>
        <input type="text" class="form-control" name="filename_media" id="filename_media" value="<?= $params['medias']->filename_media ?? '' ?>">
    </div>
    <button type="submit"  class="btn btn-primary"><?= isset($params['media']) ? "Enregistrer les modifications" : "Enregistrer mon media" ?></button>
    
</form>