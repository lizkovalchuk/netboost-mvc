<main>
    <div id="container">
        <form method="post" action="<?=BASE_PATH?>signup/createCompany">
            <fieldset>
                <legend>Let's create a profile for you</legend>
                <div class="form-group">
                    <label for="companyName">Company</label>
                    <input type="text" name="companyName" class="form-control c-input" value="<?php if(isset($_POST['companyName'])){echo $_POST['companyName'];} ?>" placeholder="Company Name">
                    <small name="companyNameHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["COMPANY_NAME"])) {echo $this->errors["COMPANY_NAME"];} ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="firstName">Contact first name</label>
                    <input type="text" name="firstName" class="form-control c-input" value="<?php if(isset($_POST['firstName'])){echo $_POST['firstName'];} ?>" placeholder="First Name">
                    <small name="contactFNameHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["FIRSTNAME"])) {echo $this->errors["FIRSTNAME"];} ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="lastName">Contact last name</label>
                    <input type="text" name="lastName" class="form-control c-input" value="<?php if(isset($_POST['lastName'])){echo $_POST['lastName'];} ?>" placeholder="Last Name">
                    <small name="contactLNameHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["LASTNAME"])) {echo $this->errors["LASTNAME"];} ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="email">Contact Email Address</label>
                    <input type="text" name="email" class="form-control c-input" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" placeholder="abc@example.com">
                    <small name="contactEmailHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["EMAIL"])) {echo $this->errors["EMAIL"];} ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" name="website" class="form-control c-input" value="<?php if(isset($_POST['website'])){echo $_POST['website'];} ?>" placeholder="www.example.com">
                    <small name="companyWebsiteHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["WEBSITE"])) {echo $this->errors["WEBSITE"];} ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="bio">Few words about company</label>
                    <textarea name="bio" class="form-control c-input" placeholder="Please tell a few words about the company"><?php if(isset($_POST['bio'])){echo $_POST['bio'];} ?></textarea>
                    <small name="companyBioHelper" class="form-text text-muted error">
                        <?php if(isset($this->errors["BIO"])) {echo $this->errors["BIO"];} else{ echo "Only 300 characters.";}?>
                    </small>
                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="col-md-4 col-md-offset-2">
                            <button type="submit" name="createCompany" class="btn btn-primary c-btn">Create Profile</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/authentication/style.css">
</main>