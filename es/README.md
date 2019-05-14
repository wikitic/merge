En este tutorial vamos a explicar cómo **montar un servidor web para Python con Flask** en nuestra Raspberry Pi.

# Antes de empezar

Para este tutorial vas a necesitar los siguientes componentes:

- Raspberry Pi con Raspbian

Es recomendable acceder a los siguientes tutoriales:

- [Aprender a programar en Python](https://www.aprendeprogramando.es/cursos-online/python)

# Servidor Web con Flask

Flask es un microframework creado para facilitar el desarrollo de aplicaciones web en Python. Es utilizado normalmente para construir servicios web como APIs REST o aplicaciones de contenido estático.

![](img/flask.png)

## Instalar Flask

> Antes de instalar cualquier software es conveniente actualizar la Raspberry Pi como se explica en el tutorial [Raspberry Pi - Raspbian - Update](raspberry_pi-raspbian-update)

Una vez actualizada instalamos el servidor de Flask para Python 3.

```sh
pi@raspberrypi:~ $ sudo apt install python3-flask
```

## Hola Mundo

El primer ejemplo que vamos a crear es el típico "Hola Mundo", es decir, vamos a crear un servicio que al acceder a una determinada URL se muestre por la pantalla dicho mensaje. Para ello, vamos a crear un directorio llamado `web` y dentro un fichero llamado `index.py` con el siguiente código.

```python
from flask import Flask
app = Flask(__name__)

@app.route('/')
def home():
   return '¡Hola Mundo!'

if __name__ == '__main__':
   app.run(host='0.0.0.0', port=8080, debug=True)
```

Como hemos dicho, Flask se utiliza para servicios, en este caso, hemos creado el servicio sobre la URL principal `@app.route('/')` seguido de la función que ejecutará el servicio, en este caso, devolver el mensaje 'Hola Mundo' que será mostrado por la pantalla al ejecutar el código y acceder mediante el navegador a la dirección `localhost:8080`. También podrás acceder desde tu propia IP `xxx.xxx.xxx.xxx:8080` en un dispositivo situado en la misma red.

```
URL: localhost:8080
```

## Añadir un template HTML

En ocasiones nos vemos en la necesidad de generar el código HTML y CSS como ficheros externos para mostrar una web. Para ello debemos renderizar el template en la función y crear un fichero dentro de una carpeta llamada `templates`. Dentro de esta crearemos el fichero con el código HTML.

```python
from flask import Flask
app = Flask(__name__)

@app.route('/')
def home():
   return render_template('home.html')

if __name__ == '__main__':
   app.run(host='0.0.0.0', debug=True)
```

```html
<html>
<head>
   <title>Hola Mundo</title>
</head>
<body>
   <h1>¡Hola Mundo!</h1>
</body>
</html>
```

## Pasar parámetros al template

En ocasiones nos gustaría pasar parámetros desde el código principal al template en HTML. Para ello, al renderizar el template tenemos que añadirle un array con los valores que serán leídos desde el HTML.

```python
from flask import Flask
app = Flask(__name__)

@app.route('/')
def home():
   templateData = {
      'titulo' : 'Hola Mundo',
      'numero' : 5
   }
   return render_template('home.html', **templateData)

if __name__ == '__main__':
   app.run(host='0.0.0.0', debug=True)
```

```html
<html>
<head>
   <title>Hola Mundo</title>
</head>
<body>
   {% if numero == 5 %}
      <h1>{{ titulo }}</h1>
      <p>Se muestra el título porque el parámetro número es igual a 5</p>
   {% endif %}
</body>
</html>
```

## Añadir otra dirección

De momento solamente estamos accediendo a una dirección web. Supongamos que queremos acceder a una dirección web donde muestre información adicional o un formulario de contacto. En este caso necesitamos añadir una nueva función al fichero principal de nuestra aplicación así como un nuevo template donde mostrar dicha información.

```python
...

@app.route('/otra-direccion')
def otra():
   return render_template('otra.html')

...
```

```html
<html>
<head>
   <title>Otra dirección</title>
</head>
<body>
   <h1>Esto es otra dirección</h1>
   <a href="/">Al hacer clic aquí te lleva al home</a>
</body>
</html>
```

## Inicio automático

En ocasiones nos gustaría que el servidor que hemos programado se ejecutase al iniciar o encender la Raspberry Pi. En este caso, tenemos que añadir la ejecución del mismo en el fichero `/etc/rc.local` encargado para tal fin.

En primer lugar debemos darle permisos de ejecución a nuestro fichero principal. Recuerda situarte sobre el directorio de tu proyecto.

```sh
pi@raspberrypi:~ $ cd web
pi@raspberrypi:~/web $ sudo chmod +x index.py
```

Para probar que nuestro proyecto funciona, podemos ejecutar el comando de ejecución de python3. Para pararlo, utiliza las teclas `ctrl + c`.

```sh
pi@raspberrypi:~/web $ python3 index.py
```

Una vez hemos comprobado que funciona correctamente, nos falta añadir la anterior instrucción al fichero `rc.local` justo antes de la última lína 'exit 0'. Observa en este caso como se añade la ruta absoluta del fichero a ejecutar.

```sh
pi@raspberrypi:~ $ sudo leafpad /etc/rc.local
```

```
...

python3 /home/pi/web/index.py

exit 0
```

# Resumen

Con este sencillo ejemplo hemos visto como crear un sencillo servidor web en Python para crear una web utilizando HTML en nuestra Raspberry Pi.

# Ejercicios propuestos

1.- Crea una sencilla página web con 2 enlaces a otras páginas.
