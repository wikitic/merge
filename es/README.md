Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et, feugiat pharetra diam.

<div class="toc">

- [Lorem ipsum dolor](#lorem-ipsum-dolor)
  - [Aliquam ante felis](#aliquam-ante-felis)
- [Resumen](#resumen)
- [Ejercicios propuestos](#ejercicios-propuestos)

</div>

# Lorem ipsum dolor

![](img/default.jpg)

## Aliquam ante felis

In hac habitasse platea dictumst, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et.

```sh
pi@raspberrypi:~ $ lsusb
```

Nullam in tortor congue, *scelerisque lorem ut*, congue odio. In hac habitasse platea dictumst, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et, feugiat pharetra diam. 

```python
import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BOARD)
GPIO.setup(7, GPIO.OUT)

led = GPIO.PWM(7, 100)

while True:
   led.start(0)
   for i in range(0, 100, 25):
      led.ChangeDutyCycle(i)
      time.sleep(0.5)
```

---

# Resumen

Nullam in tortor congue, *scelerisque lorem ut*, congue odio. In hac habitasse platea dictumst, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et, feugiat pharetra diam.

---

# Ejercicios propuestos

1.- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et, feugiat pharetra diam.

2.- Aliquam ante felis, elementum sit amet purus et, feugiat pharetra diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et.

