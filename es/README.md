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

El primer ejemplo que vamos a crear es el típico "Hola Mundo". En este caso, vamos a crear un servicio que al acceder a una determinada URL se muestre por la pantalla dicho mensaje.

En primer lugar se importa la librería de Flask y se asigna a la variable `app` encargada entre otras cosas de ejecutar el servicio, como se observa en la condición del final.

Como hemos dicho, Flask se utiliza para servicios, en este caso, creamos el servicio sobre la URL principal `@app.route('/')` seguido de la función que ejecutará el servicio. En este caso lo único que hacemos será devolver el código HTML con el mensaje "Hola Mundo".

```python
from flask import Flask
app = Flask(__name__)

@app.route('/')
def home():
   return '<html><body>¡Hola Mundo!</body></html>'

if __name__ == '__main__':
   app.run(host='0.0.0.0', debug=True)
```

Por último jecuta el código haciendo clic en el botón de ejecutar "Run" y accede mediante el navegador a la dirección `localhost:5000`. También podrás acceder desde introduciendo la IP de tu Raspberry Pi desde otro dispositivo situado en la misma red local.

```
URL: localhost:5000
```

Por defecto, el puerto seleccionado por flask es el 5000, pero en caso de querer utilizar el puerto 80 u otro debemos especificarlo al ejecutar el servidor.

```python

...

if __name__ == '__main__':
   app.run(host='0.0.0.0', port=80, debug=True)
```

```
URL: localhost o IP (no es necesario especificar el puerto 80 ya que es por defecto)
```

## Añadir un template

Al devolver el valor de la función en el caso anterior se devuelve el código en HTML. En ocasiones nos vemos en la necesidad de generar el código HTML y CSS como ficheros externos. En este caso debemos renderizar el template en la función.

```python
from flask import Flask
app = Flask(__name__)

@app.route('/')
def home():
   return render_template('home.html')

if __name__ == '__main__':
   app.run(host='0.0.0.0', debug=True)
```

A continuación, debemos crear una carpeta `templates` en el mismo directorio raiz y dentro un fichero llamado `home.html` con el código anterior en HTML de 'Hola Mundo'.

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

## Encendido y apagado de un LED

Vamos a realizar el encendido y apagado de un LED conectado al `Pin 11 - GPIO 17` de nuestra Raspberry Pi.

![](img/led-fritzing.png)

En la programación, añadimos la librería para controlar los pines GPIO así como el modo de pin. A continuación se crean dos entradas de URL o endpoints para encender y apagar dicho LED. Además mostramos un mensaje por la pantalla de la web.

```python
from flask import Flask
app = Flask(__name__)

import RPi.GPIO as GPIO
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(17, GPIO.OUT)
GPIO.output(17, GPIO.LOW)

@app.route('/on')
def on():
   GPIO.output(17, GPIO.HIGH)
   return '<html><body>Led Encendido</body></html>'

@app.route('/off')
def off():
   GPIO.output(17, GPIO.LOW)
   return '<html><body>Led Apagado</body></html>'

if __name__ == '__main__':
   app.run(host='0.0.0.0', debug=True)
```

Por último jecuta el código haciendo clic en el botón de ejecutar "Run" y accede mediante el navegador a ambas direcciones para encender y apagar el LED.

```
URL: localhost:5000/on
URL: localhost:5000/off
```


# Resumen

Con este sencillo ejemplo hemos visto la forma de controlar los pines GPIO a través de un sencillo servidor web en Flask con Python.

# Ejercicios propuestos

1.- Enciende varios LEDs utilizando diferentes endpoints en el servidor web.
