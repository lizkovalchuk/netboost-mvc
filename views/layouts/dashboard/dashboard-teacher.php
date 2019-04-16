<?php
/**
 * Created by PhpStorm.
 * User: princymascarenhas
 * Date: 2018-03-31
 * Time: 10:50 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="<?=BASE_PATH?>views/public/images/home/browser-logo.png" />
    <title>Netboost Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= BASE_PATH?>/views/public/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= BASE_PATH?>/views/public/css/dashboard/style.css" rel="stylesheet">

     <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"
             integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
 </head>

<body>
 <div id="container">
     <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATION
      *********************************************************************************************************************************************************** -->
     <!--header start-->
     <header class="header green-bg">
         <div class="sidebar-toggle-box">
             <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
         </div>
         <!--logo start-->
         <a href="dashboard-teacher.php" class="logo"><img id="dash-logo" src="assets/img/dash-logo.svg" alt="Netboost Logo"></a>
         <!--logo end-->
         <div class="top-menu">
             <ul class="nav navbar-nav navbar-right top-menu">
                 <li>

                     <a href="#">
                         <i class="far fa-envelope notify"></i>
                     </a>
                 </li>
                 <li class="top-menu"><a class="logout" href="#">LOG OUT</a></li>
             </ul>
         </div>
     </header>
     <!-- **********************************************************************************************************************************************************
     MAIN SIDEBAR MENU
     *********************************************************************************************************************************************************** -->
     <!--sidebar start-->
     <aside>
         <div id="sidebar"  class="nav-collapse ">
             <!-- sidebar menu start-->
             <ul class="sidebar-menu" id="nav-accordion">

                 <p class="centered"><a href="#"><img src="assets/img/dash-profile-pic.svg" class="img-circle" width="70"></a></p>
<?php 
    session_start();
    $options = '';
    if (true) {
        $options = array('PROFILE' => '#'
                        ,'COURSES' => 'courses'
                        , 'project' => 'project'
                        ,'CREATE NEW PROJECT' => 'projects/add'
                        ,'VIEW REQUESTS' => 'viewProjectRequests'
                        ,'APPROVE STUDENT PICKS' => 'picks'
                        ,'MILESTONES' => 'milestones'
                        ,'TASK MANAGER' => 'tasks'
                        ,'RATE COMPANIES' => 'ratings'
                        ,'NEWSFEED' => 'articles');
    }
    foreach ($options as $key => $value) {
        ?>
        <li class="mt">
             <a class="active" href="<?=$value?>">
                 <i class="fas fa-user"></i>
                 <span><?=$key?></span>
             </a>
         </li>
        <?php
    }

?>
                 <h5 class="centered">Hello, Teacher!</h5>

                 <li class="mt">
                     <a class="active" href="#">
                         <i class="fas fa-user"></i>
                         <span>PROFILE</span>
                     </a>
                 </li>

                 <li class="sub-menu">
                     <a href="#">
                         <i class="far fa-file-alt"></i>
                         <span>COURSES</span>
                     </a>
                 </li>

                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-file-code"></i>
                         <span>PROJECTS</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-pencil-alt"></i>
                         <span>CREATE NEW PROJECT</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-eye"></i>
                         <span>VIEW REQUESTS</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-thumbs-up"></i>
                         <span>APPROVE STUDENT PICKS</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-flag"></i>
                         <span>MILESTONES</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-tasks"></i>
                         <span>TASK MANAGER</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-star"></i>
                         <span>RATE COMPANIES</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="#">
                         <i class="fas fa-newspaper"></i>
                         <span>NEWSFEED</span>
                     </a>
                 </li>
             </ul>
             <!-- sidebar menu end-->
         </div>
     </aside>
 </div>
</body>
</html>


