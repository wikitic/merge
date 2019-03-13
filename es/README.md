# Instalar Raspbian en Raspberry Pi a través de una imagen

Una imagen es un archivo que contiene la estructura y los contenidos completos de un sistema operativo, es decir, una copia exacta del sistema operativo y contenido. Esto es útil cuando queremos que todos nuestros equipos dispongan de la misma configuración y con los mismos programas instalados, mismas carpetas, etc.

## Descargar imagen de Raspbian

Para descargar la imagen del sistema operativo Raspbian para Raspberry Pi accederemos al apartado de [descargas](https://www.raspberrypi.org/downloads/raspbian/) y elegimos la versión a instalar.

- `Raspbian Stretch with desktop and recommended software`: Versión completa con entorno gráfico y programas recomendados.
- `Raspbian Stretch with desktop`: Versión completa con entorno gráfico (ventanas, carpetas, etc.).
- `Raspbian Stretch Lite`: Versión reducida sin entorno gráfico (modo consola).

> El tiempo de descarga suele ser de 10 minutos aproximadamente dependiendo de la conexión a internet.

## Instalar Etcher

Mientras se descarga la imagen de Raspbian, vamos a descargar el programa [Etcher](https://etcher.io/) (recomendado por Raspberry Pi) que utilizaremos para copiar la imagen de Raspbian en la tarjeta SD. 

![](img/etcher.png)

## Clonar la imagen de Raspbian con Etcher

Una vez descargada la imagen de Raspbian e instalado el programa Etcher, lo abrimos y seleccionamos la imagen y la tarjeta donde queremos copiar el sistema operativo. Hacemos clic sobre el boton `Flash` y esperamos a que el proceso finalice.

> Este proceso suele tardar 20 minutos aproximadamente.

Una vez finalizado el proceso de copiado conectamos la tarjeta SD a la Raspberry Pi y al encenderla arrancará directamente el sistema operativo Raspbian.

![](img/raspbian.png)
