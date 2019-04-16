<main>
    <div class="row">
        <div class="col-xs-12 center-content">
            <h1 id="h1-c">Groups</h1>
        </div>
    </div>
    <?php

//    var_dump($this->ProNames);

    foreach ($this->ProNames as $group){


    ?>
        <!--    // -------- CONTENT WRAPPER-->
        <div id='courses_list' class='col-xs-12 col-xs-offset-1'>
            <div class='col-xs-12 course'>
                <!--    // -------- IMAGE-->
                <div class='col-xs-2 image_container'>
                    <a href="<?=BASE_PATH?>milestones/showMilestones/<?=$group->proId?>">
<!--                        IN THE href, do base path, get the project id and-->
<!--                        show the milestones of group members-->




                        <img src='<?=BASE_PATH?>views/public/images/profile/group.png' alt='group icon' >
                    </a>

                </div>
                <!--    // -------- TEXT WRAPPER-->
                <input type="hidden" name="hidden_id" value= "<?=$group->proId?>" />
                <div class='col-md-10 col-xs-10'>
                    <!--    // -------- GROUP NAME-->
                    <div class='col-md-12'>
                        <div class='col-xs-12 col-sm-6 col-lg-4  col-xl-3'>
                            <label class='right'>Project Name:</label>
                        </div>
                        <div class='col-xs-12 col-sm-6 col-lg-6  col-xl-9'>
                            <span class='left'><?= $group->proname?></span>
                        </div>
                    </div>

                    <!--    // -------- STUDENTS-->

<!--                    <div class='col-md-12'>-->
<!--                        <div class='col-xs-12 col-sm-6 col-lg-4  col-xl-3'>-->
<!--                            <label class='right'>Students:</label>-->
<!--                        </div>-->
<!--                        <div class='col-xs-12 col-sm-6 col-lg-6  col-xl-9'>-->
<!--                <span class='left'>-->
<!--                    --><?php
//                  //  var_dump($group);
//                    //$temp = false;
//           //         var_dump($msStuInGroups);
//                    foreach($this->AllStuInGroups as $name){
//                        if($name->proname == $group->proname){
//                        //    $temp = true;
//                            //echo $rating->name;
//                            echo "<span>". $name->name . "</span>" . "</br>";
//
//                    }
//                        else{
//                           // echo "no match";
//                            echo "this is outter name" . $group->proname . "<br>";
//                            echo "this is inner name" . $name->proname. "<br>";
//
//                        }
////                    if($temp == false){
////                        echo "<span>no top preferences indicated</span>";
//                    }
//
//                    ?>
<!--                        </div>-->
<!--                    </div>-->


                    <!--    // --------- Assignment Button-->
                    <div class='col-md-12'>
                        <div class='col-md-offset-4'>
                            <a href="<?=BASE_PATH?>milestones/showMilestones/<?=$group->proId?>" class='btn btn-primary c-btn'>View Milestones</a>
                        </div>
                    </div>
                    <!--    // ------- CONTENT WRAPPER-->
                </div>
            </div>
        </div>


        <?php
    }
    ?>
    <link type="text/css" rel="stylesheet" href="<?=BASE_PATH?>views/public/css/milestones/groupList.css">
</main>

