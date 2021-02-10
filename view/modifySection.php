<h1>Modify section</h1>
<form method="POST">
    <div class="form-group">
        <label for="name">Title</label>
        <input name="name" type="text" class="form-control" id="title" placeholder="Enter title" value="<?=$result['section']->name ?? '';?>">
    </div>
    <div class="form-group">
        <label for="parentsection">Parent section</label>
        <select name="parentID" class="form-control" id="parentsection">
            <option value="0">Parent section</option>
            <?=\app\models\Section::makeSectionsTree($result['sections']); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3"><?=$result['section']->description ?? '';?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
