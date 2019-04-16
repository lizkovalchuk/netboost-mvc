<?php // var_dump($this->update); ?>
<main>
    <div id="container">
        <form method="post">
            <fieldset>
                <legend>Update your profile</legend>
                <input type="hidden" name="teacherId" value="<?=$this->update->getTeacherId(); ?>">
                <div class="form-group">
                      <label for="firstName">First name</label>
                      <input type="text" name="firstName" class="form-control c-input"  value="<?= $this->update->getFirstName(); ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input type="text" name="lastName" class="form-control c-input" value="<?= $this->update->getLastName(); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" class="form-control c-input" value="<?= $this->update->getEmailId(); ?>">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control c-input" value="<?= $this->update->getTitle(); ?>">
                </div>
                <div class="form-group">
                    <label for="bio">Tell about yourself</label>
                    <input type="text" name="bio" class="form-control c-input" value="<?= $this->update->getBio(); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="school">School</label>
                        <select id="school" name="school" class="form-control c-input">
                            <option>Choose...</option>
                            <?php foreach ($this->schools as $s) :?>
                                <option value="<?php echo $s->getId(); ?>"<?= $this->update->getSchool()->getId() == $s->getId() ? 'selected="selected"':''?>><?php echo $s->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-8">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" name="updateTeacher" class="btn c-btn">Update Profile</button>
                            <a class="btn c-btn"  href="<?=BASE_PATH?>teacherProfile"><i class="fas fa-backward"></i> Go back to profile</a>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/profile/style.css">
</main>