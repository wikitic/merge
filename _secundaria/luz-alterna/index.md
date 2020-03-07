---
layout: practica

title: Luz alterna

authors: ['Miguel Ángel Abellán']

nivel: 1
---

# Luz alterna

El objetivo de esta práctica es programar dos luces que parpadean de forma alterna con una frecuencia de 1 segundo, es decir, se va a programar un código encargado de encender y apagar dos LEDs (haciendo uso de las salidas digitales).

![](practica.gif)

## Materiales

- 1 Arduino UNO
- 1 Protoboard
- 4 Latiguillos
- 2 LEDs
- 2 Resistencias de 220Ω (rojo-rojo-marrón)

## Esquema eléctrico

| Características LED              |        |
| -------------------------------- | ------ |
| Polarizado                       | Sí     |
| Intensidad de Corriente          | 20mA   |
| Tensión Led (verde, ámbar, rojo) | 2.1V   |
| Tensión Led blanco               | 3.3V   |

**Cálculo de la resistencia para el LED**

<pre>
V = 5V - 2.1V = 2.9V
I = 20mA

V = I x R ; R = V / I

R = 2.9V / 0.02A = 145Ω -> 220Ω (por aproximación)
</pre>

Se conecta el LED de color rojo al pin digital 13 y el LED de color verde al pin digital 12 de la placa de arduino (utilizando su debida resistencia). La patilla larga del LED debe ser conectada al voltaje positivo (ánodo) y la corta al voltaje negativo (cátodo) pasando por la resistencia.

![](fritzing.png)

## Programación en mBlock

Al ejecutar el código se deberá establecer en el pin digital 13 un valor alto y en el pin digital 12 un valor bajo, esperar 1 segundo, establecerse los valores de forma alterna y volver a esperar. Este procedimiento se deberá repetir indefinidamente.

![](mblock.png)

## Programación en Arduino

En primer lugar, se configuran los pines digitales 12 y 13 en modo salida (OUTPUT). Esta configuración se establece en la función setup(), ya que solamente se ejecuta una vez.

Por otro lado, al ejecutar el código se deberá establecer en el pin digital 13 un valor alto (HIGH) y en el pin digital 12 un valor bajo (LOW), esperar 1 segundo (1000 milisegundos), establecerse los valores de forma alterna y volver a esperar. Este procedimiento se realiza en la función loop() ya que se repite indefinidamente.

```
/**
 * Luz alterna
 */

void setup() {
    pinMode(13, OUTPUT);
    pinMode(12, OUTPUT);
}

void loop() {
    digitalWrite(13, HIGH);
    digitalWrite(12, LOW);
    delay(1000);
    digitalWrite(13, LOW);
    digitalWrite(12, HIGH);
    delay(1000);
}
```
