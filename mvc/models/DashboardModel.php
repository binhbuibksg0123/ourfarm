<?php
class DashboardModel extends DB{
    function addFarm($farmName,$serverName,$port,$userName,$password){
        $query = "insert into Farm (farm_name,servername,port,username,password)
                values('".$farmName."','".$serverName."','".$port."','".$userName."','".$password."')";
        $result = $this->con->query($query);
        if($result === FALSE){
            return 0;
        }
        else return 1;
    }
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
}
?>