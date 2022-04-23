<?php 
    class DeviceModel extends DB{
        function getDeviceInfor(){
            $query = "select * from Device";
            $result = $this->con->query($query);
            $listDevice = array();
            while($row = mysqli_fetch_array($result)){
                $listDevice[] = $row;
            }
            return json_encode($listDevice);
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
        function setDashboardZero($farmName,$type){
            $query = "update Device set dashboard_view = '0' where farm_name='$farmName' and type = '$type'";
            $this->con->query($query);
        }
        function addDevice($farmId,$descript,$feedId,$type,$deviceName,$boolView,$farmName,$active){
            $query = "insert into Device (farm_id,description,feed_id,type,device_name,dashboard_view,farm_name,active)
                values('".$farmId."','".$descript."','".$feedId."','".$type."','".$deviceName."','".$boolView."','".$farmName."','".$active."')";
            $result = $this->con->query($query);
            if($result === FALSE){
                return 0;
            }
            else return 1;
        }
        function updateDevice($farmId,$descript,$feedId,$type,$deviceName,$boolView,$farmName,$active,$deviceId){
            $query = "UPDATE Device SET description = '$descript',feed_id = '$feedId',farm_id = '$farmId',type = '$type',device_name = '$deviceName',dashboard_view = '$boolView',farm_name = '$farmName',active = '$active' WHERE device_id = $deviceId";
            $result = $this->con->query($query);
            if($result === FALSE){
                return 0;
            }
            else return 1;
        }
    }
?>