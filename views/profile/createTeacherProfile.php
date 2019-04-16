<main>
    <div id="container">
        <form method="post" action="<?=BASE_PATH?>signup/createTeacher">
            <fieldset>
                <legend>Let's create a profile for you</legend>
                <div id="teacher-div">
                    <div class="form-group">
                        <label for="firstName">First name</label>
                        <input type="text" name="firstName" class="form-control c-input" value="<?php if(isset($_POST['firstName'])){echo $_POST['firstName'];} ?>" placeholder="First Name">
                        <small name="teacherFirstNameHelper" class="form-text text-muted error">
                            <?php if(isset($this->errors["FIRSTNAME"])) {echo $this->errors["FIRSTNAME"];} ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last name</label>
                        <input type="text" name="lastName" class="form-control c-input" value="<?php if(isset($_POST['lastName'])){echo $_POST['lastName'];} ?>" placeholder="Last Name">
                        <small name="teacherLastNameHelper" class="form-text text-muted error">
                            <?php if(isset($this->errors["LASTNAME"])) {echo $this->errors["LASTNAME"];} ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" class="form-control c-input" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" placeholder="abc@example.com">
                        <small name="teacherEmailHelper" class="form-text text-muted error">
                            <?php if(isset($this->errors["EMAIL"])) {echo $this->errors["EMAIL"];} ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control c-input" value="<?php if(isset($_POST['title'])){echo $_POST['title'];} ?>" placeholder="Your title">
                        <small name="teacherTitleHelper" class="form-text text-muted error">
                            <?php if(isset($this->errors["TITLE"])) {echo $this->errors["TITLE"];} ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="bio">Tell about yourself</label>
                        <textarea name="bio" class="form-control c-input" placeholder="Please tell a few words about yourself"><?php if(isset($_POST['bio'])){echo $_POST['bio'];} ?></textarea>
                        <small name="teacherBioHelper" class="form-text text-muted error">
                            <?php if(isset($this->errors["BIO"])) {echo $this->errors["BIO"];} ?>
                        </small>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="school">School</label>
                            <select id="school" name="school" class="form-control c-input">
                                <option value="">Choose...</option>
                                <?php foreach ($this->schools as $s) :?>
                                    <option value="<?php echo $s->getId() ?>"><?php echo $s->getName() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small name="teacherSchoolHelper" class="form-text text-muted error">
                                <?php if(isset($this->errors["SCHOOL"])) {echo $this->errors["SCHOOL"];} ?>
                            </small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="col-md-4 col-md-offset-2">
                                <button type="submit" name="createTeacher" class="btn btn-primary c-btn">Create Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>views/public/css/authentication/style.css">
</main>