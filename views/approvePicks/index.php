<main>
    <div class="row">
        <div class="col-xs-12 center-content">
            <h1 id="h1-c">Approve Picks</h1>
        </div>
    </div>
<?php

foreach ($this->studentsFromPicks as $student){ ?>


<!--    // -------- CONTENT WRAPPER-->
    <div id='courses_list' class='col-xs-12 col-xs-offset-1'>
    <div class='col-xs-12 course'>
<!--    // -------- IMAGE-->
    <div class='col-xs-2 image_container'>
        <img src='<?=BASE_PATH?>views/public/images/approvePicks/person2.svg' alt='profile pic'>
    </div>
<!--    // -------- TEXT WRAPPER-->
    <div class='col-md-10 col-xs-10'>
<!--    // -------- STUDENT NAME-->
        <div class='col-md-12'>
            <div class='col-xs-12 col-sm-6 col-lg-4  col-xl-3'>
                <label class='right'>Student Name:</label>
            </div>
            <div class='col-xs-12 col-sm-6 col-lg-6  col-xl-9'>
                <span class=''><?= $student->stu_name?></span>
            </div>
        </div>

<!--    // -------- TOP CHOICE-->
        <div class='col-md-12'>
            <div class='col-xs-12 col-sm-6 col-lg-4  col-xl-3'>
                <label class='right'>Most Preferred:</label>
            </div>
            <div class='col-xs-12 col-sm-6 col-lg-6  col-xl-9'>
                <span class=''>
                    <?php
                    $temp = false;
                    foreach($this->topRating as $rating){
                            if($student->student_id == $rating->student_id){
                                $temp = true;
                                //echo $rating->name;
                                echo "<span>". $rating->name . "</span>" . "</br>";
                            }
                        }
                    if($temp == false){
                        echo "<span>no top preferences indicated</span>";
                    }

                    ?>
            </div>
        </div>
<!--    // -------- SECOND CHOICE-->
        <div class='col-md-12'>
            <div class='col-xs-12 col-sm-6 col-lg-4  col-xl-3'>
                <label class='right'>Least Preferred:</label>
            </div>
            <div class='col-xs-12 col-sm-6 col-lg-6  col-xl-9'>
                <span class=''>
                    <?php
                    $temp = false;
                    foreach($this->lowestRating as $rating){
                        if($student->student_id == $rating->student_id){
                            $temp = true;
                            //echo $rating->name;
                            echo "<span>". $rating->name . "</span>" . "</br>";
                        }
                    }
                    if($temp == false){
                        echo "<span>no least preferred preference indicated</span>";
                    }
                    ?>
                </span>
            </div>
          </div>

<!--    // -------- Assignment Status-->
        <div class='col-md-12'>
            <div class='col-xs-12 col-sm-6 col-lg-4  col-xl-3'>
                <label class='right'>Assigned:</label>
            </div>
            <div class='col-xs-12 col-sm-6 col-lg-6  col-xl-9'>
                <span class=''>
                    <?php
                    $temp = false;

                    foreach($this->assignment as $assigned){
                        if($student->student_id == $assigned->student_id) {
                            if($assigned->assign == 1){
                                echo "<span>". $assigned->name . "</span>" . "</br>";
                                  $temp = true;
                            }
                        }
                    }
                    if($temp == false){
                        echo "<span>project not yet assigned</span>";
                    }

                    ?></span>
            </div>
          </div>
<!--    // --------- Assignment Button-->
        <div class='col-md-12'>
            <div class='col-md-offset-4'>
                <a href="<?=BASE_PATH?>approvepicks/assign/<?=$student->student_id?>" class='btn btn-primary c-btn'>Assign</a>
            </div>
        </div>
<!--    // ------- CONTENT WRAPPER-->
        </div>
        </div>
    </div>

<?php
    }
?>
</main>

<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/approvePicks/index.css">