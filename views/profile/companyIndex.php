<main>
    <div class="col-lg-12">
        <img id="cover-pic" src="<?=BASE_PATH?>views/public/images/profile/companyProfileCover.svg" alt="Avatar" >
    </div>
    <div class="profile_content">
        <div class="col-md-9 col-sm-3 col-xs-12">
            <h2><?php echo $this->companyProfile->getName(); ?></h2>
            <div class="profile_title">
                <div class="col-md-9 col-sm-6">
                    <h3>About us</h3>
                    <blockquote><?php echo $this->companyProfile->getBio(); ?></blockquote>

                    <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> Toronto
                        </li>

                        <li>
                            <i class="fa fa-briefcase user-profile-icon"></i> Web Application Development
                        </li>
                        <li class="m-top-xs">
                            <i class="fas fa-laptop"></i>
                            <a href="#" target="_blank"> <?php echo $this->companyProfile->getWebsite(); ?></a>
                        </li>

                        <li>
                            <i class="fas fa-comments"></i> Point of Contact: <?php echo $this->companyProfile->getContactFirstName(); ?>  <?php echo $this->companyProfile->getContactLastName(); ?>
                        </li>
                    </ul>

                    <a class="btn c-btn" name="update" href="<?=BASE_PATH?>companyProfile/update"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                    <a class="btn c-btn" name="delete" href="<?=BASE_PATH?>companyProfile/delete"><i class="fas fa-trash-alt"></i> Deactivate Profile</a>
                </div>
            </div>
        </div>
        </div>
</main>

<link rel="stylesheet" href="views/public/css/profile/index.css">