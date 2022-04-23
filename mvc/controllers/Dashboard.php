<?php

// http://localhost/live/Home/Show/1/2

class Dashboard extends Controller{

    private $dashboardModel;
    private $deviceArr;
    private $farmArr;
    function __construct()
    {
        $this->dashboardModel = $this->model("DashboardModel");
        $this->deviceArr =  json_decode($this->dashboardModel->getDeviceInfor(),true);
        $this->farmArr = json_decode($this->dashboardModel->getFarm(),true);
    }
    function mainFunc(){
        if(!isset($_SESSION['farmName'])){
            $_SESSION['farmName'] = $this->farmArr[0]['farm_name'];
        }
        $lumi = array();
        $temp = array();
        $humid = array();
            for($i = 0;$i<sizeof($this->deviceArr);$i++)
                if($this->deviceArr[$i]["dashboard_view"] == 1){
                    if($this->deviceArr[$i]["type"] == "Luminosity") $lumi[] = $this->deviceArr[$i];
                    else if($this->deviceArr[$i]["type"] == "Temperature") $temp[] = $this->deviceArr[$i];
                    else if($this->deviceArr[$i]["type"] == "Humidity") $humid[] = $this->deviceArr[$i];
                }
            $dashboardDevice = ["Luminosity"=>$lumi,
                                "Temperature"=>$temp,
                                "Humidity"=>$humid,];
        $this->view("MasterLayout", [
            "Page"=>"CoreInfor",
            "farmArr"=>$this->farmArr,
            "dashboardDeviceArr"=>$dashboardDevice,
            "deviceArr"=>$this->deviceArr,
        ]);
    }
    function addSession(){
        $index = $_POST['index'];
        $_SESSION['farmName'] = $this->farmArr[$index]["farm_name"];
    }
    function addFarmHandling(){
        $farmName = $_POST['farmName'];
        $serverName = $_POST['server'];
        $port = $_POST['port'];
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $result = $this->dashboardModel->addFarm($farmName,$serverName,$port,$userName,$password);
        if($result === 1) {
            $_SESSION["farmName"] = $farmName;
            header("LOCATION: http://localhost/ourfarm/dashboard");
        }
        else header("LOCATION: http://localhost/ourfarm/");
    }
}
?>