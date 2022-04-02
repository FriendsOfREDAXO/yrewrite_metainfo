<?php

rex_yform_manager_dataset::setModelClass(
    'rex_yrewrite_domain_meta',
    domain::class
);
rex_yform_manager_dataset::setModelClass(
    'rex_yrewrite_domain_meta_icon',
    icon::class
);
rex_yform_manager_dataset::setModelClass(
    'rex_yrewrite_domain_meta_cssvars',
    cssvars::class
);

// rex_extension::register('REX_YFORM_SAVED', function (rex_extension_point $ep) {
// });
