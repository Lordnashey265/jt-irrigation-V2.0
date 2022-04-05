//get analogue reading from voltage sensor
void getDcVoltage(int pin){
  sensorVoltageValue = analogRead(pin); //latest analogRead()
  resolution=5/5320.0; //aproximate resolution after tricky calculations
  voltage=float(sensorVoltageValue)*resolution*rRatio; //voltage reading
}
