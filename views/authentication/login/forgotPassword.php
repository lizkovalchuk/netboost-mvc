<link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/authentication/style.css">
<main>
    <div id="page-wrap">
        <form method="post" action="<?=BASE_PATH?>login/forgotPassword" class="signin_form">
            <fieldset>
                <legend>Forgot Password ?</legend>
                <small id="emailHelper" class="form-text text-muted error">
                    <?php if(isset($this->mailNotSent)) {
                        echo $this->mailNotSent;
                    } else if(isset($this->emailSent)){
                        echo $this->emailSent;
                    }?>
                </small>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="text" name="email" class="form-control c-input" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" placeholder="Enter your email address">
                    <small id="emailHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["EMAIL"])) {
                            echo $this->errors["EMAIL"];
                        }?>
                    </small>
                </div>
                <div class="col-md-6">
                    <div class="col-md-4 col-md-offset-2">
                        <button type="submit" name="sendEmail" class="btn btn-primary c-btn">Send Link</button>
                    </div>
                </div>
                <span><a href="<?=BASE_PATH?>login" class="btn btn-primary c-btn">Return to Login</a></span>
            </fieldset>
        </form>
    </div>
</main>

