<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script type="text/javascript">
        window.onload = function () {
            var humidChart = new CanvasJS.Chart("humid",
            {
            title:{
                text: "Humidity Chart"
            },

            axisX:{
                title: "Time",
                gridThickness: 0,
                interval: 1, 
                intervalType: "day",        
                valueFormatString: "MMMM DD", 
                labelAngle: -20
            },
            axisY:{
                title: "Humidity"
            },
            data: [
            {        
                type: "line",
                dataPoints: [//array
                <?php foreach ($data['humid'] as $humid){ 
                    $time = strtotime($humid["created_at"]); 
                    $value = intval($humid["value"]);
                    ?>
                    {x: new Date(Date.UTC (<?php echo intval(date("Y", $time)); ?>, <?php echo intval(date("m", $time)); ?>, <?php echo intval(date("d", $time)); ?>, <?php echo intval(date("H", $time)); ?>, <?php echo intval(date("i", $time)); ?>, <?php echo intval(date("s", $time)); ?>) ), y: <?php echo $value; ?> },
                <?php } ?>
                ]
            }
            ]
            });
            humidChart.render();


            ////////////////////////////////////////////////////////
            var lumiChart = new CanvasJS.Chart("lumi",
            {
            title:{
                text: "Luminostiy Chart"
            },

            axisX:{
                title: "Time",
                gridThickness: 0,
                interval:1, 
                intervalType: "day",        
                valueFormatString: "MMMM DD", 
                labelAngle: -20
            },
            axisY:{
                title: "Luminostiy"
            },
            data: [
            {        
                type: "line",
                dataPoints: [//array
                <?php foreach ($data['lumi'] as $lumi){ 
                    $time = strtotime($lumi["created_at"]); 
                    $value = intval($lumi["value"]);
                    ?>
                    {x: new Date(Date.UTC (<?php echo intval(date("Y", $time)); ?>, <?php echo intval(date("m", $time)); ?>, <?php echo intval(date("d", $time)); ?>, <?php echo intval(date("H", $time)); ?>, <?php echo intval(date("i", $time)); ?>, <?php echo intval(date("s", $time)); ?>) ), y: <?php echo $value; ?> },
                <?php } ?>
                ]
            }
            ]
            });
            lumiChart.render();

            ///////////////////////////////////////////////
            var tempChart = new CanvasJS.Chart("temp",
            {
            title:{
                text: "Temperator Chart"
            },

            axisX:{
                title: "Time",
                gridThickness: 0,
                interval:1, 
                intervalType: "day",        
                valueFormatString: "MMMM DD", 
                labelAngle: -20
            },
            axisY:{
                title: "Temperator"
            },
            data: [
            {        
                type: "line",
                dataPoints: [//array
                <?php foreach ($data['temp'] as $temp){ 
                    $time = strtotime($temp["created_at"]); 
                    $value = intval($temp["value"]);
                    ?>
                    {x: new Date(Date.UTC (<?php echo intval(date("Y", $time)); ?>, <?php echo intval(date("m", $time)); ?>, <?php echo intval(date("d", $time)); ?>, <?php echo intval(date("H", $time)); ?>, <?php echo intval(date("i", $time)); ?>, <?php echo intval(date("s", $time)); ?>) ), y: <?php echo $value; ?> },
                <?php } ?>
                ]
            }
            ]
            });
            tempChart.render();
        }
    </script>


    
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        
</head>


<body>
        
    <div id="humid" style="height: 300px; width: 100%;"></div>
    <div id="lumi" style="height: 300px; width: 100%;"></div>
    <div class="mb-5" id="temp" style="height: 300px; width: 100%;"></div>


</body>

</html>