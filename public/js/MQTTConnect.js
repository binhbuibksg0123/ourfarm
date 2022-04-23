function onFailure(message) {
    console.log("Failed");
    setTimeout(MQTTconnect, reconnectTimeout);
}
function onMessageArrived(){

}
function onConnect() {
    // Once a connection has been made, make a subscription and send a message.
    connected_flag=1;
    console.log("on Connect "+connected_flag);

}
function onConnectionLost(){
    console.log("connection lost");
    connected_flag=0;
}
function onConnected(recon,url){
    console.log(" in onConnected " +reconn);
}
function send_message(msg,topic){
    console.log("Sending message " + msg);

    //var retain_message = document.forms["smessage"]["retain"].value;
    message = new Paho.MQTT.Message(msg);
    if (topic=="")
        message.destinationName = "test-topic";
    else
        message.destinationName = topic;
    mqtt.send(message);
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
        onSuccess: onConnect,
        onFailure: onFailure,
    };
    if (user_name !="")
        options.userName=user_name;
    if (password !="")
        options.password=password;

    mqtt.onMessageArrived = onMessageArrived;
    mqtt.onConnectionLost = onConnectionLost;
    mqtt.onConnected = onConnected;
    mqtt.connect(options);
    return false;
}