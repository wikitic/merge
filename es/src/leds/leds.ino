#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h> 

const char* ssid     = "******";
const char* password = "******";

// Establecer IP, Puerta de Enlace y Máscara
IPAddress ip(192,168,0,200);
IPAddress gateway(192,168,0,1);
IPAddress subnet(255,255,255,0);

// Puerto del servidor web
ESP8266WebServer server(80);

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

  // Arrancar el servidor
  server.on("/", handleRoot);
  server.on("/14/on", encender);
  server.on("/14/off", apagar);
  server.begin();

  // Led
  pinMode(14, OUTPUT);
}

void loop(){
  // Comprobar si estamos conectados
  if (WiFi.status() == WL_CONNECTED) {
    server.handleClient();
  }
  
}

void handleRoot() {
  server.send(200, "text/plain", "Hola Mundo");
}

void encender() {
  server.send(200, "text/plain", "Encender");
  digitalWrite(14, HIGH);
}

void apagar() {
  server.send(200, "text/plain", "Apagar");
  digitalWrite(14, LOW);
}
