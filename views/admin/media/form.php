<script language=javascript>
function submitPostLink()
{    
    document.postlink.submit();
}
</script>

<h1><?= $params['media']->name ?? 'Créer un nouveau media' ?></h1>

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
<form method="POST" name="postlink" action="<?= isset($params['media']) ? HREF_ROOT."admin/media/edit/{$params['media']->id}" :  "../../admin/tags/create" ?>" >
    <div class="form-group">
        <label for="title">Nom</label>
        <input type="text" class="form-control" name="name_media" id="name_media" value="<?= $params['media']->name ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="title">Text</label>
        <input type="text" class="form-control" name="alt_text" id="alt_text" value="<?= $params['media']->name ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="title">Nom du fichier</label>
        <input type="text" class="form-control" name="filename_media" id="filename_media" value="<?= $params['media']->name ?? '' ?>">
    </div>
    <button type="submit"  class="btn btn-primary"><?= isset($params['media']) ? "Enregistrer les modifications" : "Enregistrer mon media" ?></button>
    
</form>