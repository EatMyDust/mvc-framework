<h1>Modify section</h1>
<form method="POST">
    <div class="form-group">
        <label for="name">Title<?=$result['model']->isRequired('name');?></label>
        <input name="name" type="text" class="form-control <?=$result['model']->hasError('name') ? 'is-invalid':'';?>" id="title" placeholder="Enter title" value="<?=$result['section']->name ?? '';?>">
        <div class="invalid-feedback">
            <?=$result['model']->getFirstError('name'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="parentsection">Parent section</label>
        <select name="parentID" class="form-control" id="parentsection">
            <option value="0">Parent section</option>
            <?=\app\models\Section::makeSectionsTree($result['sections']); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description<?=$result['model']->isRequired('description');?></label>
        <textarea name="description" class="form-control" id="description" rows="3"><?=$result['section']->description ?? '';?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
