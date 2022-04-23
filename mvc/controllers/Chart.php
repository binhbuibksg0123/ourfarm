<?php
    class Chart extends Controller{
        private $chartModel;
        function __construct(){
            $this->chartModel = $this->model("ChartModel");
        }
        function mainFunc($loginStatus = true){
            $this->view("Chart");
        }
    }
?>