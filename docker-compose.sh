#!/bin/bash

DB_CONTAINER=jakubferenc-db
DB_NAME=wordpress
DB_USER=root
DB_PASS=root
BACKUP_DIR=./.docker/db-backups
TIMESTAMP=$(date +"%Y-%m-%d_%H-%M-%S")
BACKUP_FILE="$BACKUP_DIR/db-$TIMESTAMP.sql"

mkdir -p "$BACKUP_DIR"

function export_db() {
  echo "🧠 Export databáze do $BACKUP_FILE"
  docker compose exec db sh -c "MYSQL_PWD=$DB_PASS mysqldump -u$DB_USER $DB_NAME" > "$BACKUP_FILE"

  echo "🧹 Mazání starých záloh..."
  ls -1t "$BACKUP_DIR"/db-*.sql | tail -n +2 | xargs -r rm --
}

function wait_for_db() {
  echo -n "⌛ Čekám na MySQL..."
  until docker compose exec db sh -c "mysqladmin ping -h 127.0.0.1 -u$DB_USER -p$DB_PASS --silent" >/dev/null 2>&1; do
    printf "."
    sleep 1
  done
  echo " ✅"
}

function import_db_if_missing() {
  echo "🧪 Kontrola existence databáze '$DB_NAME'..."
  if ! docker compose exec db sh -c "MYSQL_PWD=$DB_PASS mysql -u$DB_USER -e 'USE $DB_NAME'" >/dev/null 2>&1; then
    LATEST_BACKUP=$(ls -1t "$BACKUP_DIR"/db-*.sql 2>/dev/null | head -n 1)
    if [ -f "$LATEST_BACKUP" ]; then
      echo "⬇️  Import databáze ze zálohy: $LATEST_BACKUP"
      cat "$LATEST_BACKUP" | docker compose exec -T db sh -c "MYSQL_PWD=$DB_PASS mysql -u$DB_USER $DB_NAME"
    else
      echo "⚠️  Nebyla nalezena žádná záloha k importu."
    fi
  else
    echo "✅ Databáze '$DB_NAME' již existuje – import se neprovádí."
  fi
}

case $1 in
  up)
    docker compose up --build -d
    wait_for_db
    import_db_if_missing
    export_db
    ;;
  down)
    export_db
    docker compose down
    ;;
  down-v)
    export_db
    docker compose down -v
    ;;
  backup)
    export_db
    ;;
  *)
    echo "Použití: ./docker-dev.sh [up | down | down-v | backup]"
    ;;
esac
