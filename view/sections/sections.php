<?php

?>
<div class="row">
    <div class="col-12">
        <h1>List of sections</h1>
    </div>
    <? if($result['parentID'] !== 0): ?>
        <p class="col-12"><a href="/section?id=<?=$result['parentID'];?>">Back to parent section</a></p>
    <? endif; ?>
    <? if(count($result['sections']) > 0): ?>
        <? foreach($result['sections'] as $section): ?>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><a href="/section?id=<?=$section->id;?>"><?=$section->name;?></a></h5>
                    <p class="card-text"><?=$section->description;?></p>
                </div>
            </div>
        </div>
        <? endforeach; ?>

    <? else: ?>
        <div class="col-12">
            <p>No sections here :(</p>
        </div>
    <? endif; ?>
</div>
