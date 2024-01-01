<?php

require_once base_path('/app/Blasta/Classes/WidgetArea.php');
require_once base_path('/app/Blasta/Classes/Widget.php');

/**
 * Registers a widget area on active theme
 */
function registerWidgetArea(string $widgetAreaName)
{
    $widgetArea = WidgetArea::getInstance();
    $widgetArea->register($widgetAreaName);
}

/**
 * Get all widgets
 */
function getWidgets()
{
    $widget = Widget::getInstance();
    return $widget->all();
}

/**
 * Returns all active widgets
 */
function getActiveWidgets(bool $assoc = false)
{
    $widget = Widget::getInstance();
    return $widget->getActive($assoc);
}

/**
 * Get widget by name
 */
function getWidget(string $name)
{
    $widget = Widget::getInstance();
    return $widget->getWidget($name);
}

/**
 * Get all widget areas
 */
function getWidgetAreas()
{
    $widgetAreas = WidgetArea::getInstance();
    return $widgetAreas->all();
}

/**
 * Create a new widget
 */
function registerWidget(string $name, string $title, string $body, ?array $options = null)
{
    $widget = Widget::getInstance();
    $widget->register($name, $title, $body, $options);
}

/**
 * Adds a widget to a widget area
 */
function addToActiveWidgets(string $widgetArea, string $name, string $title, string $body, ?array $options = null)
{
    $jsonPath = base_path('/app/Blasta/active_widgets.json');
    $activeWidgets = json_decode(file_get_contents($jsonPath), true);

    if ($options !== null) {
        $newOptions = [];
        foreach ($options as $option => $value) {
            $newOptions[] = [unsnakeCase(' ', $option) => $value];
        }
        $options = $newOptions;
    }

    $widget = [
        'name'      => $name,
        'title'     => $title,
        'body'      => $body,
        'options'   => $options
    ];

    $activeWidgets[$widgetArea][] = $widget;

    file_put_contents($jsonPath, json_encode($activeWidgets));
}

function setActiveWidgets(string $widgetArea, array $widgets)
{
    $jsonPath = base_path('/app/Blasta/active_widgets.json');
    $activeWidgets = json_decode(file_get_contents($jsonPath), true);

    unset($activeWidgets[$widgetArea]);

    foreach ($widgets as $widget) {
        $options = $widget['options'] ?? null;

        if ($options !== null) {
            $newOptions = [];
            foreach ($options as $option => $value) {
                $newOptions[] = [unsnakeCase(' ', $option) => $value];
            }
            $options = $newOptions;
        }

        $newWidget = [
            'name'      => $widget['name'],
            'title'     => $widget['title'],
            'body'      => $widget['body'],
            'options'   => $options
        ];
    
        $activeWidgets[$widgetArea][] = $newWidget;
    }

    file_put_contents($jsonPath, json_encode($activeWidgets));
}

/**
 * Loads selected widgets to designated widget areas
 */
function loadWidgets(string $widgetArea)
{
    $jsonPath   = base_path('/app/Blasta/active_widgets.json');
    $allWidgets = json_decode(file_get_contents($jsonPath), true);
    $widgets    = [];

    if (empty($allWidgets[$widgetArea])) {
        return null;
    }

    $widgets = json_encode($allWidgets[$widgetArea]);

    return json_decode($widgets);
}

/**
 * Gets the widget title
 */
function getWidgetTitle(object $widget)
{
    if (!empty($widget->options->title)) {
        return $widget->options->title;
    }

    return $widget->title;
}

/**
 * Gets the widget title
 */
function getWidgetBody(object $widget)
{
    include_once $widget->body;
}

/**
 * Checks if widget options type is allowed
 */
function optionTypeIsAllowed(string $type): bool
{
    $allowedTypes = [
        'checkbox',
        'color',
        'date',
        'datetime',
        'datetime-local',
        'email',
        'month',
        'number',
        'password',
        'range',
        'tel',
        'text',
        'time',
        'url',
        'week',
    ];

    if (in_array($type, $allowedTypes)) {
        return true;
    }

    return false;
}
