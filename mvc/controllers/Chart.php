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
            echo $this->humid;
        }

        function getDataFromFeed($feed = "ourfarm-humid")
        {
            $api_url = "https://io.adafruit.com/api/v2/binhbuibksg0123/feeds/{$feed}/data?X-AIO-Key=aio_fHuR31Pi9nfgXdE2wD7VOR5GYAld";
            return file_get_contents($api_url);
        }
    }
?>