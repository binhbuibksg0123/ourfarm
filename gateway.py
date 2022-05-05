import serial.tools.list_ports
import random
import time
import  sys
from  Adafruit_IO import  MQTTClient
# php_flag display_startup_errors on
# php_flag display_errors on
AIO_FEED_IDS = ["bbc-led","ourfarm-recipe"]


AIO_USERNAME = "binhbuibksg0123"
AIO_KEY = "aio_fHuR31Pi9nfgXdE2wD7VOR5GYAld"

def  connected(client):
    print("Ket noi thanh cong...")
    for feed in AIO_FEED_IDS:
        client.subscribe(feed)

def  subscribe(client , userdata , mid , granted_qos):
    print("Subcribe thanh cong...")

def  disconnected(client):
    print("Ngat ket noi...")
    sys.exit (1)

def  message(client , feed_id , payload):
    print("Nhan du lieu: " + payload + feed_id)
    if isMicrobitConnected:
        ser.write((str(payload) + "#").encode())

client = MQTTClient(AIO_USERNAME , AIO_KEY)
client.on_connect = connected
client.on_disconnect = disconnected
client.on_message = message
client.on_subscribe = subscribe
client.connect()
client.loop_background()

def getPort():
    ports = serial.tools.list_ports.comports()
    N = len(ports)
    commPort = "None"
    for i in range(0, N):
        port = ports[i]
        strPort = str(port)
        if "USB Serial Device" in strPort:
            splitPort = strPort.split(" ")
            commPort = (splitPort[0])
    return commPort

isMicrobitConnected = False
if getPort() != "None":
    ser = serial.Serial( port=getPort(), baudrate=115200)
    isMicrobitConnected = True


def processData(data):
    data = data.replace("!", "")
    data = data.replace("#", "")
    splitData = data.split(":")
    print(splitData)
    if splitData[1] == "TEMP":
        client.publish("bbc-temp", splitData[2])

mess = ""
def readSerial():
    bytesToRead = ser.inWaiting()
    if (bytesToRead > 0):
        global mess
        mess = mess + ser.read(bytesToRead).decode("UTF-8")
        while ("#" in mess) and ("!" in mess):
            start = mess.find("!")
            end = mess.find("#")
            processData(mess[start:end + 1])
            if (end == len(mess)):
                mess = ""
            else:
                mess = mess[end+1:]

while True:
    value = random . randint (0 , 100)
    print ("Cap nhat humid:", value )
    client.publish ("ourfarm-humid", value )
    time . sleep (3)
    print ("Cap nhat lumi:", value )
    client.publish ("ourfarm-lumi", value - 1)
    time . sleep (3)
    print ("Cap nhat temp:", value )
    client.publish ("ourfarm-temp", value - 2)
    time . sleep (3)