# `<head>`-Fragment

YRewrite Metainfo kommt standardmäßig mit einem passenden Fragment für den `<head>`-Bereich des HTML-Dokuments.

Das Fragment befindet sich in `fragments/yrewrite_metainfo/head.php`.

## Head-Fragment verwenden

Verwende folgenden Code: `<?= Domain::getHead() ?>` für die Ausgabe in deinem Template.

## Head-Fragment anpassen / überschreiben

Erstelle eine Datei `fragments/yrewrite_metainfo/head.php` in deinem Project-Addon oder Theme-Verzeichnis, um das mitgelieferte Fragment zu überschreiben.

> Hinweis: Diese Methode ist updatesicher, jedoch können mit zukünftigen Updates weitere Features in `yrewrite_metainfo` aufgenommen werden - diese müssen dann im eigenen `<head>`-Fragment angepasst werden.
