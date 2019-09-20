from microbit import *

encendido = Image("99999:99999:99999:99999:99999")
apagado = Image("00000:00000:00000:00000:00000")

while True:
  if button_a.is_pressed() and button_b.is_pressed():
    display.show(encendido)
    sleep(5000)
    display.show(apagado)
