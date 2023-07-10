<?php

return [
    "labels" => [
        "search" => "Procurar",
        "base_url" => "URL Base",
    ],

    "auth" => [
        "none" => "This API is not authenticated.",
        "instruction" => [
            "query" => <<<TEXT
                To authenticate requests, include a query parameter **`:parameterName`** in the request.
                TEXT,
            "body" => <<<TEXT
                To authenticate requests, include a parameter **`:parameterName`** in the body of the request.
                TEXT,
            "query_or_body" => <<<TEXT
                To authenticate requests, include a parameter **`:parameterName`** either in the query string or in the request body.
                TEXT,
            "bearer" => <<<TEXT
                Para autenticar solicitações, inclua um Header **`Authorization`** com o valor **`"Bearer :placeholder"`**.
                TEXT,
            "basic" => <<<TEXT
                To authenticate requests, include an **`Authorization`** header in the form **`"Basic {credentials}"`**. 
                The value of `{credentials}` should be your username/id and your password, joined with a colon (:), 
                and then base64-encoded.
                TEXT,
            "header" => <<<TEXT
                To authenticate requests, include a **`:parameterName`** header with the value **`":placeholder"`**.
                TEXT,
        ],
        "details" => <<<TEXT
            Todos os endpoints autenticados são marcados com um selo "requer autenticação" na documentação abaixo.
            TEXT,
    ],

    "headings" => [
        "introduction" => "Introdução",
        "auth" => "Solicitações de autenticação",
    ],

    "endpoint" => [
        "request" => "Request",
        "headers" => "Headers",
        "url_parameters" => "URL Parameters",
        "body_parameters" => "Body Parameters",
        "query_parameters" => "Query Parameters",
        "response" => "Response",
        "response_fields" => "Response Fields",
        "example_request" => "Example request",
        "example_response" => "Example response",
        "responses" => [
            "binary" => "Binary data",
            "empty" => "Empty response",
        ],
    ],

    "try_it_out" => [
        "open" => "Try it out ⚡",
        "cancel" => "Cancel 🛑",
        "send" => "Send Request 💥",
        "loading" => "⏱ Sending...",
        "received_response" => "Received response",
        "request_failed" => "Request failed with error",
        "error_help" => <<<TEXT
            Tip: Check that you're properly connected to the network.
            If you're a maintainer of ths API, verify that your API is running and you've enabled CORS.
            You can check the Dev Tools console for debugging information.
            TEXT,
    ],

    "links" => [
        "postman" => "View Postman collection",
        "openapi" => "View OpenAPI spec",
    ],
];