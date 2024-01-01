<?php

registerWidget(
    'Recent posts',
    'Recent posts',
    plugin_path('/Recent posts/widget/body.php'),
    [
        "text" => "Widget title",
        "text" => "Widget property",
        "number" => "Widget count",
        "checkbox" => "Widget show",
        "tel" => "Phone",
        "email" => "Email"
    ]
);

registerWidget(
    'Updated pages',
    'Updated pages',
    plugin_path('/Recent posts/widget/body.php'),
    [
        "text" => "Widget title",
        "text" => "Widget property",
        "number" => "Widget count"
    ]
);
