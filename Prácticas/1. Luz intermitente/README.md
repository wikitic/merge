#Luz intermitente

En esta primera práctica vamos a realizar un sencillo proyecto consistente en un LED que parpadea continuamente con una frecuencia de 1 segundo.

1.	[Materiales](#materiales)
2.	[Diagrama de flujo](#diagrama-de-flujo)
3.	[Esquema eléctrico](#esquema-eléctrico)
4.	[Programación en S4A](#programación-en-s4a)
5.	[Programación en Arduino](#programación-en-arduino)



### Materiales

Vamos a utilizar los siguientes materiales:
- 1 Placa de Arduino UNO
- 1 Protoboard
- 2 latiguillos
- 1 Led
- 1 Resistencia



### Diagrama de flujo

Antes de ponernos a programar o construir el proyecto sobre la placa de prototipado, conviene realizar un diagrama de flujo para entender la lógica que tenemos que programar.

![Diagrama de flujo](Diagrama de flujo.png)

[Descarga el diagrama de flujo para imprimir](Diagrama de flujo.html)



### Esquema eléctrico

Cuando conectamos un Led a la placa de Arduino, estamos ejerciendo una diferencia de potencial en ámbos extremos del Led. Para evitar que se pueda dañar tendremos que colocar una resistencia al circuito. 

Para ello, vamos a calcular el valor de la resistencia siguiendo la *Ley de Ohm* y teniendo en cuenta los siguientes datos:

```
V = 5V
I = 20mA

V = I x R

R = 5V / 0.02A = 250Ω 

NOTA: Recordar utilizar las unidades del Sistema Internacional para los cálculos.

```

Redondeando la división obtenemos una resistencia de 220Ω, que mirando en la tabla de resistencias corresponde a la resistencia de color *rojo-rojo-marrón*.

El siguiente paso será conectar los diferentes componentes sobre la placa de prototipado siguiendo el esquema eléctrico y los componentes calculados.

![Esquema eléctrico](Esquema eléctrico.png)

[Descarga el esquema eléctrico para Fritzing](Esquema eléctrico.fzz)



### Programación en S4A

Fijándonos en el diagrama de flujo programamos la práctica mediante lenguaje de programación por bloques S4A. 

Podrás observar el gran parecido que se tiene con el diagrama de flujo.

![Programación en S4A](Programación S4A.png)

[Descarga el código para S4A](Programación.sb)



### Programación en Arduino

Al igual que en el apartado anterior y fijándonos en el diagrama de flujo, programamos el código fuente de la práctica propuesta.

```
/**
 * Luz Intermitente
 * 
 * @author Miguel Ángel Abellán
 * @company Programo Ergo Sum
 * @license Creative Commons. Reconocimiento CompartirIgual 4.0
 */

//Se definen la variable ledPin y delayTime
int ledPin = 13;
int delayTime = 1000;

//Este código se ejecuta la primera vez
void setup() {
  pinMode(ledPin, OUTPUT);
}

//Este código se ejecuta en bucle repetidamente
void loop() {
  digitalWrite(ledPin, HIGH);
  delay(delayTime);
  digitalWrite(ledPin, LOW);
  delay(delayTime);
}

```

[Descarga el código para Arduino](Programación.ino)




=============

#### Licencia

<img src="http://i.creativecommons.org/l/by-sa/4.0/88x31.png" /> Esta obra se distribuye bajo licencia [Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)](https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES).
