#ping -q -c2 google.com
 
#if [ $? -eq 0 ]
#then
#	echo "OK!" >/var/www/html/LINE-BOT-PHP-Starter-/log
#else
#	echo "Not Work!" >/var/www/html/LINE-BOT-PHP-Starter-/log
#fi

echo "It's work" >>log
echo "first" >log
echo "last" >>log


