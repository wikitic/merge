from microbit import *

while True:
  if button_a.is_pressed():
    display.scroll('IZQUIERDA')
  if button_b.is_pressed():
    display.scroll('DERECHA')
