#!/bin/bash
DOMAIN="cms.local.test"
LINE="127.0.0.1 $DOMAIN"

if ! grep -q "$DOMAIN" /etc/hosts; then
  echo "Adding $DOMAIN to /etc/hosts..."
  echo "$LINE" | sudo tee -a /etc/hosts > /dev/null
  echo "✅ Done! You can access http://$DOMAIN"
else
  echo "✅ $DOMAIN already exists in /etc/hosts"
fi
