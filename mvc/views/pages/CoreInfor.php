<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard OurFarm</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/ourfarm/public/css/CoreInfor.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
    <div id="mainContent">
        <h3 id="coreH3"><span class="textInHorizon">CORE INFORMATION</span></h3>
        <select id="farmSelect" onchange="changeFarm()">
            <?php
            for ($i = 0;$i<sizeof($data["farmArr"]);$i++){
                if($data["farmArr"][$i]["farm_name"]==$_SESSION["farmName"])
                echo "<option value=\"".$i."\">
                ".$data["farmArr"][$i]["farm_name"]."
            </option>";
            }
            for ($i = 0;$i<sizeof($data["farmArr"]);$i++){
                if($data["farmArr"][$i]["farm_name"]!=$_SESSION["farmName"])
                echo "<option value=\"".$i."\">
                ".$data["farmArr"][$i]["farm_name"]."
            </option>";
            }
            ?>
        </select>
        <sub>as at Aug 16,2020,7:47:42 PM</sub>
        <br>
        <div id="farmFunc">
            <i class="fas fa-plus" onclick="openForm()"></i>
            <i class="fas fa-minus"></i>
            <i class="fas fa-pencil-alt"></i>
        </div>
        
        <form action="#" id="overViewForm">
            <button class="PageButton" id="overViewButton">Overview</button>
        </form>
        <div id="dashDiv">
            <div>
                <p class="nameInfor">Luminosity</p>
                <p class="infor"><i class="fas fa-sun"></i><span id="lumiView">---</span></p>
            </div>
            <div>
                <p class="nameInfor">Temperature</p>
                <p class="infor"><i class="fas fa-temperature-high"></i><span id="tempView">---</span><sup>o</sup>C</p>
            </div>
            <div>
                <p class="nameInfor">Humidity</p>
               <p class="infor"> <i class="fas fa-tint"></i><span id="humidView">---</span>%</p>
            </div>
        </div>
        <!--server,port,username,pass,farmName-->
        <div id="addFarm">
            
            <div id="formFarm">
                <i class="fas fa-minus" onclick="closeForm()"></i>
                <h3>Add Farm </h3>
                <form name="addForm" id="addForm" onsubmit="return MQTTconnect()" method="post" action="/ourfarm/dashboard/addFarmHandling">
                    <label>
                        Farm Name:<input type="text" name="farmName" id="farmName" required>
                    </label>
                    <label>
                        Server Name:<input type="text" name="server" id="server" required>
                    </label>
                    <label>
                        Port Number:<input type="number" name="port" min="1" max="65535" id="port" required>
                    </label>
                    <label>
                        Username:<input type="text" name="username" id="username" required>
                    </label>
                    <label>
                        Password:<input type="password" name="password" id="password" required>
                    </label>
                    <div id="status_messages"></div>
                    <button class="PageButton" id="cancelButton" onclick="closeForm()">Cancel</button>
                    <button class="PageButton" id="saveButton">Save</button>
                </form>
            </div>
        </div>

        <script>
            <?php $session_value=(isset($_SESSION['farmName']))?$_SESSION['farmName']:''; ?>
            $('#farmSelect').change(function(){
                var farmIndex = $(this).find(':selected').attr('value');
                $.ajax({
                    type:'POST',
                    url:'/ourfarm/dashboard/addsession',
                    data:{'index':farmIndex}
                });
                location.reload();
            });
            $(document).ready(function(){
                
                var farmInfo = <?php echo json_encode($data["farmArr"]); ?>;
                var sessionValue = '<?php echo $session_value;?>'
                if(sessionValue != ''){
                    for (let i = 0;i<farmInfo.length;i++){
                        if(farmInfo[i].farm_name == sessionValue) {
                            MQTTShowDashBoard(farmInfo[i].username,farmInfo[i].password,farmInfo[i].servername,farmInfo[i].port);
                            break;
                        }
                    }
                }
                
            });
            let feedInfo;
            function onConnectionLost(){
                console.log("connection lost");
                connected_flag=0;
            }
            function onMessageArrived(r_message){
                out_msg="Message received "+r_message.payloadString;
                out_msg=out_msg+"      Topic "+r_message.destinationName +"<br/>";
                out_msg="<b>"+out_msg+"</b>";
                console.log(out_msg);
                
                
                if(r_message.destinationName == feedInfo.Luminosity){
                    document.getElementById("lumiView").innerHTML=r_message.payloadString;
                }
                else if(r_message.destinationName == feedInfo.Humidity){
                    document.getElementById("humidView").innerHTML=r_message.payloadString;
                }
                else if(r_message.destinationName == feedInfo.Temperature){
                    document.getElementById("tempView").innerHTML=r_message.payloadString;
                }
                // try{
                //     document.getElementById("out_messages").innerHTML+=out_msg;
                // }
                // catch(err){
                // document.getElementById("out_messages").innerHTML=err.message;
                // }
            
                // if (row==10){
                //     row=1;
                //     document.getElementById("out_messages").innerHTML=out_msg;
                //     }
                // else
                //     row+=1;
                    
                // mcount+=1;
                // console.log(mcount+"  "+row);
            }
                
            function onConnected(recon,url){
                console.log(" in onConnected " +reconn);
            }
            function changeFarm(){
                var result = document.getElementById("farmSelect").value;
                var farmInfo = <?php echo json_encode($data["farmArr"]); ?>;
                document.getElementById("lumiView").innerHTML = "---";
                document.getElementById("humidView").innerHTML = "---";
                document.getElementById("tempView").innerHTML = "---";
                MQTTShowDashBoard(farmInfo[result].username,farmInfo[result].password,farmInfo[result].servername,farmInfo[result].port);
            }
            function openForm(){
                document.getElementById("addFarm").style.display = "block";
            }
            function closeForm(){
                document.getElementById("addFarm").style.display = "none";
            }
            function onConnect() {
                // Once a connection has been made, make a subscription and send a message.
                document.getElementById("status_messages").innerHTML ="Connected to "+host +"on port "+port;
                connected_flag=1;
                console.log("on Connect "+connected_flag);
                document.getElementById("addForm").submit();
	        }
            function onConnect1() {
                // Once a connection has been made, make a subscription and send a message.
                connected_flag=1;
                console.log("on Connect "+connected_flag);
                var session = '<?php echo $_SESSION["farmName"];?>';
                var deviceArr = <?php echo json_encode($data["deviceArr"]);?>;
                feedInfo = {};
                for(var i = 0;i<deviceArr.length;i++){
                    if(deviceArr[i].farm_name == session && deviceArr[i].dashboard_view == 1){
                        if(deviceArr[i]["type"] == "Luminosity") feedInfo.Luminosity = deviceArr[i].feed_id;
                        else if(deviceArr[i]["type"] == "Temperature") feedInfo.Temperature = deviceArr[i].feed_id;
                        else if(deviceArr[i]["type"] == "Humidity") feedInfo.Humidity = deviceArr[i].feed_id;
                        sub_topics(deviceArr[i].feed_id);
                    }
                }
                // else if(feedInfo["Humidity"]){
                //     sub_topics(feedInfo["Humidity"]);
                // }
                // else if(feedInfo["Temperature"]){
                //     sub_topics(feedInfo["Temperature"]);
                // }
                // sub_topics("binhbuibksg0123/feeds/ourfarm-humid");
                // sub_topics("binhbuibksg0123/feeds/ourfarm-lumi");
                // sub_topics("binhbuibksg0123/feeds/ourfarm-temp");
	        }
            function onFailure(message) {
                console.log("Failed");
                document.getElementById("status_messages").innerHTML = "Connection Failed- Retrying";
                setTimeout(MQTTconnect, reconnectTimeout);
            }
            function MQTTconnect() {
                var user_name=document.getElementById("username").value;
                var password=document.getElementById("password").value;

                document.getElementById("status_messages").innerHTML ="";
                var s = document.getElementById("server").value;
                var p = document.getElementById("port").value;
                if (p!="")
                {
                    port=parseInt(p);
                    }
                if (s!="")
                {
                    host=s;
                    console.log("host");
                    }

                console.log("connecting to "+ host +" "+ port);
                console.log("user "+user_name);
                document.getElementById("status_messages").innerHTML='connecting';
                var x=Math.floor(Math.random() * 10000); 
                var cname="orderform-"+x;
                mqtt = new Paho.MQTT.Client(host,port,cname);
                //document.write("connecting to "+ host);
                var options = {
                    timeout: 3,
                    onSuccess: onConnect(),
                    onFailure: onFailure,
                
                };
                if (user_name !="")
                    options.userName=user_name;
                if (password !="")
                    options.password=password;
                mqtt.connect(options);
                return false;
	        }
            function MQTTShowDashBoard(user_name,password,s,p) {
                if (p!="")
                {
                    port=parseInt(p);
                    }
                if (s!="")
                {
                    host=s;
                    console.log("host");
                    }

                console.log("connecting to "+ host +" "+ port);
                console.log("user "+user_name);
                var x=Math.floor(Math.random() * 10000); 
                var cname="orderform-"+x;
                mqtt = new Paho.MQTT.Client(host,port,cname);
                //document.write("connecting to "+ host);
                var options = {
                    timeout: 3,
                    onSuccess: onConnect1,
                    onFailure: onFailure,
                };
                if (user_name !="")
                    options.userName=user_name;
                if (password !="")
                    options.password=password;

                mqtt.onConnectionLost = onConnectionLost;
                mqtt.onMessageArrived = onMessageArrived;
                mqtt.onConnected = onConnected;
                mqtt.connect(options);
                return false;
	        }
            function sub_topics(feedId){
                var soptions={
                qos:0,
                };
                mqtt.subscribe(feedId,soptions);
                console.log("Subscribing to topic ="+feedId);
                mqtt.subscribe(feedId);
	        }
        </script>
        </div>
    </body>
</html>