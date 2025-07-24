#!/bin/bash

# Копируем стандартный аватар, если его ещё нет
DEFAULT_AVATAR=/var/www/html/storage/app/public/avatars/default_avatar.png
SOURCE_AVATAR=/var/www/html/default_assets/default_avatar.png

if [ ! -f "$DEFAULT_AVATAR" ]; then
  cp "$SOURCE_AVATAR" "$DEFAULT_AVATAR"
fi

# Стартуем Apache
apache2-foreground
