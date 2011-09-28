/etc/init.d/apache2 restart
redis-cli flushdb
siege -i -b --concurrent=50 --log=./siege.log --file=SIEGE_LIST
