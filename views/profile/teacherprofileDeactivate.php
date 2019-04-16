<main>
    <div class="container">
        <h2>Are you sure you want to deactivate your profile?</h2>
        <p>NOTE: Deactivating your profile will remove access to everything within the application and log you out automatically. You will have
            no access to your account after that and will have to contact the <b>Admin at netboost@gmail.com</b> to get your account reactivated.</p>
        <form method="POST">
            <input type="hidden" name="teacherId" value="<?=$this->deactivate->getTeacherId(); ?>" >
            <fieldset>
                <legend>Delete your profile</legend>
                <div class="form-group col-lg-12">
                    <label for="fname">First name</label>
                    <input class="form-control" id="fname" value="<?= $this->deactivate->getFirstName(); ?>" type="text" name="fname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label for="lname">Last Name</label>
                    <input class="form-control" id="lname" value="<?= $this->deactivate->getLastName(); ?>" type="text" name="lname" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label for="email">Email Address</label>
                    <input class="form-control" id="email" value="<?= $this->deactivate->getEmailId(); ?>" type="text" name="email" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label class="title">Title</label>
                    <input class="form-control" id="title" value="<?= $this->deactivate->getTitle(); ?>" type="text" name="title" disabled>
                </div>
                <div class="form-group col-lg-12">
                    <label class="bio">Tell about yourself</label>
                    <input value="<?= $this->deactivate->getBio(); ?>" class="form-control" id="bio" type="text" name="bio" disabled>
                </input>
                </div>
                <div class="form-group col-lg-12">
                    <input type="submit" name="deactivateTeacher" value="Deactivate" class="btn c-btn">
                    <a class="btn c-btn"  href="<?=BASE_PATH?>teacherProfile"><i class="fas fa-backward"></i> Go back to profile</a>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/profile/style.css">
</main>
