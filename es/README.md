En este tutorial vamos a explicar cómo **instalar Mu Editor** para programar placas de electrónica en MicroPython.

# Antes de empezar

Vas a necesitar los siguientes componentes:

- Raspberry Pi con Raspbian
- Micro:Bit

Es recomendable acceder a los siguientes tutoriales:

- [Aprender a programar en Python](https://www.aprendeprogramando.es/cursos-online/python)

# Instalar Mu Editor

[Mu Editor](https://codewith.mu/) es un editor de Python muy sencillo para principantes de la programación que permite programar en MicroPython. [MicroPython](http://micropython.org/) es una versión reducida de Python 3 diseñada para funcionar en microcontroladores, como es el caso de la placa micro:bit.

Antes de instalar un programa es recomendable actualizar Raspbian como se explica en el tutorial [Raspberry Pi - Raspbian - Update](raspberry_pi-raspbian-update). Una vez actualizada la lista de paquetes del repositorio podemos instalar el editor desde la terminal mediante el comando `apt-get install mu`. El proceso suele tardar unos minutos.

```sh
pi@raspberrypi:~ $ sudo apt-get install mu
...
Do you want to continue? [Y/n] Y
...
```

Una vez instalado ya podemos acceder al editor desde el menú `Inicio > Programming > Mu`

![](img/mu.png)

## Conectar Micro:bit a Raspberry Pi

[BBCs Micro:bit](https://microbit.org/es/) es una pequeña placa de electrónica programable diseñada para aprender a programar de forma sencilla. Cuenta con diferentes sensores y actuadores con los que poder interactuar mediante programación. Y para programarla vamos a utilizar el editor Mu. 

![](img/microbit.png)

Para conectar la placa hacemos uso de cualquiera de los USB disponibles en la Raspberry Pi. Al conectarla aparecerá una ventana indicando que se ha introducido un dispositivo nuevo. Simplemente cancelamos la ventana haciendo clic en el botón `Cancelar`.

## Software Mu Editor

Para programar nuestra placa Micro:bit, vamos a utilizar el lenguaje de programación MicroPython. [MicroPython](http://micropython.org/) es una versión reducida de Python 3 diseñada para funcionar en microcontroladores, como es el caso de la placa micro:bit. Esto se consigue con el Editor Mu. Vamos a ver las partes del editor.

![](img/botones.png)

- `New` abre un nuevo archivo.
- `Load` abre un código existente.
- `Save` guarda el código actual.
- `Flash` carga el código en la placa Micro:bit.
- `Repl` abre un Shell interactivo en línea de comandos para ejecutar instrucciones simples.
- `Zoom-in` y `Zoom-out` Altera el tamaño de la fuente.
- `Theme` altera el tono del editor
- `Check` comprueba la sintaxis del código.


## ¡Hola Mundo!

Una vez abierto el editor y conectada la placa Micro:bit, vamos a probar que funciona introduciendo el programa `Hola Mundo`. Para ello introducimos el siguiente código y presionamos sobre el botón `Flash`. Al cabo de unos segundos veremos como se desliza la frase `¡Hola Mundo!` sobre los leds de nuestra placa Micro:bit.

```python
from microbit import *
display.scroll('¡Hola Mundo!')
```

![](img/hola-mundo.gif)

# Resumen

Con Mu Editor podemos programar en MicroPython todo tipo de placas de electrónica que admita el editor. Una de las placas es Micro:bit.

# Ejercicios propuestos

1.- Muestra tu nombre completo utilizando la matriz de LEDs de la placa Micro:bit.
