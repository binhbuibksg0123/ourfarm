<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard OurFarm</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/ourfarm/public/css/Device.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        
    </head>
    <body>
        <div class="mainClass">
            <main>
                <div id="mainContent">
                    <!-- <div id="farmFunc">
                        <i class="fas fa-minus"></i>
                        <i class="fas fa-pencil-alt"></i>
                    </div> -->
                    <button class="PageButton" id="overViewButton" onclick="openForm('addFarm')"><i class="fas fa-plus"></i>Device</button>
                    <table style="width:100%">
                        <tr>
                          <th>Device Farm</th>
                          <th>Device ID</th>
                          <th>Device Type</th>
                          <th>Action</th>
                        </tr>
                            <?php
                                if(isset($data["deviceArr"]))
                                for ($i = 0;$i<sizeof($data["deviceArr"]);$i++){
                                //     echo "<option value=\"".$data["deviceArr"][$i]["farm_id"]."\">
                                //     ".$data["farmArr"][$i]["farm_name"]."
                                // </option>";
                                //farm_id,description,feed_id,type,device_name,dashboard_view
                                    echo "<tr>
                                            <td>".$data["deviceArr"][$i]["farm_name"]."</td>
                                            <td>".$data["deviceArr"][$i]["device_id"]."</td>
                                            <td>".$data["deviceArr"][$i]["type"]."</td>
                                            <td>
                                                <div id=\"farmFunc\">
                                                    <i class=\"fas fa-pencil-alt\" onclick=\"openForm('editFarm','".$data["deviceArr"][$i]["device_name"]."','".$data["deviceArr"][$i]["farm_name"]."','".$data["deviceArr"][$i]["description"]."','".$data["deviceArr"][$i]["feed_id"]."','".$data["deviceArr"][$i]["type"]."',".$data["deviceArr"][$i]["dashboard_view"].",".$data["deviceArr"][$i]["active"].",".$data["deviceArr"][$i]["device_id"].",'".$data["farmAddress"][$data["deviceArr"][$i]["farm_name"]]["servername"]."',".$data["farmAddress"][$data["deviceArr"][$i]["farm_name"]]["port"].",'".$data["farmAddress"][$data["deviceArr"][$i]["farm_name"]]["username"]."','".$data["farmAddress"][$data["deviceArr"][$i]["farm_name"]]["password"]."')\"></i>
                                                    <i class=\"fas fa-minus\"></i>
                                                </div>
                                            </td>
                                        </tr>";
                               }
                            ?>
                      </table>
                    <!--server,port,username,pass,farmName-->
                    <div id="addFarm" class="divDeviceFarm"> 
                        <div id="formFarm" class="formDeviceFarm">
                            <i class="fas fa-minus" onclick="closeForm('addFarm')"></i>
                            <h3>Add Device </h3>
                            <form  method="post" action="/ourfarm/device/addDeviceHandling">
                                <label>
                                    Device Name:<input type="text" name="deviceName" required>
                                </label>
                                <label>
                                    Farm Name:
                                    <select name="farmId">
                                        <?php
                                            $index = -1;
                                            for ($i = 0;$i<sizeof($data["farmArr"]);$i++){
                                                echo "<option value=\"".$data["farmArr"][$i]["farm_id"]."|".$data["farmArr"][$i]["farm_name"]."\">
                                                ".$data["farmArr"][$i]["farm_name"]."
                                            </option>";
                                            }
                                        ?>
                                    </select>
                                </label>
                                <label>
                                    Description:<textarea name="descript"></textarea>
                                </label>
                                <label>
                                    FeedID:<input type="text" name="feedId" required>
                                </label>
                                <label>
                                    Device Type:
                                    <select name="deviceType">
                                        <option value="Luminosity">Luminosity</option>
                                        <option value="Temperature">Temperature</option>
                                        <option value="Humidity">Humidity</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </label>
                                <lable>
                                    Dashboard View:
                                    <input type="checkbox" name="dashboardView">
                                </lable>
                                <lable>
                                    Active:
                                    <input type="checkbox" name="activeCheckboxRegis" checked>
                                </lable>
                                <br>
                                <button class="PageButton" id="cancelButton" onclick="closeForm()">Cancel</button>
                                <button class="PageButton" id="saveButton">Save</button>
                            </form>
                        </div>
                    </div>
                    <div class="divDeviceFarm" id="editFarm"> 
                        <div class="formDeviceFarm">
                            <i class="fas fa-minus" onclick="closeForm('editFarm')"></i>
                            <h3>Edit Device </h3>
                            <form  method="post" action="/ourfarm/device/editDeviceHandling">
                                <input type="text" name="deviceId" id="deviceId" value="" hidden>
                                <label>
                                    Device Name:<input type="text" name="deviceNameEdit" id="deviceName" required>
                                </label>
                                <label>
                                    Farm Name:
                                    <select name="farmIdEdit" id="farmId">
                                        <?php
                                            for ($i = 0;$i<sizeof($data["farmArr"]);$i++){
                                                echo "<option value=\"".$data["farmArr"][$i]["farm_id"]."|".$data["farmArr"][$i]["farm_name"]."\">
                                                ".$data["farmArr"][$i]["farm_name"]."
                                            </option>";
                                            }
                                        ?>
                                    </select>
                                </label>
                                <label>
                                    Description:<textarea name="descriptEdit" id="des"></textarea>
                                </label>
                                <label>
                                    FeedID:<input type="text" name="feedIdEdit" id="feedId" required>
                                </label>
                                <label>
                                    Device Type:
                                    <select name="deviceTypeEdit" id="deviceType">
                                        <option value="Luminosity">Luminosity</option>
                                        <option value="Temperature">Temperature</option>
                                        <option value="Humidity">Humidity</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </label>
                                <lable>
                                    Dashboard View:
                                    <input type="checkbox" name="dashboardViewEdit" id="dashboardView">
                                </lable>
                                <lable>
                                    Active:
                                    <input type="checkbox" name="activeCheckboxEdit" id="activeCheckbox">
                                </lable>
                                <br>
                                <button class="PageButton" id="cancelButton" onclick="closeForm('editFarm')">Cancel</button>
                                <button class="PageButton" id="saveButton" onclick="saveForm()">Save</button>
                            </form>
                        </div>
                    </div>
                    <script src="/ourfarm/public/js/MQTTConnect.js">
                        
                    </script>
                    <script>
                        
                        function openForm(func,deviceName,farmName,des,feedId,type,dashView,active,deviceId,servername,port,username,password){
                            document.getElementById(func).style.display = "block";
                            if(func == 'editFarm'){
                                document.getElementById('deviceName').value = deviceName;
                                var farmNameSelect = document.getElementById('farmId');
                                var farmNameOption = farmNameSelect.options;
                                for(var i = 0;i < farmNameOption.length;i++){
                                    if(farmNameOption[i].value.split("|")[1] == farmName){
                                        farmNameOption[i].selected = true;
                                    }
                                }
                                // document.getElementById('farmId').value = farmName;
                                document.getElementById('des').value = des;
                                document.getElementById('feedId').value = feedId;
                                var deviceTypeSelect = document.getElementById('deviceType');
                                var deviceTypeOption = deviceTypeSelect.options;
                                for(var i = 0;i < deviceTypeOption.length;i++){
                                    if(deviceTypeOption[i].value == type){
                                        deviceTypeOption[i].selected = true;
                                    }
                                }
                                if(dashView == 1){
                                    document.getElementById('dashboardView').checked = true;
                                }
                                if(active == 1){
                                    document.getElementById('activeCheckbox').checked = true;
                                }
                                document.getElementById('deviceId').value = deviceId;
                                MQTTShowDashBoard(username,password,servername,port);
                                
                            }
                            
                        }
                        function closeForm(func){
                            document.getElementById(func).style.display = "none";
                            location.reload();
                        }
                        function saveForm(){
                            msg = '0';
                            if(document.getElementById('activeCheckbox').checked){
                                msg = '1';
                            }
                            topic = document.getElementById('feedId').value;
                            alert('dsa');
                            send_message(msg,topic);
                            
                        }
                    </script>
                </div>
            </main>
        </div>
    </body>
</html>