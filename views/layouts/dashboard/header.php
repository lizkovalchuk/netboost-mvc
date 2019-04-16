<?php
$role = $_SESSION['loggedInUserRole']
?>
<!DOCTYPE html>
<html lang="en">
     <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="shortcut icon" href="<?=BASE_PATH?>views/public/images/home/browser-logo.png" />
        <title>Netboost Dashboard</title>

        <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
        <!-- Bootstrap core CSS -->
        <link href="<?=BASE_PATH?>views/public/css/bootstrap.css" rel="stylesheet">
         <link href="<?=BASE_PATH?>views/public/css/dashboard/style-responsive.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?=BASE_PATH?>views/public/css/dashboard/style.css" rel="stylesheet">

        <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"
                 integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     </head>

<body>
 <div id="container">
     <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATION
      *********************************************************************************************************************************************************** -->
     <!--header start-->
     <header class="header green-bg">
         <div class="sidebar-toggle-box ham">
             <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
         </div>
         <!--logo start-->
         <a href="<?=BASE_PATH?>home/index.php" class="logo"><img id="dash-logo" src="<?= BASE_PATH ?>views/layouts/dashboard/assets/img/dash-logo-white.svg" alt="Netboost Logo"></a>
         <!--logo end-->
         <div class="top-menu">
             <ul class="nav navbar-nav navbar-right top-menu">
                 <li class="top-menu"><a class="logout c-btn" href="<?=BASE_PATH?>home/logout">LOG OUT</a></li>
             </ul>
         </div>
     </header>
     <!-- **********************************************************************************************************************************************************
     MAIN SIDEBAR MENU
     *********************************************************************************************************************************************************** -->
     <!--sidebar start-->
     <aside class="menu">
         <div id="sidebar"  class="nav-collapse ">
             <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                 <p class="centered"><a href="#"><img src="<?= BASE_PATH ?>views/layouts/dashboard/assets/img/dash-profile-pic.svg" class="img-circle" width="70"></a></p>
                 <h5 class="centered">Hello, <?=$_SESSION['username']?>!</h5>


                 <?php if($role!= 'admin'){ ?>
                 <li class="mt">
                     <a href="<?=BASE_PATH.$role?>Profile">
                         <i class="fas fa-user"></i>
                         <span>PROFILE</span>
                     </a>
                 </li>
                 <?php if($role!="company") {?>
                 <?php }?>
                 <?php 
                    if($role=="teacher"){
                 ?>
                <li class="sub-menu">
                    <a href="<?=BASE_PATH?>outlines">
                        <i class="fas fa-file-code"></i>
                        <span>MY OUTLINES</span>
                    </a>
                </li>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>outlines/add">
                         <i class="fas fa-pencil-alt"></i>
                         <span>CREATE NEW OUTLINE</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>viewProjectRequests">
                         <i class="fas fa-eye"></i>
                         <span>VIEW REQUESTS</span>
                         <span class="badge badge-primary badge-pill notification"><?php if(isset($_SESSION['notifications']) && count($_SESSION['notifications']['requestNotifications']) > 0) {echo count($_SESSION['notifications']['requestNotifications']);} ?></span>
                     </a>
                 </li>
                 
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>approvepicks">
                         <i class="fas fa-thumbs-up"></i>
                         <span>APPROVE STUDENT PICKS</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>messageSystem">
                         <i class="far fa-comments"></i>
                         <span>YOUR MESSAGES</span>
                         <span class="badge badge-primary badge-pill notification"><?php if(isset($_SESSION['notifications']) && count($_SESSION['notifications']['messageNotifications']) > 0) {echo count($_SESSION['notifications']['messageNotifications']);} ?></span>
                     </a>
                 </li>
                 <?php
                    }
                    if($role != "company"){
                ?>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>milestones">
                         <i class="fas fa-flag"></i>
                         <span>MILESTONES</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>tasks">
                         <i class="fas fa-tasks"></i>
                         <span>TASK MANAGER</span>
                     </a>
                 </li>
                 <?php }
                    if($role=="student"){
                 ?>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>picks">
                         <i class="fas fa-star"></i>
                         <span>PICK COMPANIES</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>ratings">
                         <i class="fas fa-star"></i>
                         <span>RATE COMPANIES</span>
                     </a>
                 </li>
                 <?php 
                    } 
                    if($role == "company"){
                    ///////////////////////////////////////////
                    //////HAS TO AIM TO SEARCH OUTLINE/////////
                    ///////////////////////////////////////////
                ?>
                <li class="sub-menu">
                     <a href="<?=BASE_PATH?>requestCollab">
                         <i class="fas fa-newspaper"></i>
                         <span>SEARCH OUTLINES</span>
                     </a>
                 </li>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>requestCollab/viewSentRequests">
                         <i class="far fa-check-circle"></i>
                         <span>VIEW SENT REQUESTS</span>
                     </a>
                 </li>
                 <li>
                     <a href="<?=BASE_PATH?>messageSystem">
                         <i class="far fa-comments"></i>
                         <span>YOUR MESSAGES</span>
                         <span class="badge badge-primary badge-pill notification"><?php if(isset($_SESSION['notifications']) && count($_SESSION['notifications']['messageNotifications']) > 0) {echo count($_SESSION['notifications']['messageNotifications']);} ?></span>
                     </a>
                 </li>
                <?php 
                    } }
                 ?>
                 <li class="sub-menu">
                     <a href="<?=BASE_PATH?>articles">
                         <i class="fas fa-newspaper"></i>
                         <span>NEWSFEED</span>
                     </a>
                 </li>
             </ul>
             <!-- sidebar menu end-->
         </div>
     </aside>

 </div>
 <!-- toggle hamburger jQuery -->
 <script>
     $(".ham").click(function () {
         $(".menu").toggle();
     });
 </script>

