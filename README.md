# Mailchimper

Basic PHP application to interact with Mailchimp API and receive Webhooks.

## Features

- [X] Subscribe to the list
- [ ] Unsubscribe to the list
- [X] Webhook subscribes
- [ ] Webhook unsubscribes
- [ ] Webhook email changed
- [X] Docker image

## Usage

- `GET /`: Home page
- `POST /subscribe`: Subscribe to the list
- `POST /event/subscribe`: Webhook when a user subscribe

## Docker image

Basic run (without envs): ``docker run -p 80:80 lefuturiste/mailchimper``

## Environments variables

You can set environments variables by using a `.env` file

| Name | Example value | Default docker value |
| :-----| :---- | :--- |
| APP_NAME | mailchimper | mailchimper |
| APP_ENV_NAME | staging | prod
| APP_DEBUG | 1 | 1
| LOG_DISCORD | https://discordapp.com/api/webhooks/ID/TOKEN | https://discordapp.com/api/webhooks/ID/TOKEN
| LOG_PATH | ../log | ../log
| LOG_LEVEL | INFO | INFO
| LOG_DISCORD_WH | https://discordapp.com/api/webhooks/ID/TOKEN | Yes
| MAILCHIMP_API_KEY | OHqUg2ZigMshSX2ZUrh5m9qpoJ8ZchEK-us18 | Not set
| DISCORD_WH | https://discordapp.com/api/webhooks/ID/TOKEN | Not set
| MAILCHIMP_LIST_ID | c6b690fc10 | Not set

## Tests

Tests are coming...

![Tests are coming](https://www.disappearink.com.au/wp-content/uploads/2014/05/Brace-yourself-Winter-is-coming.jpg)