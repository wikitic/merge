# Actualizar el sistema operativo Raspbian

Es conveniente actualizar el sistema operativo Raspbian de vez en cuando e incluso antes de instalar un determinado programa. En general utilizaremos los comandos `update` y `upgrade` como explicamos en la siguiente sección.

## Comando Update

Con el primer comando, `apt-get update`, lo que en realidad estamos haciendo es actualizar la lista de repositorios, es decir, actualizar la lista de todos los paquetes con la dirección de dónde obtenerlos para que a la hora de su descarga lo encuentre más rápido.

```sh
pi@raspberrypi: ~ $ sudo apt-get update
```

## Comando Upgrade

Con el comando `apt-get upgrade`, lo que hacemos es una actualización de nuestro sistema con todas las posibles actualizaciones que pudiera haber, es decir, no sólo actualiza nuestro sistema operativo sino que también las aplicaciones que están contenidas en los repositorios.

```sh
pi@raspberrypi: ~ $ sudo apt-get upgrade
```

> Una vez finalizados ambos procesos podemos asegurar que nuestro sistema operativo está actualizado a la última versión y listo para utilizar.
