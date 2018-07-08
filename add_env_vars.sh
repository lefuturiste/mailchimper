#!/bin/bash
echo "" >> /etc/php/7.2/fpm/pool.d/www.conf # new line.
echo "env[APP_NAME] = $APP_NAME;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[APP_ENV_NAME] = $APP_ENV_NAME;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[APP_DEBUG] = $APP_DEBUG;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_DISCORD] = $LOG_DISCORD;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_PATH] = $LOG_PATH;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_LEVEL] = $LOG_LEVEL;" >>  /etc/php/7.2/fpm/pool.d/www.conf
echo "env[LOG_DISCORD_WH] = $LOG_DISCORD_WH;" >>  /etc/php/7.2/fpm/pool.d/www.conf

if ! [ -z "$MAILCHIMP_API_KEY" ]
then
    echo "env[MAILCHIMP_API_KEY] = $MAILCHIMP_API_KEY;" >>  /etc/php/7.2/fpm/pool.d/www.conf
fi

if ! [ -z "$DISCORD_WH" ]
then
    echo "env[DISCORD_WH] = $DISCORD_WH;" >>  /etc/php/7.2/fpm/pool.d/www.conf
fi

if ! [ -z "$DISCORD_WH" ]
then
    echo "env[MAILCHIMP_LIST_ID] = $MAILCHIMP_LIST_ID;" >>  /etc/php/7.2/fpm/pool.d/www.conf
fi