#BBTempSensor

This project is aimed to be able to see changes of
temperature from smartphone, tablet, or PC.

##Hardware requirements
- BeagleBone (White or Black) with Ubuntu13.04 or later
- One or more the temperature sensors
- 1kOhm registers
- 5V AC adapter(Power source of beaglebone)

##Software requirements
- apache
- php5
- python2.7
- pChart ( to make graph)
- curl ( to dispatch GET request)

###What is
- readAnalogValues.py
	- read sensor values and output to stdout with timestamp.
	
- loggingTemp.sh
	- execute "readAnalogValues.py" and save output to log file.
	
- updateGraph.php
	- read temperature log file and make graph.

###Usage
1. Copy all files to your beaglebone.
1. Make /var/www/tempsensor dir.
1. Copy all files in it.
1. run "sudo -s" to change to root mode.
1. run "python readAnalogValues.py" to check Ain0-Ain6 values.(Note that current script optimized for LM35 sensor)
1. run "sh ./loggingTemp.sh" to logging analog values.
1. run "php updateGraph.php" to create graph image.
 

##Japanese
BeagleBoneを使用して温度ロガーを作成します。
pythonとphp、Apacheの組み合わせでネットワーク内のどこからでも
温度を確認できるようになります。

