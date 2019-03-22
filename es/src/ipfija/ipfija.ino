#include <ESP8266WiFi.h>

const char* ssid     = "******";
const char* password = "******";

// Establecer IP, Puerta de Enlace y Máscara
IPAddress ip(192,168,0,200);
IPAddress gateway(192,168,0,1);
IPAddress subnet(255,255,255,0);

void setup() {
  Serial.begin(115200);

  // Conectar a la WiFi
  WiFi.begin(ssid, password);

  // Modo cliente
  WiFi.mode(WIFI_STA);
  WiFi.config(ip, gateway, subnet);

  // Esperar hasta conectar
  while (WiFi.status() != WL_CONNECTED)
    delay(200);
}

void loop(){
  // Comprobar si estamos conectados
  if (WiFi.status() == WL_CONNECTED) {
    Serial.print("Conectado a ");
    Serial.println(WiFi.localIP());
  }
  
  delay(5000);
}
