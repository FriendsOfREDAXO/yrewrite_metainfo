<?php

/**
 * @var rex_addon $this
 * @psalm-scope-this rex_addon
 */

rex_response::sendRedirect(rex_url::backendController(['page' => 'yform/manager/table_field', 'table_name' => 'rex_yrewrite_metainfo'], false));
