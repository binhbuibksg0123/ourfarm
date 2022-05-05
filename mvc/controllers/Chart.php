<?php
    class Chart extends Controller{
        private $chartModel;
        // private $resData = [];

        private $humid;
        private $lumi;
        private $recipe;
        private $temp;

        function __construct(){
            $this->chartModel = $this->model("ChartModel");

            $this->humid = $this->getDataFromFeed("ourfarm-humid");
            $this->lumi = $this->getDataFromFeed("ourfarm-lumi");  
            $this->recipe = $this->getDataFromFeed("ourfarm-recipe");
            $this->temp = $this->getDataFromFeed("ourfarm-temp");
            
        }

        function mainFunc(){
            $this->view("Chart",[
                        "Page"=>"Chart",
                        "humid" => $this->humid,
                        "lumi" => $this->lumi,
                        "recipe" => $this->recipe,
                        "temp" => $this->temp 
            ]);
            // echo $this->humid;
        }

        function getDataFromFeed($feed = "ourfarm-humid")
        {
            $key = "aio_rdEI84gFOrrjMKB71lqP8BEdnB1V";
            $api_url = "https://io.adafruit.com/api/v2/binhbuibksg0123/feeds/{$feed}/data?X-AIO-Key={$key}";
            return json_decode(file_get_contents($api_url), true);
        }
    }
?>