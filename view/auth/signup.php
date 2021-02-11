<?php
/* */
?>
<div class="row">
    <div class="col-12">
        <h1>Sign up page</h1>
    </div>
    <div class="col-12">
        <form method="POST">
            <div class="form-group">
                <label for="email">Login<?=$result['model']->isRequired('login');?></label>
                <input class="form-control <?=$result['model']->hasError('login') ? 'is-invalid':'';?>" id="email" placeholder="Login" name="login" value="<?=$_POST['login'] ?? '';?>">
                <div class="invalid-feedback">
                    <?=$result['model']->getFirstError('login'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email<?=$result['model']->isRequired('email');?></label>
                <input class="form-control <?=$result['model']->hasError('email') ? 'is-invalid':'';?>" id="email" placeholder="Email" name="email" value="<?=$_POST['email'] ?? '';?>">
                <div class="invalid-feedback">
                    <?=$result['model']->getFirstError('email'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password<?=$result['model']->isRequired('password');?></label>
                <input type="password" class="form-control <?=$result['model']->hasError('password') ? 'is-invalid':'';?>" id="password" placeholder="Password" name="password">
                <div class="invalid-feedback">
                    <?=$result['model']->getFirstError('password'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
