<?php  //var_dump($this->updateCompany); ?>
<main>
    <div id="container">
        <form method="post">
            <fieldset>
                <legend>Update your profile</legend>
                <input type="hidden" name="companyId" value="<?=$this->updateCompany->getCompanyId(); ?>">
                <div class="form-group">
                    <label for="firstName">Company Name</label>
                    <input type="text" name="companyName" class="form-control c-input"  value="<?= $this->updateCompany->getName(); ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Contact Email Address</label>
                    <input type="text" name="companyEmail" class="form-control c-input" value="<?= $this->updateCompany->getContactEmailId(); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Contact First Name</label>
                    <input type="text" name="contactFname" class="form-control c-input" value="<?= $this->updateCompany->getContactFirstName(); ?>">
                </div>
                <div class="form-group">
                    <label for="title">Contact Last Name</label>
                    <input type="text" name="contactLname" class="form-control c-input" value="<?= $this->updateCompany->getContactLastName(); ?>">
                </div>
                <div class="form-group">
                    <label for="bio">Tell us about your company</label>
                    <input type="text" name="companyBio" class="form-control c-input" value="<?= $this->updateCompany->getBio(); ?>">
                </div>
                <div class="form-group">
                    <label for="bio">Company Website</label>
                    <input type="text" name="companyWebsite" class="form-control c-input" value="<?= $this->updateCompany->getWebsite(); ?>">
                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" name="updateCompany" class="btn btn-primary c-btn">Update Profile</button>
                            <a class="btn c-btn"  href="<?=BASE_PATH?>companyProfile"><i class="fas fa-backward"></i> Go back to profile</a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/profile/style.css">
</main>