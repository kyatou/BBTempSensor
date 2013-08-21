'''
 Read analog values
 type 'sudo -s' before using this script.
 
 connect analog sensor device like a temperature sensor(lm35dz)
 to ain0-ain6.
'''
import os
import commands
import time
import datetime
import locale

debugmode=0

"""
Analog Functions
"""
def setupAnalogInput():
	"""
		 The number of bone_capemanager depends on your environment. 
		 please modify this number.
	"""
	slotpath="/sys/devices/bone_capemgr.7/slots"
	cmd="grep -c bone-iio "+ slotpath
	res=commands.getoutput(cmd)
	if(res=="0"):
		cmd= "sudo echo cape-bone-iio > " + slotpath
		if debugmode:print cmd
		os.system(cmd)

def readAnalogVoltagemV(ainNo):
	""" The number of helper depends on you environment."""
	fpath="/sys/module/bone_iio_helper/drivers/platform:bone-iio-helper/helper.9/AIN"
	ainNo=int(ainNo)	
	if(ainNo>7):
		ainNo=7
	if(ainNo<0):
		ainNo=0	
	devicefilepath=fpath+str(ainNo)
	cmd=" cat "+ devicefilepath
	#double reading to avoid cache data
	val=commands.getoutput(cmd)
	val=commands.getoutput(cmd)
	return float(val)

def readAllAnalogInputmV():
	"""output all of analog input values"""	
	values=[]
	for ainNo in range(7):
		values.append(readAnalogVoltagemV(ainNo))
	return values


#read analog values and output values with timestamp.
setupAnalogInput()
sensorvalues=readAllAnalogInputmV()
d=datetime.datetime.today()
strs=d.strftime("%Y-%m-%d %H:%M:%S")
for val in sensorvalues:
	temp=val/10
	strs=strs+","+str(temp)
print(strs)
