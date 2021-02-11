<?php
/* */
?>
<div class="row">
    <div class="col-12">
        <h1>Auth page</h1>
    </div>
    <div class="col-12">
        <? if($result['model']->hasError()): ?>
            <div class="alert alert-danger" role="alert"><?=$result['model']->getFirstError();?></div>
        <? endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">Login</label>
                <input class="form-control" id="email" placeholder="Login" name="login">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
