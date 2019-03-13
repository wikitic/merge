# Lorem ipsum dolor

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et, feugiat pharetra diam. 

![](img/default.jpg)

## Aliquam ante felis

In hac habitasse platea dictumst, consectetur adipiscing elit. Aliquam ante felis, elementum sit amet purus et.

- Lorem ipsum
- Dolor sit
- Amet consectuer

```sh
pi@raspberrypi:~ $ lsusb
Bus 001 Device 004: ID 0c45:6340 Microdia Camera
...
..
.
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
