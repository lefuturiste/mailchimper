<?php
return [
    "mailchimp" => [
        "key" => getenv('MAILCHIMP_API_KEY'),
        "list_id" => getenv('MAILCHIMP_LIST_ID'),
        "discord_wh" => getenv("DISCORD_WH")
    ]
];