#!/bin/bash
# File : mysql-proxy-options.sh

# Password for the backend that you can access via :
# mysql -P 4041 -pBACKEND_PASSWORD
BACKEND_PASSWORD="fmflixmouth"

# Fetch roles list with the API
roles=`szradm --queryenv list-roles | while read line; do echo "$line\n"; done;`

# Get the master and slaves internal IP adresses
master=`echo -e $roles | grep "replication-master=\"1\"" | sed 's/^.*internal-ip="\(.*\)" replication.*$/\1/'`
slaves=`echo -e $roles | grep "replication-master=\"0\"" | sed 's/^.*internal-ip="\(.*\)" replication.*$/\1/'`

# Build parameters
echo -n "--proxy-backend-addresses=$master:3306"
for slaveip in $slaves; do
        echo -n " --proxy-read-only-backend-addresses=$slaveip:3306"
done
echo -n " --proxy-lua-script=/usr/local/mysql-proxy/lib/rw-splitting.lua"
echo -n " --admin-username=root"
echo -n " --admin-password=$fmflixmouth"
echo -n " --proxy-address=:3306"
echo -n " --daemon"
echo " --admin-lua-script=/usr/local/mysql-proxy/lib/mysql-proxy/lua/admin.lua"