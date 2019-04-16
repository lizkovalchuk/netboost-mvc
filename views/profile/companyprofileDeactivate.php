<main>
    <div class="container">
        <h2>Are you sure you want to deactivate your profile?</h2>
        <p>NOTE: Deactivating your profile will remove access to everything within the application and log you out automatically. You will have
            no access to your account after that and will have to contact the <b>Admin at netboost@gmail.com</b> to get your account reactivated.</p>
        <form method="POST">
            <input type="hidden" name="companyId" value="<?=$this->deactivate->getCompanyId(); ?>" >
            <fieldset class="col-lg-12">
                <legend>Delete your profile</legend>
                <div class="form-group col-lg-12">
                    <label for="txt_title">Company Name</label>
                    <input class="form-control" id="cname" value="<?= $this->deactivate->getName(); ?>" type="text" name="cname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label for="txt_body">Company Email Address</label>
                    <input class="form-control" id="email" value="<?= $this->deactivate->getContactEmailId(); ?>" type="text" name="email" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label for="image_url">Contact First Name</label>
                    <input class="form-control" id="cFname" value="<?= $this->deactivate->getContactFirstName(); ?>" type="text" name="cFname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label">Contact Last Name</label>
                    <input class="form-control" id="cLname" value="<?= $this->deactivate->getContactLastName() ?>" type="text" name="cLname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label">Company Website</label>
                    <input class="form-control" id="cLname" value="<?= $this->deactivate->getWebsite() ?>" type="text" name="cLname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label">Tell about yourself</label>
                    <input value="<?= $this->deactivate->getBio(); ?>" class="form-control" id="bio" type="text" name="bio" disabled>
                    </input>
                </div>
                <div class="form-group col-lg-12">
                    <input type="submit" name="deactivateCompany" value="Deactivate" class="btn c-btn">
                    <a class="btn c-btn"  href="<?=BASE_PATH?>companyProfile"><i class="fas fa-backward"></i> Go back to profile</a>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/profile/style.css">
</main>
