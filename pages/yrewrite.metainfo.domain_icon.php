<?php

/**
 * @var rex_addon $this
 * @psalm-scope-this rex_addon
 */

$addon = rex_addon::get('yrewrite_metainfo');
$table_name = 'rex_yrewrite_metainfo_icon';

rex_extension::register(
    'YFORM_MANAGER_DATA_PAGE_HEADER',
    static function (rex_extension_point $ep) {
        if ($ep->getParam('yform')->table->getTableName() === $ep->getParam('table_name')) { // @phpstan-ignore-line
            return '';
        }
    },
    rex_extension::EARLY,
    ['table_name' => $table_name],
);

$_REQUEST['table_name'] = $table_name; /** @phpstan-ignore-line */

include rex_path::plugin('yform', 'manager', 'pages/data_edit.php');
