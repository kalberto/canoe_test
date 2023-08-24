mysql=( mysql --defaults-extra-file="$PASSFILE" --protocol=socket -uroot -hlocalhost --socket="$SOCKET" --init-command="SET @@SESSION.SQL_LOG_BIN=0;")
if [ $(id -u) = "0" ]; then
	is_root=1
	install_devnull="install /dev/null -m0600 -omysql -gmysql"
	MYSQLD_USER=mysql
else
	install_devnull="install /dev/null -m0600"
	MYSQLD_USER=$(id -u)
fi

echo "CREATE DATABASE IF NOT EXISTS \`testing\` ;" | "${mysql[@]}"
mysql+=( "testing" )
echo "GRANT ALL ON \`testing\`.* TO '"$MYSQL_USER"'@'%' ;" | "${mysql[@]}"
