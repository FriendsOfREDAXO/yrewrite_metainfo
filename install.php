<?php
/* Tablesets aktualisieren */

rex_yform_manager_table_api::importTablesets(rex_file::get(rex_path::addon($this->name, 'install/rex_yrewrite_domain_meta.tableset.json')));

rex_yform_manager_table::deleteCache();
