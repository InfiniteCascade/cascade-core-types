<?php

$classSettings = [];
$classSettings['id'] = $this->widgetId . '-grid';
$classSettings['dataProvider'] = $items;
$classSettings['emptyText'] = 'No ' . $this->Owner->title->plural . ' found.';
$classSettings['widget'] = $this->widgetId;
$classSettings['state'] = $this->state;
$classSettings['limit'] = 10;
$classSettings['columns'] = ['link'];
$classSettings['sortableAttributes'] = [
            'familiarity' => 'Familiarity',
            'last_accessed' => 'Last Accessed', ];
$classSettings['views'] = ['grid'];
$classSettings['currentView'] = 'grid';
$classSettings['additionalClasses'] = 'summary-widget';
// $classSettings['descriptor'] = $objectPrefix .'descriptor';
$templateContent = [
    'link',
];

$classSettings['rendererSettings'] = [
    'grid' => [
        'templateContent' => $templateContent,
    ],
];

$this->widget('\cascade\components\web\widgets\grid\View', $classSettings);
