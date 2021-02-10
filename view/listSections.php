<?php

?>
    <div class="col-12">
        <h1>List of sections</h1>
    </div>
    <? if(count($result['sections']) > 0): ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <? foreach($result['sections'] as $section): ?>
            <tr>
                <th scope="row"><?=$section->id;?></th>
                <td><a href="/admin/sections/edit?id=<?=$section->id;?>"><?=$section->name;?></a></td>
                <td><a href="/admin/sections/remove?id=<?=$section->id;?>">Remove</a></td>
            </tr>
            <? endforeach; ?>
            </tbody>
        </table>



    <? else: ?>
        <div class="col-12">
            <p>No sections here :(</p>
        </div>
    <? endif; ?>

