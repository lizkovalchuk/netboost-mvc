<?php //var_dump($this->studentUpdate); ?>
<main>
    <div id="container">
        <form method="post">
            <fieldset>
                <legend>Update your profile</legend>
                <input type="hidden" name="studentId" value="<?=$this->studentUpdate->getStudentId(); ?>">
                <div class="form-group">
                    <label for="firstName">First name</label>
                    <input type="text" name="firstName" class="form-control c-input"  value="<?= $this->studentUpdate->getFirstName(); ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input type="text" name="lastName" class="form-control c-input" value="<?= $this->studentUpdate->getLastName(); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" class="form-control c-input" value="<?= $this->studentUpdate->getEmailId(); ?>">
                </div>
                <div class="form-group">
                    <label for="title">Portfolio Link</label>
                    <input type="text" name="portfolio" class="form-control c-input" value="<?= $this->studentUpdate->getPortfolioLink(); ?>">
                </div>
                <div class="form-group">
                    <label for="bio">Tell about yourself</label>
                    <input type="text" name="bio" class="form-control c-input" value="<?= $this->studentUpdate->getBio(); ?>">
                </div>
                <div class="form-group">
                    <label for="bio">Certifications</label>
                    <input type="text" name="certification" class="form-control c-input" value="<?= $this->studentUpdate->getCertifications(); ?>">
                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" name="updateStudent" class="btn c-btn">Update Profile</button>
                            <a class="btn c-btn"  href="<?=BASE_PATH?>studentProfile"><i class="fas fa-backward"></i> Go back to profile</a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/profile/style.css">
</main>