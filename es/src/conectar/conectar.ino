#include <ESP8266WiFi.h>
 
const char* ssid = "NOMBRE";
const char* password = "PASSWORD";
 
void setup () {
  Serial.begin(115200);

  // Conectar a la WiFi
  WiFi.begin(ssid, password);

  // Modo cliente
  WiFi.mode(WIFI_STA);

  // Esperar hasta conectar
  while (WiFi.status() != WL_CONNECTED)
    delay(200);
}
 
void loop() {
  // Comprobar si estamos conectados
  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("Conectado");
  }
  
  delay(5000);
}
