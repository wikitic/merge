from microbit import *  

while True:
  for i in range(0, 191, 1):
    pin0.write_analog(i)
    sleep(50)