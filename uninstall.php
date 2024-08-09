<?php

if (rex_addon::get('yform')->isAvailable() && !rex::isSafeMode()) {
    rex_yform_manager_table_api::removeTable('rex_yrewrite_metainfo');
    rex_yform_manager_table_api::removeTable('rex_yrewrite_metainfo_icon');
}
