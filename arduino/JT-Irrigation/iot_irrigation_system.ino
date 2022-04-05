
#include <Wire.h>
#include<LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
//#include <SPI.h>
//#include <MFRC522.h>
#include <SoftwareSerial.h>
#include "DHT.h"

#define echo D8
#define trigger D4
#define tank_pump D7
#define watering_pump D6
#define moisture_sensor_1 A0
#define moisture_sensor_2 A0
#define DHTPIN_1 D3
#define DHTPIN_2 D2
#define DHTTYPE DHT22   // DHT 11
//int lightPin = D10;
int voltage;
// Initialize DHT sensor.
DHT dht_1(DHTPIN_1, DHTTYPE);
DHT dht_2(DHTPIN_2, DHTTYPE);

long duration;
int distance;
int moisture_value_1;
int moisture_value_2;
int tanklevel;
int moist_percent_1;
int moist_percent_2;
int humidity_1;
int humidity_2;
int temperature_1;
int temperature_2;
int rain;
int lightValue;


LiquidCrystal_I2C lcd(0x27, 20, 4);

const char* ssid = "Z30";// 
const char* password = "11111111";
//WiFiClient client;
char server[] = "192.168.0.5";   //eg: 192.168.0.222


WiFiClient client;    


void setup () {
  lcd.begin(20, 4);
  lcd.init();
  lcd.init();
  lcd.backlight();
  Serial.begin(115200);
  Serial.println("WELCOME.....");
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
 
  // Start the server
//  server.begin();
  Serial.println("Server started");
  Serial.print(WiFi.localIP());
  delay(100);
  Serial.println("connecting...");

  pinMode(echo, INPUT);
  pinMode(moisture_sensor_1, INPUT);
  pinMode(moisture_sensor_2, INPUT);
  pinMode(trigger, OUTPUT);
  digitalWrite(trigger, LOW);
  pinMode(watering_pump, OUTPUT);
  pinMode(tank_pump, OUTPUT);
  //pinMode(lightPin,INPUT);
  digitalWrite(watering_pump, HIGH);
  digitalWrite(tank_pump, LOW);
  dht_1.begin();
  dht_2.begin();
  lcd.setCursor(0, 0);
  lcd.print(" IOT AUTOMATIC "    );
  lcd.setCursor(0, 1);
  lcd.print("IRRIGATION SYSTEM");
  lcd.setCursor(0, 2);
  lcd.print("PROJECT");
  lcd.setCursor(0, 3);
  lcd.print("SIMULATION");
  Serial.println(" IOT AUTOMATIC "    );
  Serial.println("IRRIGATION SYSTEM");
  Serial.println("PROJECT");
  delay(500);
  lcd.clear();
}



void loop() {

  // LEVEL SENSOR
 // lightValue = analogRead(lightPin);
  Serial.print("Light Intensity: ");
  Serial.println(lightValue);
  delay(200);
  rain = digitalRead(22);
  delay(2);
  digitalWrite(trigger, LOW);
  delayMicroseconds(2);
  digitalWrite(trigger, HIGH);
  delayMicroseconds(50);
  digitalWrite(trigger, LOW);
  duration = pulseIn(echo, HIGH);
  distance = duration * 0.017;
  tanklevel = map( distance, 20, 2, 0, 100);
  moisture_value_1 = analogRead(moisture_sensor_1);
  moisture_value_2 = analogRead(moisture_sensor_1);
  moist_percent_1 = map(moisture_value_1, 0, 1023, 100, 0);
  moist_percent_2 = map(moisture_value_2, 0, 1023, 100, 0);
//  condition();
  Serial.println("Distance in CM ");
  Serial.println(distance);


  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  humidity_1 = dht_1.readHumidity();
  humidity_2 = dht_2.readHumidity();
  // Read temperature as Celsius (the default)
  temperature_1 = dht_1.readTemperature();

  Serial.println("temperature_1");
  Serial.println(temperature_1);

  Serial.println("moist_percent_1");
  Serial.println(moist_percent_1);
  
  
  temperature_2 = dht_2.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  //f = dht.readTemperature(true);
  // Check if any reads failed and exit early (to try again).
  voltage=5;

Sending_To_phpmyadmindatabase(); 
delay(10000);

}

void condition() {
  if (isnan(humidity_1) || isnan(humidity_2) || isnan(temperature_1) || isnan(temperature_2)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    lcd.println("Failed to read from DHT sensor!");
    return;
  }
//  if (lightValue > 275 && lightValue << 325 && tanklevel << 100){
//    LCD_11();
//    digitalWrite(tank_pump, HIGH);
//    digitalWrite(watering_pump, LOW);
//    digitalWrite(DHTPIN_1, HIGH);
//    digitalWrite(DHTPIN_2, HIGH);
//    delay(1000);
//
//  }
//  else if(lightValue> 300 && lightValue< 325 && tanklevel > 90 && tanklevel < 101){
//    LCD_12();
//    digitalWrite(tank_pump, LOW);
//    digitalWrite(watering_pump, HIGH);
//    digitalWrite(DHTPIN_1, HIGH);
//    digitalWrite(DHTPIN_2, HIGH);
//    delay(1000);
//  }

  if (tanklevel > 50 && moist_percent_1 < 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0) {
    LCD_1();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);
  }


  else if (tanklevel > 50 && moist_percent_1 < 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {
    LCD_2();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }

  else if (tanklevel < 50 && moist_percent_1 < 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {
    LCD_3();
    digitalWrite(tank_pump, HIGH);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }


  else if (tanklevel > 50 && moist_percent_1 > 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {
    LCD_4();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }

  else if (tanklevel < 50 && moist_percent_1 > 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {
    LCD_5();
    digitalWrite(tank_pump, HIGH);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }

  else if (tanklevel < 50 && moist_percent_1 < 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {
    LCD_6();
    digitalWrite(tank_pump, HIGH);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }
  else if (tanklevel < 50 && moist_percent_1 > 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {
    LCD_10();
    digitalWrite(tank_pump, HIGH);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }

  else if (tanklevel > 50 && moist_percent_1 < 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {
    LCD_7();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }


  else if (tanklevel > 50 && moist_percent_1 > 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 0)
  {

    LCD_8();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);

  }

  ////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////

  if (tanklevel > 50 && moist_percent_1 < 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1) {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);
  }


  else if (tanklevel > 50 && moist_percent_1 < 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);

  }

  else if (tanklevel < 50 && moist_percent_1 < 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);

  }

  else if (tanklevel < 50 && moist_percent_1 > 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);

    delay(50);
  }



  else if (tanklevel > 50 && moist_percent_1 > 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);

  }

  else if (tanklevel < 50 && moist_percent_1 > 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);

  }

  else if (tanklevel < 50 && moist_percent_1 < 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);

  }

  else if (tanklevel > 50 && moist_percent_1 < 50 && moist_percent_2 < 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);

  }


  else if (tanklevel > 50 && moist_percent_1 > 50 && moist_percent_2 > 50 && humidity_1 > 0 && temperature_1 > 0 && humidity_2 > 0 && temperature_2 > 0 && rain == 1)
  {
    LCD_9();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, LOW);
    digitalWrite(DHTPIN_2, LOW);

    delay(50);

  }







///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 if (tanklevel < 90 && moist_percent_1 < 80 && moist_percent_2 < 80 && rain ==0 &&lightValue > 275 && lightValue < 300)
 {
    LCD_11();
    digitalWrite(tank_pump, HIGH);
    digitalWrite(watering_pump, LOW);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);
    delay(1000);
  }

  
  
   else if (tanklevel > 90 && moist_percent_1 <80 && moist_percent_2 <80 && rain == 0 && lightValue> 300 && lightValue< 325)
  {
    LCD_12();
    digitalWrite(tank_pump, LOW);
    digitalWrite(watering_pump, HIGH);
    digitalWrite(DHTPIN_1, HIGH);
    digitalWrite(DHTPIN_2, HIGH);
    delay(1000);

  }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



void LCD_1()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2: ");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%, ");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS ON");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS OFF");
  Serial.println("========================");
}

void LCD_2()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2: ");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS ON");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS OFF");
  Serial.println("========================");
}

void LCD_3()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2:");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS ON");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS ON");
  Serial.println("========================");
}

void LCD_4()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL:");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2:");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS ON");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS OFF");
  Serial.println("========================");
}
void LCD_5()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2: ");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C ");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS ON");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS ON");
  Serial.println("========================");
}

void LCD_6()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2: ");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humi_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS ON");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS ON");
  Serial.println("========================");
}

void LCD_7()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2: ");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS ON");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS OFF");
  Serial.println("========================");
}

void LCD_8()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2: ");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS OFF");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS OFF");
  Serial.println("========================");
}

void LCD_10()
{
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("TANK LEVEL: ");
  lcd.print(tanklevel);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("MOIST_1&2: ");
  lcd.print(moist_percent_1);
  lcd.print("%,");
  lcd.print(moist_percent_2);
  lcd.print("%");
  lcd.setCursor(0, 2);
  lcd.print("Humid_1&2:");
  lcd.print(humidity_1);
  lcd.print("%,");
  lcd.print(humidity_2);
  lcd.print("%");
  lcd.setCursor(0, 3);
  lcd.print("Temp_1&2:");
  lcd.print(temperature_1);
  lcd.print("`C,");
  lcd.print(temperature_2);
  lcd.print("`C");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS OFF");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS ON");
  Serial.println("========================");
}
void LCD_9() {
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("WATERING PUMP IS OFF");
  lcd.setCursor(0, 1);
  lcd.print("TANK PUMP IS OFF");
  lcd.setCursor(0, 2);
  lcd.print("IT`S RAINING");
  Serial.println("========================");
  Serial.println("WATERING PUMP IS OFF");
  //Serial.println("========================");
  Serial.println("TANK PUMP IS OFF");
  //Serial.println("========================");
  Serial.println("IT`S RAINING");
  Serial.println("========================");

}

void LCD_11(){
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("FILLING UP THE TANK");
  lcd.setCursor(0, 1);
  lcd.print("GETTING READY TO");
  lcd.setCursor(0, 2);
  lcd.print("WATER THE GARDEN");
  Serial.println("========================");
  Serial.println("FILLING UP THE TANK");
  //Serial.println("========================");
  Serial.println("GETTING READY TO");
  //Serial.println("========================");
  Serial.println("WATER THE GARDEN");
  Serial.println("========================");

}

void LCD_12(){
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("WATERING");
  lcd.setCursor(3,1);
  lcd.print("THE");
//lcd.setCursor(3, 2);
  lcd.print("GARDEN");
// Serial.println("========================");
//Serial.println("FILLING UP THE TANK");
//Serial.println("========================");
//Serial.println("GETTING READY FOR");
//Serial.println("========================");
 Serial.println("WATERING THE GARDEN");
//Serial.println("========================");

}

 void Sending_To_phpmyadmindatabase()   //CONNECTING WITH MYSQL
 {
   if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:


    client.print("GET /JTirrigation/php/get.php?voltage=");
    client.print(voltage);
    client.print("&temperature=");
    client.print(temperature_1);
    //client.print("&temperature_1=");
    //Serial.println("&humidity= ");
    //client.print(temperature_2);
    //client.print("&temperature_2=");
    
    Serial.println(humidity_1);
    client.print("&humidity=");
    client.print(humidity_1);
    //client.print(humidity_2);
    //client.print("&humidity_1=");
    Serial.println(moist_percent_1);
    
    client.print("&moisture=");
    client.print(moist_percent_1);
    //client.print(moisture_value_2);
    client.print("&tanklevel=");
    client.print(tanklevel);
    //client.print("&rain=");
    //client.print(rain);
    //client.print("&lightValue=");
    //client.print(lightValue);
    client.print(" ");      //SPACE BEFORE HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: localhost");
    client.println("Connection: close");
    client.println();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
 }
