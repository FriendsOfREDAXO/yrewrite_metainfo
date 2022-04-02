<?php

$table_name = 'rex_yrewrite_domain_meta';

$yform = $this->getProperty('yform', []);
$yform = $yform[\rex_be_controller::getCurrentPage()] ?? [];

if ($table_name) {
    $_REQUEST['table_name'] = $table_name;
}

include \rex_path::plugin('yform', 'manager', 'pages/table_field.php');
