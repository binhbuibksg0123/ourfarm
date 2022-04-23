<!DOCTYPE html>
<html>

  <head>
    <title>Websockets Using JavaScript MQTT Client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
    <style>
        #messages
        {
        background-color:yellow;
        font-size:3;
        font-weight:bold;
        line-height:140%;
        }
        #status
        {
        background-color:red;
        font-size:4;
        font-weight:bold;
        color:white;
        line-height:140%;
        }
    </style>
 	<script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type = "text/javascript">


	function onConnectionLost(){
	console.log("connection lost");
	document.getElementById("status").innerHTML = "Connection Lost";
	document.getElementById("status_messages").innerHTML ="Connection Lost";
	connected_flag=0;
	}
	function onFailure(message) {
		console.log("Failed");
		document.getElementById("status_messages").innerHTML = "Connection Failed- Retrying";
        setTimeout(MQTTconnect, reconnectTimeout);
        }
	function onMessageArrived(r_message){
		out_msg="Message received "+r_message.payloadString;
		out_msg=out_msg+"      Topic "+r_message.destinationName +"<br/>";
		out_msg="<b>"+out_msg+"</b>";
		//console.log(out_msg+row);
		try{
			document.getElementById("out_messages").innerHTML+=out_msg;
		}
		catch(err){
		document.getElementById("out_messages").innerHTML=err.message;
		}
	
		if (row==10){
			row=1;
			document.getElementById("out_messages").innerHTML=out_msg;
			}
		else
			row+=1;
			
		mcount+=1;
		console.log(mcount+"  "+row);
		}
		
	function onConnected(recon,url){
	console.log(" in onConnected " +reconn);
	}
	function onConnect() {
	  // Once a connection has been made, make a subscription and send a message.
	document.getElementById("status_messages").innerHTML ="Connected to "+host +"on port "+port;
	connected_flag=1;
	document.getElementById("status").innerHTML = "Connected";
	console.log("on Connect "+connected_flag);

	  }
	  function disconnect()
	  {
		if (connected_flag==1)
			mqtt.disconnect();
	  }

    function MQTTconnect() {
	var clean_sessions=document.forms["connform"]["clean_sessions"].value;
	var user_name=document.forms["connform"]["username"].value;
	console.log("clean= "+clean_sessions);
	var password=document.forms["connform"]["password"].value;
	
	if (clean_sessions=document.forms["connform"]["clean_sessions"].checked)
		clean_sessions=true
	else
		clean_sessions=false

	document.getElementById("status_messages").innerHTML ="";
	var s = document.forms["connform"]["server"].value;
	var p = document.forms["connform"]["port"].value;
	if (p!="")
	{
		port=parseInt(p);
		}
	if (s!="")
	{
		host=s;
		console.log("host");
		}

	console.log("connecting to "+ host +" "+ port +"clean session="+clean_sessions);
	console.log("user "+user_name);
	document.getElementById("status_messages").innerHTML='connecting';
	var x=Math.floor(Math.random() * 10000); 
	var cname="orderform-"+x;
	mqtt = new Paho.MQTT.Client(host,port,cname);
	//document.write("connecting to "+ host);
	var options = {
        timeout: 3,
		cleanSession: clean_sessions,
		onSuccess: onConnect,
		onFailure: onFailure,
      
     };
	 if (user_name !="")
		options.userName=document.forms["connform"]["username"].value;
	if (password !="")
		options.password=document.forms["connform"]["password"].value;
	
        mqtt.onConnectionLost = onConnectionLost;
        mqtt.onMessageArrived = onMessageArrived;
		mqtt.onConnected = onConnected;

	mqtt.connect(options);
	return false;
  
 
	}
	function sub_topics(){
		document.getElementById("status_messages").innerHTML ="";
		if (connected_flag==0){
		out_msg="<b>Not Connected so can't subscribe</b>"
		console.log(out_msg);
		document.getElementById("status_messages").innerHTML = out_msg;
		return false;
		}
	var stopic= document.forms["subs"]["Stopic"].value;
	console.log("here");
	var sqos=parseInt(document.forms["subs"]["sqos"].value);
	if (sqos>2)
		sqos=0;
	console.log("Subscribing to topic ="+stopic +" QOS " +sqos);
	document.getElementById("status_messages").innerHTML = "Subscribing to topic ="+stopic;
	var soptions={
	qos:sqos,
	};
	mqtt.subscribe(stopic,soptions);
	return false;
	}
	function send_message(){
		document.getElementById("status_messages").innerHTML ="";
		if (connected_flag==0){
		out_msg="<b>Not Connected so can't send</b>"
		console.log(out_msg);
		document.getElementById("status_messages").innerHTML = out_msg;
		return false;
		}
		var pqos=parseInt(document.forms["smessage"]["pqos"].value);
		if (pqos>2)
			pqos=0;
		var msg = document.forms["smessage"]["message"].value;
		console.log(msg);
		document.getElementById("status_messages").innerHTML="Sending message  "+msg;

		var topic = document.forms["smessage"]["Ptopic"].value;
		//var retain_message = document.forms["smessage"]["retain"].value;
		if (document.forms["smessage"]["retain"].checked)
			retain_flag=true;
		else
			retain_flag=false;
		message = new Paho.MQTT.Message(msg);
		if (topic=="")
			message.destinationName = "test-topic";
		else
			message.destinationName = topic;
		message.qos=pqos;
		message.retained=retain_flag;
		mqtt.send(message);
		return false;
	}

	
    </script>

  </head>
  <body>
    <h1>Websockets MQTT Monitor</h1>
	
	    <script type = "text/javascript">
//ll

</script>


<div id="status">Connection Status: Not Connected</div>

<br>
<table>
<tr>

<td id="connect" width="300" >

	 <form name="connform" action="" onsubmit="return MQTTconnect()">

Server:  <input type="text" name="server"><br><br>
Port:    <input type="text" name="port"><br><br>
Clean Session: <input type="checkbox" name="clean_sessions" value="true" checked><br><br>
Username: <input type="text" name="username" value=""><br><br>
Password: <input type="text" name="password" value=""><br><br>
<input name="conn" type="submit" value="Connect">
<input TYPE="button" name="discon " value="DisConnect" onclick="disconnect()">
</form>
</td>
<td id="subscribe" width="300">
<form name="subs" action="" onsubmit="return sub_topics()">
Subscribe Topic:   <input type="text" name="Stopic"><br>
Subscribe QOS:   <input type="text" name="sqos" value="0"><br>
<input type="submit" value="Subscribe">
</form> 
</td>
<td id="publish" width="300">
<form name="smessage" action="" onsubmit="return send_message()">

Message: <input type="text" name="message"><br><br>
Publish Topic:   <input type="text" name="Ptopic"><br><br>
Publish QOS:   <input type="text" name="pqos" value="0"><br>
Retain Message:   <input type="checkbox" name="retain" value="true" ><br>
<input type="submit" value="Submit">
</form>
</td>
</tr>
</table>
Status Messages:
<div id="status_messages">
</div>
Received Messages:

<div id="out_messages">
</div>
	<script>
	var connected_flag=0	
	var mqtt;
    var reconnectTimeout = 2000;
	var host="192.168.1.157";
	var port=9001;
	var row=0;
	var out_msg="";
	var mcount=0;
	</script>
  </body>
</html>
