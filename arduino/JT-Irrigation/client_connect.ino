void client_connect() {
   if(client.connect(server, 80)) {
    client.print("GET /jt-irrigation/php/get.php?voltage="); //specify the page that will receive data and parameters
    client.print(voltage);
    client.print("&temperature=");
    client.print(temp);
    client.print("&humidity=");
    client.print(hum);
    client.print("&moisture=");
    client.print(moisture);
    client.println(" "); //space b4 HTTP/1.1
    client.print("HTTP/1.1");
    client.println();
    client.print("Host: ");
    client.println(server); 
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.println();      
  } else {
    Serial.println("Failed To Connect To 192.168.43.50 (Contact Tinashe Kubiku...)");
  }
  if(client.connected()) {
    client.stop();
  }
}
