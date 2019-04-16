<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/authentication/style.css">
<main>
    <div id="page-wrap">
        <form method="post" action="<?=BASE_PATH?>login/resetPassword" class="signin_form">
            <fieldset>
                <legend>Reset Password</legend>
                <small id="updateFail" class="form-text text-muted error">
                    <?php if(isset($this->updateFailMessage)) {
                        echo $this->updateFailMessage;
                    }?>
                </small>
                <div class="form-group">
                    <label for="password">Enter password</label>
                    <input type="password" name="password" class="form-control c-input" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>" placeholder="Enter password">
                    <small id="passwordHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["PASSWORD"])) {echo $this->errors["PASSWORD"];}?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm password</label>
                    <input type="password" name="confirmPassword" class="form-control c-input" value="<?php if(isset($_POST['confirmPassword'])){echo $_POST['confirmPassword'];} ?>" placeholder="Confirm password">
                    <small id="confirmPasswordHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["PASSWORD_MISMATCH"])) {echo $this->errors["PASSWORD_MISMATCH"];}?>
                    </small>
                </div>
                <div class="col-md-6">
                    <div class="col-md-4">
                        <button type="submit" name="resetPassword" class="btn btn-primary c-btn">Change Password</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-4 col-md-offset-2">
                        <a href="<?=BASE_PATH?>login" class="btn btn-primary c-btn">Return to Login</a>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</main>

