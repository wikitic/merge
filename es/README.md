# Actualizar el sistema operativo Raspbian

En este tutorial vamos a explicar cómo podemos actualizar el sistema operativo Raspbian desde la línea de comandos, ya que es conveniente actualizarlo constantemente e incluso antes de instalar un determinado programa. 

## Comando: update

Con el comando `apt update` actualizamos la lista de paquetes en el repositorio, es decir, se actualiza la lista de todos los paquetes con la dirección de dónde obtenerlos.

```sh
pi@raspberrypi: ~ $ sudo apt update
```

> Recuerda que antes de instalar un programa es recomendable actualizar la lista de paquetes en el repositorio.

## Comando: upgrade

Con el comando `apt upgrade` actualizamos nuestro sistema operativo con todas las posibles actualizaciones que pudiera haber tomadas de la lista de paquetes, es decir, actualiza los paquetes instalados a la última versión.

```sh
pi@raspberrypi: ~ $ sudo apt upgrade
```

## Comando: dist-upgrade

Con el comando `apt dist-upgrade` realizamos las mismas acciones que el anterior pero adicionalmente también es capaz de añadir paquetes no instalados o eliminar los obsoletos.

```sh
pi@raspberrypi: ~ $ sudo apt dist-upgrade
```

## Comando: autoremove y autoclean

Con el comando `apt autoclean` se elimina de la cache las versiones antiguas de los programas que ya tenemos instalados y actualizados. Con el comando `apt autoremove` se eliminan los paquetes huérfanos después de la instalación o actualización del sistema.

```sh
pi@raspberrypi: ~ $ sudo apt autoclean
pi@raspberrypi: ~ $ sudo apt autoremove
```

---

# Resumen 

Tras actualizar la versión de Raspbian con `update` y luego `dist-upgrade` tendremos el sistema prácticamente igual que si descargáramos e instaláramos la nueva versión de Raspbian desde cero pero conservando todos nuestros datos.

Recuerda que tras la actualización es conveniente eliminar la cache y paquetes huérfanos con los comandos `autoremove` y `autoclean`.

---

# Ejercicios propuestos

#### 1. Actualiza el sistema operativo Raspbian a la última versión. Además deberás calcular el tiempo aproximado que ha llevado cada comando durante la actualización.

#### - Una vez actualizado, reinicia el sistema e intenta actualizarlo nuevamente. ¿Qué conclusiones has sacado? ¿Han habido actualizaciones tras el reinicio?