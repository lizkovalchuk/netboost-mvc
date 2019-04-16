<main>
    <div class="row" id="h1-container">
        <div class="col-xs-12 center-content">
            <h1 id="h1-ms">Milestones</h1>
        </div>$
    </div>
    <div class="row">
        <div class="row col-sm-12 col-sm-offset-3 ">
            <span id="h1-blurb">Create a Milestone to help visualize how to tackle aspects of your project</span>
        </div>
    </div>
    <div class="row col-sm-12" id="chart-container">
        <div class="col-lg-6 col-xs-12">
            <h3 class="center-content">Project Completion</h3>
            <div class="col-md-6 col-md-offset-2" id="piechart"></div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <h3 class="center-content">Milestone Timeline</h3>
            <div class="col-md-6 col-md-offset-2" id="timeline" ></div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-lg-6 col-xs-12">
            <div class="col-md-6 col-md-offset-4">
                <a href="<?=BASE_PATH?>milestones/create/<?=$this->project_id?>" class='btn btn-primary c-btn'>Create Milestone</a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="col-md-6 col-md-offset-4">
                <a href="<?=BASE_PATH?>milestones/updateIndex/<?=$this->project_id?>" class='btn btn-primary c-btn'>Update Milestone</a>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var intoDataArray = [['Tasks','Percentages']
            <?php
                $remainding = 100;

                foreach($this->temp1 as $item)
                {
                    $remainding = $remainding - (int)$item['percentage'];
                    echo ',["'.$item['name'].'",'. (int)$item['percentage'].']';
                }
            ?>
            //square bracket below is end of intoDataArray
            ];

            var remainding = parseInt(<?= $remainding ?>);
            if(remainding > 0){
                intoDataArray.push(['unassigned', remainding]);
            }

            var data = google.visualization.arrayToDataTable(intoDataArray);
            var options = {
                width: '100%',
                height: '350',
                chartArea: {
                    left: 10,
                    top: 20,
                    width: '100%',
                    height: '550',
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['timeline']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var container = document.getElementById('timeline');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();

            dataTable.addColumn({ type: 'string', id: 'milestones' });
            dataTable.addColumn({ type: 'date', id: 'Start' });
            dataTable.addColumn({ type: 'date', id: 'End' });
            dataTable.addRows(

// open php and do the same foreach as the pie chart
//echo the code you see below

<?php
    //var_dump($this->temp4[0]['date_created']);
    //var_dump(DateTime::createFromFormat('Y-m-d G:i:s',$this->temp4[0]['date_created']));
    $string = '[';
    foreach($this->temp4 as $item)
    {
        $date = DateTime::createFromFormat('Y-m-d G:i:s',$item['date_created']);
        $date = $date->format('Y, n, j');

        $date2 = DateTime::createFromFormat('Y-m-d',$item['due_date']);
        $date2 = $date2->format('Y, n, j');

        $string .= "[ '".$item['name']."', new Date(". $date."), new Date(".$date2.")],";
    }
    rtrim($string,',');
    $string.= ']';
    echo $string;
?>

//           [ '1', 'George Washington', new Date(1789, 3, 30), new Date(1797, 2, 4) ],
//                [ 'HTML', new Date(1789, 3, 30), new Date(1797, 2, 4) ],
//                [ 'Branding',      new Date(1797, 2, 4),  new Date(1801, 2, 4) ],

            );

            chart.draw(dataTable);
        }

    </script>
</main>
<link rel="stylesheet" href="<?=BASE_PATH?>views/public/css/milestones/index.css">