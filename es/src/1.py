from microbit import *  

while True:     
  input = pin0.read_analog()     
  output = int(input/ 50)      
  # display.show(str(output))
  if output > 5:
    display.show(Image.HAPPY)
  else:
    display.show(Image.SAD)