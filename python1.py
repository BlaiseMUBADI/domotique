import RPi.GPIO as broches
import time as sleep

a=4
b=5
c=a+b

broches.setmode(broches.BCM)
print("la valeur de cette somme est ",c)
broches.setup(17,broches.OUT)
broches.setup(27,broches.OUT)
broches.output(17,True)
print ("la broche numéro 17 il y' a un potentiel ",broches.input(17))
print ("la broche numéro 18 il y' a un potentiel ",broches.input(27))
broches.cleanup()
