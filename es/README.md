# Acceso remoto a través de Secure Shell (SSH)

Secure Shell (SSH) es un **protocolo de comunicación entre dos sistemas usando una arquitectura cliente/servidor y que permite a los usuarios conectarse a un host remotamente**. La sesión de conexión está encriptada haciendo imposible que alguien pueda obtener contraseñas no encriptadas.

En la siguiente imagen podemos ver una ventana típica de conexión SSH a una Raspberry Pi con el sistema operativo Raspbian Stretch.

![](img/terminal.png)

Los usuarios con sistemas operativos *Linux* o *MAC* pueden utilizar la propia terminal mientras que los usuarios de *Windows* deben **instalar un cliente SSH** como [Putty](https://www.putty.org/).

## Habilitar SSH en la Raspberry Pi

La conexión por SSH a la raspberry Pi viene deshabilitada por defecto cuando instalamos el sistema operavico Raspbian Stretch. Con lo cual, lo primero que tenemos que hacer es habilitarla y ee puede habilitar desde el **entorno gráfico** o **desde la terminal**.

### Desde el entorno gráfico

Accedemos al menú `Inicio > Preferencias > Raspberry Pi Configuración` y una vez en la ventana de configuración, sobre la pestaña `Interfaces` habilitamos la opción `SSH`. A continuación guardamos y ya está habilitado el acceso por SSH.

![](img/ssh-grafico.png)

### Desde la terminal

Accedemos a la terminal e introducimos el comando `sudo raspi-config`. Seleccionamos la opción de `Interfaces`, a continuación la opcción de `SSH` y por último la opción de `Habilitar`. Guardamos y ya está habilitado el acceso por SSH.

```sh
pi@raspberrypi:~ $ sudo raspi-config
```

![](img/ssh-terminal.png)


## Acceder por SSH desde un ordenador

El comando para conectar por SSH `ssh user@host` consta de 3 partes:

- **ssh**: Indica que se establecerá una conexión segura y cifrada por SSH
- **user**: Usuario del host remoto con el cual se establecerá la conexión
- **host**: Dirección IP o dominio de la máquina a la cual nos vamos a conectar

Por ejemplo, voy a conectarme por SSH utilizando el usuario por defecto `pi`, a la Raspberry Pi con dirección IP `192.168.0.138`. Y cuando nos solicite el password introducimos la contraseña por defecto `raspberry`

```sh
migueabellan@PC ~ $ ssh pi@192.168.0.138
pi@192.168.0.138 password: *********
```

Una vez establecida la conexión SSH nos aparecerá el **prompt** `pi@raspberrypi:~ $ ` el cual indica que estamos conectados con el usuario `pi` a la máquina `raspberrypi`

```sh
migueabellan@PC ~ $ ssh pi@192.168.0.138
pi@192.168.0.138 password: 
Linux raspberrypi 4.14.98-v7+ #1200 SMP Tue Feb 12 20:27:48 GMT 2019 armv7l

...

pi@raspberrypi:~ $ 
```

### Establecer clave ssh 

Otra forma de conectarnos por SSH sin necesidad de introducir la contraseña una y otra vez consiste en autenticarse a través de claves públicas SSH. De esta forma es más segura la conexión que introducir una contraseña que alguien podría interceptar. Además, el uso de claves SSH elimina el riesgo de ataques de fuerza bruta al reducir la probabilidad de que un atacante adivine las credenciales correctamente.

> Más información sobre claves SSH [aquí](https://wiki.archlinux.org/index.php/SSH_keys_(Espa%C3%B1ol))

En primer lugar vamos a listar el listado de claves por si las tuviésemos creadas utilizando el comando `ls -al ~/.ssh`. Si todavía no habéis introducido ninguna clave no debe aparecer ningún fichero en el listado.

```sh
migueabellan@PC ~/.ssh $ ls -al ~/.ssh
# Directorio vacío
```

Por otro lado, si con anterioridad generáisteis algun par de claves, veréis la siguiente salida por la terminal. En mi caso indica que tengo generadas las claves pública (id_rsa.pub) y privada (id_rsa) siguiendo el algoritmo RSA.

```sh
migueabellan@PC ~/.ssh $ ls -al ~/.ssh
drwx------  2 migueabellan migueabellan 4096 mar  9 09:32 .
drwxr-xr-x 46 migueabellan migueabellan 4096 mar  8 14:42 ..
-rw-------  1 migueabellan migueabellan 3326 ago 28  2018 id_rsa
-rw-r--r--  1 migueabellan migueabellan  748 ago 28  2018 id_rsa.pub
-rw-r--r--  1 migueabellan migueabellan 1548 mar  8 10:55 known_hosts
```

## Generar un par de claves pública y privada

Suponiendo que no tenemos generadas el par de claves en nuestra máquina local, las generamos mediante el comando `ssh-keygen -t rsa` y nos hará una serie de preguntas.

```sh
pi@raspberrypi:~ $ ssh-keygen -t rsa
Generating public/private rsa key pair.
Enter file in which to save the key (/home/migueabellan/.ssh/id_rsa):
Enter passphrase (empty for no passphrase): 
Enter same passphrase again: 
```

Si todo ha ido, se habrá generado la clave pública localizada en `/home/[usuario]/.ssh/id_rsa.pub` y la clave privada en `/home/[usuario]/.ssh/id_rsa`. Verás en la terminal algo como lo siguiente.

```sh
...
The keys randomart image is:
+--[ RSA 2048]----+
|          .oo.   |
|         .  o.E  |
|        + .  o   |
|      = S = .    |
|     o + = +     |
|     . = = .     |
|     o + = +     |
|      . o + o .  |
|           . o   |
+-----------------+
```

El siguiente paso consite en añadir la clave pública en la Raspberry Pi. Para ello utilizamos el comando `ssh-copy-id [user]@[host]` donde *usuario* hace referencia a nuestro usuario local y host es la dirección IP de la raspberry Pi. De esta forma se copiará nuestra clave pública en el fichero `autorized_keys` de la Raspberry Pi.

```sh
migueabellan@PC ~ $ ssh-copy-id migueabellan@192.168.0.138
/usr/bin/ssh-copy-id: INFO: attempting to log in with the new key(s), to filter out any that are already installed
/usr/bin/ssh-copy-id: INFO: 1 key(s) remain to be installed -- if you are prompted now it is to install the new keys
migueabellan@192.168.0.138s password: 
```

Otra alternativa consiste en pegar la clave pública utilizando SSH. Para ello indicamos en el comando que queremos añadir en el listado de claves autorizadas de nuestra Raspberry Pi, nuestra clave pública, accediendo por SSH como vimos anteriormente. Este comando es más largo y menos aconsejable. 

```sh
migueabellan@PC ~ $ cat ~/.ssh/id_rsa.pub | ssh pi@192.168.0.138 "mkdir -p ~/.ssh && cat >>  ~/.ssh/authorized_keys"
pi@192.168.0.138s password: 
```

De una forma u otra, ya podemos acceder a nuestra Raspberry Pi desde nuestro ordenador local sin necesidad de introducir la contraseña cada vez que queramos conectarnos.

```sh
migueabellan@PC ~ $ ssh pi@192.168.0.138
Linux raspberrypi 4.14.98-v7+ #1200 SMP Tue Feb 12 20:27:48 GMT 2019 armv7l

The programs included with the Debian GNU/Linux system are free software;
the exact distribution terms for each program are described in the
individual files in /usr/share/doc/*/copyright.

Debian GNU/Linux comes with ABSOLUTELY NO WARRANTY, to the extent
permitted by applicable law.
Last login: Sat Mar  9 08:32:22 2019 from 192.168.0.111

SSH is enabled and the default password for the 'pi' user has not been changed.
This is a security risk - please login as the 'pi' user and type 'passwd' to set a new password.

pi@raspberrypi:~ $
```

## Recomendaciones

Una vez establecida la conexión por SSH, como medidas de seguridad, **podríamos** deshabilitar la conexión para los usuarios mediante el acceso de contraseñas. Hay que tener en cuenta que mediante este procedimiento en caso de perder las claves en el ordenador local no podríamos acceder a la Raspberry Pi con posterioridad.

Para deshabilitar el acceso mediante contraseña debemos modificar la línea `PermitRootLogin without-password` que encontraremos en el fichero `/etc/ssh/sshd_config` de nuestra raspberry Pi. Para ello, accederemos al fichero, modificaremos el acceso sin contraseña, guardaremos el fichero y ya tenemos configurado el sistema de forma segura.

```sh
pi@raspberrypi:~ $ sudo nano /etc/ssh/sshd_config
# Modificamos 
# > PermitRootLogin without-password
```


## Siguiente tutorial

Hasta ahora ya tenemos configurado el acceso mediante SSH desde nuestro local a nuestra raspberry Pi, sin embargo probablemente queramos acceder desde fuera de nuestra red local, por ejemplo desde nuestra casa al trabajo, o desde nuestro lugar de vacaciones a nuestra casa, etc. 

Para ello lo que tenemos que hacer es configurar un tunel SSH a través de una Red Privada Virtual. y eso lo explicamos en el tutorial [Raspberry Pi - OpenVPN](raspberry_pi-openvpn)
