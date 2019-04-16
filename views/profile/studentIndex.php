<main>
    <div class="col-lg-12">
        <img id="cover-pic" src="<?=BASE_PATH?>views/public/images/profile/coverPhotoProfile.svg" alt="Avatar" >
    </div>
    <div class="profile_content">
        <div class="col-md-9 col-sm-3 col-xs-12">
            <h2><?php echo $this->profile->getFirstName(); ?>  <?php echo $this->profile->getLastName(); ?></h2>
            <div class="profile_title">
                <div class="col-md-9">
                    <h3>About me</h3>
                    <blockquote><?php echo $this->profile->getBio(); ?> </blockquote>

                    <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $this->profile->getSchool()->getName(); ?>
                        </li>

                        <li>
                            <i class="fa fa-briefcase user-profile-icon"></i> Student, Web Development
                        </li>

                        <li class="m-top-xs">
                            <i class="fas fa-laptop"></i> Portfolio:
                            <a href="#" target="_blank"> <?php echo $this->profile->getPortfolioLink(); ?></a>
                        </li>

                        <li>
                            <i class="fas fa-code"></i> Certification: <?php echo $this->profile->getCertifications(); ?>
                        </li>
                    </ul>

                    <a class="btn c-btn" name="update" href="<?=BASE_PATH?>studentProfile/update"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                    <a class="btn c-btn" name="delete" href="<?=BASE_PATH?>studentProfile/delete"><i class="fas fa-trash-alt"></i> Deactivate Profile</a>
                </div>
            </div>
        </div>
</main>

<link rel="stylesheet" href="views/public/css/profile/index.css">