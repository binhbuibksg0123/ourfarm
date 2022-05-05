<?php 
    class RecipeModel extends DB{
        function getAllRecipe(){
            $query = "SELECT * FROM Recipe";
            $kq = $this->con->query($query);
            $recipeArr = array();
            while($row = mysqli_fetch_array($kq)){
                $recipeArr[] = $row;
            }
            return json_encode($recipeArr);
        }
        function getFarm(){
            $query = "select * from Farm";
            $result = $this->con->query($query);
            $listFarm = array();
            while($row = mysqli_fetch_array($result)){
                $listFarm[] = $row;
            }
            return json_encode($listFarm);
        }
        function addRecipe($farmId,$farmName,$minLumi,$maxLumi,$optimalLumi,$minHumid,$maxHumid,$optimalHumid,$minTemper,$maxTemper,$optimalTemper){
            $query = "insert into Recipe (field_id,farm_name,min_lumi,max_lumi,optimal_lumi,min_humid,max_humid,optimal_humid,min_temper,max_temper,optimal_temper)
                values('".$farmId."','".$farmName."','".$minLumi."','".$maxLumi."','".$optimalLumi."','".$minHumid."','".$maxHumid."','".$optimalHumid."','".$minTemper."','".$maxTemper."','".$optimalTemper."')";
            $result = $this->con->query($query);
            if($result === FALSE){
                return 0;
            }
            else return 1;
        }
    }
?>