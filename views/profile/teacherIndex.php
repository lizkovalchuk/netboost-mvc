<main id="main-content">
    <div class="col-lg-12">
        <img id="cover-pic" src="<?=BASE_PATH?>views/public/images/profile/coverPhotoProfile.svg" alt="Avatar" >
    </div>
        <div class="profile_content">
            <div class="col-md-9 col-sm-3 col-xs-12">
            <h2><?php echo $this->profile->getFirstName(); ?>  <?php echo $this->profile->getLastName(); ?></h2>
                <div class="profile_title">
                    <div class="col-md-9 col-sm-6">
                        <h3>About me</h3>
                        <blockquote>
                            <?php echo $this->profile->getBio();?>
                        </blockquote>

                        <ul class="list-unstyled user_data">
                            <li><i class="fa fa-map-marker user-profile-icon"></i>  <?php echo $this->profile->getSchool()->getName(); ?>
                            </li>

                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $this->profile->getTitle(); ?>
                            </li>
                            <li class="m-top-xs">
                                <i class="fas fa-at"></i><?php echo $this->profile->getEmailId(); ?>
                            </li>
                        </ul>
                        <a class="btn c-btn" name="update" href="<?=BASE_PATH?>teacherProfile/update"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                        <a class="btn c-btn" name="delete" href="<?=BASE_PATH?>teacherProfile/delete"><i class="fas fa-trash-alt"></i> Deactivate Profile</a>
                    </div>
                </div>
            </div>
          </div>
</main>
<link rel="stylesheet" href="views/public/css/profile/index.css">

