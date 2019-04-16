<main>
    <div id="container">
        <form method="post" action="<?=BASE_PATH?>signup" id="signUpForm">
            <fieldset>
                <legend>Sign up</legend>
                <div class="form-group">
                    <label for="username">Enter username</label>
                    <input type="text" name="username" class="form-control c-input" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" placeholder="Enter a username">
                    <small name="usernameHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["USERNAME"])) {
                            echo $this->errors["USERNAME"];
                        } else if(isset($this->errors["EXISTING_USER"])) {
                            echo $this->errors["EXISTING_USER"];
                        }
                        ?>
                    </small>
                </div>
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
                <div class="form-group">
                    <label for="user-role">You are registering as </label>
                    <select name="user-role" id="user-role" class="form-control c-input">
                        <option value="" selected>Choose...</option>
                        <option value="2">Student</option>
                        <option value="3">Company</option>
                        <option value="4">Teacher</option>
                    </select>
                    <small id="roleHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["INVALID_ROLE"])) {echo $this->errors["INVALID_ROLE"];}?>
                    </small>
                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="col-md-4 col-md-offset-2">
                            <button name="createAccount" type="submit" class="btn btn-primary c-btn">Sign Up</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/authentication/style.css">
</main>