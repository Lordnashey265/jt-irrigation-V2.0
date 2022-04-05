#include <ArduinoWiFiServer.h>
#include <BearSSLHelpers.h>
#include <CertStoreBearSSL.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiAP.h>
#include <ESP8266WiFiGeneric.h>
#include <ESP8266WiFiGratuitous.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266WiFiScan.h>
#include <ESP8266WiFiSTA.h>
#include <ESP8266WiFiType.h>
#include <WiFiClient.h>
#include <WiFiClientSecure.h>
#include <WiFiClientSecureBearSSL.h>
#include <WiFiServer.h>
#include <WiFiServerSecure.h>
#include <WiFiServerSecureBearSSL.h>
#include <WiFiUdp.h>
#include <dummy.h>
#include <DHT_U.h>
#include <Adafruit_Sensor.h>
#define DHTPIN 5
#define DHTTYPE DHT22

/************************WI-FI PARAMETERS*************************************/
// Use WiFiClient class to create TCP connections
WiFiClient client;

//creating wifi user and password
char ssid[] = "BEATON";
char pass[] = "bitse111";

int status=WL_IDLE_STATUS;

//ip address of the local_server
char server[]="192.168.43.50";
/*************************************End***************************************/

/***************************Voltage Sensor Parameters***************************/
float voltage=0; //initial voltage value
float r1=30000.0; // 30K ohm from the sensor
float r2=7500.0; // 7.5K ohm from the sensor
float rRatio=(r1+r2)/r2; // Resistor ratio to help us calculate actual input voltage
float resolution; //voltage corresponding to analogue signal 0-4095
int sensorVoltageValue; //AnalogRead() value due to the voltage sensor
int voltagePin=33; //GPIO pin 32 for ADC
/*************************************End***************************************/

/***************************Moisture Sensor Parameters***************************/
int moisture=0; //initial moisture value

/*************************************End***************************************/

/***************************DHT22 Sensor Parameters*****************************/
DHT dht(DHTPIN, DHTTYPE);

float hum;
float temp;
uint32_t delayMS;
/*************************************End***************************************/

void setup() {
  //set baud rate to 115200
  Serial.begin(115200);

  //begin dht22
  dht.begin();
  
  //connecting to wifi
  wifi_connect();
  
}

void loop() {

 //voltage determination
 getDcVoltage(voltagePin); //calculate DC Voltage
 
 //sending data to the client
 client_connect();

 //read data from dht22
 hum=dht.readHumidity();
 temp=dht.readTemperature();

 //read mosture value
 moisture=map(analogRead(A0),0,1024,0,100);
 moisture=100-moisture;
 Serial.print(voltage);
 Serial.print("v");
 Serial.print("\t");
 Serial.print(temp);
 Serial.print("C");
 Serial.print("\t");
 Serial.print(moisture);
 Serial.print("%");
 Serial.print("\t");
 Serial.print(hum);
 Serial.println("%");
 delay(200);
 
}
