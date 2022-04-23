<?php 
    class Device extends Controller{
        private $deviceModel;
        private $deviceArr;
        private $farmArr;
        private $farmAddress;
        function __construct()
        {
            $this->deviceModel = $this->model("DeviceModel");
            $this->deviceArr = json_decode($this->deviceModel->getDeviceInfor(),true);
            // for($i = 0;$i < sizeof($allDeviceArr);$i++){
            //     if($allDeviceArr[$i]['farm_name'] == $_SESSION['farmName']){
            //         $this->deviceArr[] = $allDeviceArr[$i];
            //     }
            // }
            $this->farmArr = json_decode($this->deviceModel->getFarm(),true);
            foreach($this->farmArr as $farm){
                $this->farmAddress[$farm['farm_name']]['servername'] = $farm['servername'];
                $this->farmAddress[$farm['farm_name']]['port'] = $farm['port'];
                $this->farmAddress[$farm['farm_name']]['username'] = $farm['username'];
                $this->farmAddress[$farm['farm_name']]['password'] = $farm['password'];
            }
        }
        function mainFunc(){
            $this->view("MasterLayout",[
                        "Page"=>"Device",
                        "farmArr"=>$this->farmArr,
                        "deviceArr"=>$this->deviceArr,
                        "farmAddress"=>$this->farmAddress,
            ]);
        }
        function addDeviceHandling(){
            $farmId = $_POST['farmId'];
            $farmInfo = explode('|', $farmId);
            $descript = $_POST['descript'];
            $feedId = $_POST['feedId'];
            $deviceType = $_POST['deviceType'];
            $deviceName = $_POST['deviceName'];
            $active = 0;
            if(isset($_POST['activeCheckboxRegis'])){
                $active = 1;
            }
            $boolView = 0;
            if(isset($_POST['dashboardView'])) {
                $boolView = 1;
                $this->deviceModel->setDashboardZero($farmInfo[1],$deviceType);
            }
            $result = $this->deviceModel->addDevice($farmInfo[0],$descript,$feedId,$deviceType,$deviceName,$boolView,$farmInfo[1],$active);
            if($result === 1) {
                header("LOCATION: http://localhost/ourfarm/device");
            }
            else header("LOCATION: http://localhost/ourfarm/");
        }
        function editDeviceHandling(){
            $farmId = $_POST['farmIdEdit'];
            $farmInfo = explode('|', $farmId);
            $descript = $_POST['descriptEdit'];
            $feedId = $_POST['feedIdEdit'];
            $deviceType = $_POST['deviceTypeEdit'];
            $deviceName = $_POST['deviceNameEdit'];
            $deviceId = $_POST['deviceId'];
            $active = 0;
            if(isset($_POST['activeCheckboxEdit'])){
                $active = 1;
            }
            $boolView = 0;
            if(isset($_POST['dashboardViewEdit'])) {
                $boolView = 1;
                $this->deviceModel->setDashboardZero($farmInfo[1],$deviceType);
            }
            $result = $this->deviceModel->updateDevice($farmInfo[0],$descript,$feedId,$deviceType,$deviceName,$boolView,$farmInfo[1],$active,$deviceId);
            if($result === 1) {
                header("LOCATION: http://localhost/ourfarm/device");
            }
            else header("LOCATION: http://localhost/ourfarm/");
        }
    }
?>