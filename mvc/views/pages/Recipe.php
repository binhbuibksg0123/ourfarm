<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard OurFarm</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/ourfarm/public/css/Recipe.css" type="text/css" rel="stylesheet">
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
                    <button class="PageButton" id="overViewButton" onclick="openForm('addFarm')"><i class="fas fa-plus"></i>Recipe</button>
                    <table style="width:100%">
                        <tr>
                          <th>FarmZone</th>
                          <th>Luminosity</th>
                          <th>Temperature</th>
                          <th>Humidity</th>
                          <th>Action</th>
                        </tr>
                            <?php
                                if(isset($data["recipeArr"]))
                                for ($i = 0;$i<sizeof($data["recipeArr"]);$i++){
                                //     echo "<option value=\"".$data["deviceArr"][$i]["farm_id"]."\">
                                //     ".$data["farmArr"][$i]["farm_name"]."
                                // </option>";
                                //farm_id,description,feed_id,type,device_name,dashboard_view
                                    echo "<tr>
                                            <td>".$data["recipeArr"][$i]["farm_name"]."</td>
                                            <td>Min:".$data["recipeArr"][$i]["min_lumi"]."|Max:".$data["recipeArr"][$i]["max_lumi"]."|Optimal:".$data["recipeArr"][$i]["optimal_lumi"]."</td>
                                            <td>Min:".$data["recipeArr"][$i]["min_humid"]."|Max:".$data["recipeArr"][$i]["max_humid"]."|Optimal:".$data["recipeArr"][$i]["optimal_humid"]."</td>
                                            <td>Min:".$data["recipeArr"][$i]["min_temper"]."|Max:".$data["recipeArr"][$i]["max_temper"]."|Optimal:".$data["recipeArr"][$i]["optimal_temper"]."</td>
                                            <td>
                                                <div id=\"farmFunc\">
                                                    <i class=\"fas fa-pencil-alt\" onclick=\"openForm('editFarm')\"></i>
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
                            <h3>Add Recipe </h3>
                            <form  method="post" action="/ourfarm/recipe/addRecipeHandling">
                                <label>
                                    Farm Name:
                                    <select id="farmId" name="farmId" onchange="changeFarm()">
                                        <?php
                                            for ($i = 0;$i<sizeof($data["farmArr"]);$i++){
                                                echo "<option  value=\"".$data["farmArr"][$i]["farm_id"]."|".$data["farmArr"][$i]["farm_name"]."|".$data["farmArr"][$i]["servername"]."|".$data["farmArr"][$i]["port"]."|".$data["farmArr"][$i]["username"]."|".$data["farmArr"][$i]["password"]."\">
                                                ".$data["farmArr"][$i]["farm_name"]."
                                            </option>";
                                            }
                                        ?>
                                    </select>
                                </label>
                                <label>
                                    Min Humid:<input type="number" name="minHumid" id="minHumid">
                                </label>
                                <label>
                                    Max Humid:<input type="number" id="maxHumid" name="maxHumid">
                                </label>
                                <label>
                                    Optimal Humid:<input type="number" id="optimalHumid" name="optimalHumid">
                                </label>
                                <label>
                                    Min Temper:<input type="number" id="minTemper" name="minTemper">
                                </label>
                                <label>
                                    Max Temper:<input type="number" id="maxTemper" name="maxTemper">
                                </label>
                                <label>
                                    Optimal Temper:<input type="number" id="optimalTemper" name="optimalTemper">
                                </label>
                                <label>
                                    Min Lumi:<input type="number" id="minLumi" name="minLumi">
                                </label>
                                <label>
                                    Max Lumi:<input type="number" id="maxLumi" name="maxLumi">
                                </label>
                                <label>
                                    Optimal Lumi:<input type="number" id="optimalLumi" name="optimalLumi">
                                </label>
                                <br>
                                <button class="PageButton" id="cancelButton" onclick="closeForm()">Cancel</button>
                                <button class="PageButton" id="saveButton" onclick="sendMess()">Save</button>
                            </form>
                        </div>
                    </div>
                    <div class="divDeviceFarm" id="editFarm"> 
                        <div class="formDeviceFarm">
                            <i class="fas fa-minus" onclick="closeForm('editFarm')"></i>
                            <h3>Edit Recipe </h3>
                            <form  method="post">
                                <label>
                                    Farm Name:
                                    <select name="farmId">
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
                                    Min Humid:<input type="number" id="minHumid">
                                </label>
                                <label>
                                    Max Humid:<input type="number" id="maxHumid">
                                </label>
                                <label>
                                    Optimal Humid:<input type="number" id="optimalHumid">
                                </label>
                                <label>
                                    Min Temper:<input type="number" id="minTemper">
                                </label>
                                <label>
                                    Max Temper:<input type="number" id="maxTemper">
                                </label>
                                <label>
                                    Optimal Temper:<input type="number" id="optimalTemper">
                                </label>
                                <label>
                                    Min Lumi:<input type="number" id="minLumi">
                                </label>
                                <label>
                                    Max Lumi:<input type="number" id="maxLumi">
                                </label>
                                <label>
                                    Optimal Lumi:<input type="number" id="optimalLumi">
                                </label>
                                <br>
                                <button class="PageButton" id="cancelButton" onclick="closeForm()">Cancel</button>
                                <button class="PageButton" id="saveButton">Save</button>
                            </form>
                        </div>
                    </div>
                    <script src="/ourfarm/public/js/MQTTConnect.js">
                        
                    </script>
                    <script>
                        
                        function openForm(func,deviceName,farmName,des,feedId,type,dashView,active,deviceId,servername,port,username,password){
                            document.getElementById(func).style.display = "block";
                            changeFarm();
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
                        function changeFarm(){
                            var farmInfo = document.getElementById('farmId').value;
                            farmInfo = farmInfo.split('|');
                            MQTTShowDashBoard(farmInfo[4],farmInfo[5],farmInfo[2],farmInfo[3]);

                            // send_message(msg,topic);
                            // topic = document.getElementById('feedId').value;
                            // alert('dsa');
                            // send_message(msg,topic);
                        }
                        function sendMess(){
                            var minLumi = document.getElementById("minLumi").value;
                            var maxLumi = document.getElementById("maxLumi").value;
                            var optimalLumi = document.getElementById("optimalLumi").value;
                            var minHumid = document.getElementById("minHumid").value;
                            var maxHumid = document.getElementById("maxHumid").value;
                            var optimalHumid = document.getElementById("optimalHumid").value;
                            var minTemper = document.getElementById("minTemper").value;
                            var maxTemper = document.getElementById("maxTemper").value;
                            var optimalTemper = document.getElementById("optimalTemper").value;
                            var msg = {
                                lumi: [minLumi,maxLumi,optimalLumi],
                                humid: [minHumid,maxHumid,optimalHumid],
                                temper: [minTemper,maxTemper,optimalTemper]
                            };
                            msg = JSON.stringify(msg);
                            topic = 'binhbuibksg0123/feeds/ourfarm-recipe';
                            send_message(msg,topic);
                        }
                    </script>
                </div>
            </main>
        </div>
    </body>
</html>