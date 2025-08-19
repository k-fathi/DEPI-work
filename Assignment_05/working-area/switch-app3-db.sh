    #!/bin/bash

    if [ -z "$1" ]
    then
        echo "Error: Please specify the target database [mysql-db-2 | mysql-db-3]"
        exit 1
    fi

    TARGET_DB=$1
    APP_IMAGE="karimfathy1/tiny-petclinic:1.0.4" 

    echo "Stopping and removing existing app-3 container, Please wait..."
    docker stop app-3 &>/dev/null
    docker rm app-3 &>/dev/null

    
    if [ "$TARGET_DB" == "mysql-db-2" ]
    then
        NETWORK="net-1"
        DATABASE_HOST="mysql-db-2"
        ENV_FILE=".connect-to-db-2.env"

    elif [ "$TARGET_DB" == "mysql-db-3" ]
    then
        NETWORK="net-2"
        DATABASE_HOST="mysql-db-3"
        ENV_FILE=".connect-to-db-3.env"
    else
        echo "Invalid database name. Please use 'mysql-db-2' or 'mysql-db-3'"
        exit 1
    fi

    echo "Switching app-3 to connect to $DATABASE_HOST on network $NETWORK..."

    docker run -d --restart always --name app-3 --network "$NETWORK" -p 3030:8080 --env-file "./env/$ENV_FILE" "$APP_IMAGE"

    echo "Done. app-3 is now connected to $DATABASE_HOST."
