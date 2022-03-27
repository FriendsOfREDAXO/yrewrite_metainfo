# Metainfos für YRewrite Domains auf Basis von YForm 4

Ergänzt YRewrite um die Möglichkeit, Metainformationen an Domains zu verwalten. Mit vorgefertigten, einfachen aber sinnvollen Konfigurationsfeldern, einer YOrm-Dataset-Methode und passenden Backend-Seiten.

## Features

### Überblick

> Was unterscheidet dieses Addon von anderen REDAXO-Addons für Domain-Metainformationen?

- Dieses Addon kommt mit sinnvoll vorinstallierten Standard-Feldern als YForm Tableset. Installieren und loslegen!
- Die Klasse `rex_yrewrite_domain_meta` ist ein YOrm-Dataset. Du hast in deinem Code alle Features von YOrm zur Verfügung und kannst direkt loslegen, z.B. `rex_yrewrite_domain_meta::getCurrent()->getValue('mein_feld')`.
- Bonus: Standard-Fragmente für den `<head>`-Bereich deiner Templates sind blitzschnell kopiert und eingefügt, wenn du bspw. das Design jeder Domain mit eigenen CSS-Variablen anpassen willst (Bootstrap 5 und CSS-Frameworks) oder die Linkvorschau und Metadaten für Suchmaschinen, soziale Netzwerke und Messenger mit einem Klick optimieren willst.

> Kann ich nicht benötigte Standard-Felder auch löschen?

Wenn du dich mit anderen auf YForm basierten Addons wie YCom, Events, Neues, QandA o.ä. auskennst, weißt du, dass dies zwar möglich ist, aber unvorhergesehene Dinge bei Updates oder in der aktiven Verwendung des Addons passieren können. Wenn du bestimmte Felder nicht benötigst, dann blende sie am besten über ein eigenes Backend-CSS aus.

### Die Einstellungsseiten

Anders als das Metainfo-Addon selbst oder abgeleitete Addons wie das Addon "Globale Einstellungen" basiert dieses Addon auf YForm. Um sich trotzdem nahtlos in die REDAXO-Struktur einzufügen, ergänzt dieses Addon folgende Backend-Seiten:

1. Metainfos - neben Artikel, Kategorien, Medien und Sprachen gibt es einen neuen Reiter "Domains". Du kannst aber auch wie gewohnt über `Tabelle editieren` in YForm gehen.
2. YRewrite - neben "Domains", "Alias" und Co. gibt es einen neuen Reiter "Metainfos".

### Die Klasse `rex_yrewrite_domain_meta`

Einfache Methoden erleichtern dir die Nutzung:

* `$yrewrite_domain rex_yrewrite_domain_meta::getYRewrite()` das klassische YRewrite-Objekt zur aktuellen Domain (ohne Metainfos)
* `$domain = rex_yrewrite_domain_meta::getCurrent()` ein YOrm Dataset mit allen Metainfos zur aktuellen Domain
* `$domain->getTitle()` Titel der Website, wird verwendet im Title-Tag, App-Titel, `og:title` u.a.
* `$domain->getColor()` Hauptfarbe der Website als Hexwert, z.B. `#0088FF`;
* `$domain->getLogo()` Logo der Website aus dem Medienpool, z.B. `file.svg`;

### Fragmente

#### `domain_cssvars.php`

Deine Seite verfügt über CSS-Variablen? Mach diese anpassbar pro YRewrite-Domain. Füge das Fragment `domain_cssvars.php` im Head ein oder generiere eine passende CSS-Datei daraus und füge diese in dein Template ein.

#### `domain_html_head.php` optimiert Metadaten deiner Website/Arikel für soziale Netzwerke

Die Standard-Methoden von YRewrite zum anpassen des Titelschemas reichen oft nicht aus. Soziale Netzwerke, Messenger und andere Dienste erwarten heute vollständige Metadaten, Redakteure können diese in REDAXO passend pflegen und Besucher deiner Website erhalten beim Teilen von Links eine sinnvolle Linkvorschau.

Füge das Fragment `domain_html_head.php` im Head anstelle der YRewrite-Methoden ein. Überschreibe dieses Fragment  in deinem `project`-Addon, wenn du zusätzliche Metadaten ausgeben möchtest - z.B. anhand des URL-Addons.

## Lizenz

MIT Lizenz, siehe [LICENSE.md](https://github.com/alexplusde/dummy/blob/master/LICENSE.md)  

## Autoren

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde  

**Projekt-Lead**  
[Alexander Walther](https://github.com/alexplusde)

## Credits

Danke an [Christoph Böcker](https://github.com/christophboecker) für die Basis zur Nutzung von YForm in Addons
