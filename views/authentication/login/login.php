<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/authentication/style.css">
<main>
    <div id="page-wrap">
        <?php if(isset($this->message)) { ?>
        <div class="alert alert-success signup-succes"><?php echo $this->message . ". Please login to continue."; ?></div>
        <?php } ?>
        <form method="post" action="<?=BASE_PATH?>login/loginSuccess" class="signin_form">
            <fieldset>
                <legend>Sign In</legend>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control c-input" value="<?php if(isset($_POST['username'])) {echo $_POST['username'];} ?>" name="username" placeholder="Enter your username">
                    <small id="loginHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["USERNAME"])) {
                            echo $this->errors["USERNAME"];
                        }?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?php if(isset($_POST['password'])) {echo $_POST['password'];} ?>" class="form-control c-input" placeholder="Enter your password">
                    <small id="loginHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["PASSWORD"])) {
                            echo $this->errors["PASSWORD"];
                        }?>
                    </small>
                </div>
                <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="col-md-4 col-xs-4">
                        <button type="submit" name="login" class="btn btn-primary c-btn">Sign in</button>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="col-md-12 col-xs-12">
                        <span class="new-user">New to NetBoost? </span><a href="<?=BASE_PATH?>signup" class="btn btn-primary c-btn">Sign up</a>
                    </div>
                </div>
                </div>
                <hr/>
                <div class="col-md-6 col-md-offset-4">
                    <a type="submit" class="resetPwd" href="<?=BASE_PATH?>login/forgotPassword" name="forgotPassword">Forgot Password?</a>
                </div>
            </fieldset>
        </form>
    </div>
</main>

