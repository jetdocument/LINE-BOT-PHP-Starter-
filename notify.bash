ping -q -c5 192.168.1.129 > /dev/null
 
if [ $? -eq 0 ]
then
	echo "OK!" >/dev/console
else
	echo "Not Work!" >/dev/console
fi


