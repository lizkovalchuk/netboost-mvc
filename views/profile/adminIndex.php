
<main id="main-content">
    <div class="profile_content">
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="profile_img">
                <div>
                    <!-- Current avatar -->
                    <img id="profile-pic" src="<?=BASE_PATH?>views/public/images/profile/teacherProfilePic.png" alt="Avatar" >
                </div>
            </div>
            <h3><?php echo $this->profile->getFirstName(); ?>  <?php echo $this->profile->getLastName(); ?></h3>

            <ul class="list-unstyled user_data">
                <li><i class="fa fa-map-marker user-profile-icon"></i> Humber College, Toronto
                </li>

                <li>
                    <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $this->profile->getTitle(); ?>
                </li>

                <li class="m-top-xs">
                    <i class="fas fa-at"></i><?php echo $this->profile->getEmailId(); ?>
                </li>
            </ul>

            <a class="btn c-btn" name="update" href="<?=BASE_PATH?>teacherProfile/update"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
            <a class="btn c-btn"><i class="fas fa-comment"></i> Contact</a>
        </div>
        <div class="col-md-9">

            <div class="profile_title">
                <div class="col-md-9">
                    <h2>About me</h2>
                    <blockquote><?php echo $this->profile->getBio(); ?> </blockquote>
                </div>
            </div>
        </div>
</main>

<link rel="stylesheet" href="views/public/css/profile/index.css">