# Instalar Raspbian en Raspberry Pi con NOOBs

NOOBS es el acrónimo de *New Out Of Box Software* y consiste en un instalador sencillo guiado paso a paso. NOOBS incluye también un método de edición rápida de configuración del nuevo sistema, un navegador web preinstalado y un modo de recuperación por línea de comandos a partir de una partición de rescate que se crea automáticamente.

## Descargar Raspbian con NOOBs

Para descargar la imagen del sistema operativo Raspbian para Raspberry Pi accederemos al apartado de [descargas](https://www.raspberrypi.org/downloads/noobs/) y elegimos la versión a instalar. Disponemos de la versión completa de *NOOBS con Pixel* y la versión reducida de *NOOBS Lite sin Pixel*.

- `NOOBS`: Versión completa con entorno gráfico y programas recomendados.
- `NOOBS Lite`: Versión reducida sin entorno gráfico (modo consola).

> El tiempo de descarga suele ser de 10 minutos aproximadamente dependiendo de la conexión a internet.

## Instalar SD Card Formatter

Mientras se descarga la imagen de Raspbian, vamos a descargar el programa [SD Card Formatter](https://www.sdcard.org/downloads/index.html) (recomendado por Raspberry Pi) que utilizaremos para formatear y dejar preparada la tarjeta SD. 

![](img/sdcard-formatter.png)

Una vez formateada la tarjeta copiaremos los archivos descargados de NOOBS dentro de la tarjeta.


## Instalar Raspbian con NOOBs

Por último, conectaremos nuestra Raspberry Pi e iremos seleccionando las opciones que nos ofrezca el asistente de instalación. 

> Este proceso suele tardar 20 minutos aproximadamente.

![](img/noobs.gif)

Una vez finalizada la instalación arrancará  el sistema operativo Raspbian.

![](img/raspbian.png)
