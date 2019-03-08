# Acceso remoto a través de Secure Shell (SSH)

Secure Shell (SSH) es un **protocolo de comunicación entre dos sistemas usando una arquitectura cliente/servidor y que permite a los usuarios conectarse a un host remotamente**. La sesión de conexión está encriptada haciendo imposible que alguien pueda obtener contraseñas no encriptadas.

![](img/ssh.png)

## Habilitar SSH en la Raspberry Pi

ToDo

## Acceder por SSH desde un ordenador

> Si estás utilizando Windows deberás descargar e instalar [PuTTY](https://www.putty.org)

ToDo

`ssh [*usuario*]@[*ip*]`

```sh
pi@raspberrypi:~ $ ssh pi@192.168.0.xxx
```

### Establecer clave ssh 

ToDo

```sh
pi@raspberrypi:~ $ ssh-keygen
```


Para conectarte desde fuera de la red local puedes hacerlo a través de [OpenVPN](raspberry_pi-openvpn)