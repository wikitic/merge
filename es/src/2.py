from microbit import *

M = Image("90009:99099:90909:90009:90009")
I = Image("00900:00900:00900:00900:00900")
G = Image("99999:90000:90099:90009:99999")
U = Image("90009:90009:90009:90009:99999")
E = Image("99999:90000:99900:90000:99999")

while True:
  display.show(M)
  sleep(2000)
  display.show(I)
  sleep(2000)
  display.show(G)
  sleep(2000)
  display.show(U)
  sleep(2000)
  display.show(E)
  sleep(2000)