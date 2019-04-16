<main>
    <div class="container">
        <h2>Are you sure you want to deactivate your profile?</h2>
        <p>NOTE: Deactivating your profile will remove access to everything within the application and log you out automatically. You will have
            no access to your account after that and will have to contact the <b>Admin at netboost@gmail.com</b> to get your account reactivated.</p>
        <form method="POST">
            <input type="hidden" name="studentId" value="<?=$this->deactivate->getStudentId(); ?>" >
            <fieldset class="col-lg-12">
                <legend>Delete your profile</legend>
                <div class="form-group col-lg-12">
                    <label for="txt_title">First name</label>
                    <input class="form-control" id="fname" value="<?= $this->deactivate->getFirstName(); ?>" type="text" name="fname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label for="txt_body">Last name</label>
                    <input class="form-control" id="lname" value="<?= $this->deactivate->getLastName(); ?>" type="text" name="lname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label for="image_url">Email Address</label>
                    <input class="form-control" id="email" value="<?= $this->deactivate->getEmailId(); ?>" type="text" name="email" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label">Portfolio Link</label>
                    <input class="form-control" id="title" value="<?= $this->deactivate->getPortfolioLink(); ?>" type="text" name="title" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label">Your bio</label>
                    <input value="<?= $this->deactivate->getBio(); ?>" class="form-control" id="bio" type="text" name="bio" disabled>
                    </input>
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label">Certifications</label>
                    <input value="<?= $this->deactivate->getCertifications(); ?>" class="form-control" id="bio" type="text" name="bio" disabled>
                    </input>
                </div>
                <div class="form-group col-lg-12">
                    <input type="submit" name="deactivateStudent" value="Deactivate" class="btn c-btn">
                    <a class="btn c-btn"  href="<?=BASE_PATH?>studentProfile"><i class="fas fa-backward"></i></i> Go back to profile</a>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/profile/style.css">
</main>
