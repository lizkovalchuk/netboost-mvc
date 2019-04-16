google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values


// make variables here
// var allH = document.querySelectorAll("input[type = hidden]");
//
// function CreateName(){
//     var mileNames = [];
//
//     for (var i = 0; i < allH.length; i++){
//         milesNames[i] = "nName"+i;
//     }
//     return mileNames;
// }


function drawChart() {
    var data = google.visualization.arrayToDataTable([

        //Below is the data from google charts. We will be inserting our own.

        ['Task', 'Hours per Day'],
        ['Work',     11],
        ['Eat',      2],
        ['Commute',  2],
        ['Watch TV', 2],
        ['want to sleep', 7],
        ['Sleep',    7]


        // make a for loop that prints

    ]);

    // Optional; add a title and set the width and height of the chart
    var options = { width: '100%',
        height: '350',
        chartArea:{
            left:10,
            top: 20,
            width: '100%',
            height: '550',
        }};



    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}