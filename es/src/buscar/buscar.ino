#include <ESP8266WiFi.h>

void setup() {
  Serial.begin(115200);
  
  // Modo cliente
  WiFi.mode(WIFI_STA);
}

void loop() {
  Serial.println("");
  
  // Obtenemos el número de redes encontradas
  int n = WiFi.scanNetworks();
  Serial.print(n);
  Serial.println(" redes encontradas");
  
  // Se imprimen las redes encontradas (SSID e RSSI)
  for (int i = 0; i < n; i++){
    Serial.print(i + 1);
    Serial.print(": ");
    Serial.print(WiFi.SSID(i));
    Serial.print(" (");
    Serial.print(WiFi.RSSI(i));
    Serial.println(")");
    delay(100);
  }
  
  delay(5000);
}
