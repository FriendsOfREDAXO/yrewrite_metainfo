<?php

namespace Alexplusde\YrewriteMetainfo;

use rex_yform_manager_dataset;

rex_yform_manager_dataset::setModelClass(
    'rex_yrewrite_domain_meta',
    Domain::class,
);
rex_yform_manager_dataset::setModelClass(
    'rex_yrewrite_domain_meta_icon',
    Icon::class,
);

// rex_extension::register('REX_YFORM_SAVED', function (rex_extension_point $ep) {
// });
