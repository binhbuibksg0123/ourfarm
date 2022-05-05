<?php
    class Recipe extends Controller{
        private $recipeModel;
        private $recipeArr;
        private $farmArr;
        function __construct()
        {
            $this->recipeModel = $this->model('RecipeModel');
            $this->recipeArr = json_decode($this->recipeModel->getAllRecipe(),true);
            $this->farmArr = json_decode($this->recipeModel->getFarm(),true);
        }
        function mainFunc(){
            $this->view("MasterLayout",[
                "Page"=>"Recipe",
                "recipeArr"=>$this->recipeArr,
                "farmArr"=>$this->farmArr,
            ]);
        }
        function addRecipeHandling(){
            $farmId = $_POST['farmId'];
            $farmInfo = explode('|', $farmId);
            $minLumi = $_POST['minLumi'];
            $maxLumi = $_POST['maxLumi'];
            $optimalLumi = $_POST['optimalLumi'];
            $minHumid = $_POST['minHumid'];
            $maxHumid = $_POST['maxHumid'];
            $optimalHumid = $_POST['optimalHumid'];
            $minTemper = $_POST['minTemper'];
            $maxTemper = $_POST['maxTemper'];
            $optimalTemper = $_POST['optimalTemper'];
            $result = $this->recipeModel->addRecipe($farmInfo[0],$farmInfo[1],$minLumi,$maxLumi,$optimalLumi,$minHumid,$maxHumid,$optimalHumid,$minTemper,$maxTemper,$optimalTemper);
            if($result === 1) {
                header("LOCATION: http://localhost/ourfarm/recipe");
            }
            else header("LOCATION: http://localhost/ourfarm/");
        }
    }
?>