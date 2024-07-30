# Meta-Infos und Globale Einstellungen für YRewrite Domains auf Basis von YForm 4

Ergänzt YRewrite um die Möglichkeit, Metainformationen an Domains zu verwalten. Mit vorgefertigten, einfachen aber sinnvollen Konfigurationsfeldern, passender YOrm-Dataset-Methoden und Backend-Seiten für die Eingabe.

## Installation und Ersteinrichtung

Voraussetzungen: YRewrite mit mind. einer eingerichteten Domain, YForm 4.0.

1. Installiere das Addon über den REDAXO-Installer
2. Fülle in `YRewrite` > `Allgemein` Angaben zu deiner YRewrite-Domain aus
3. Füge in den `<head>`-Bereich deines oder deiner Templates folgenden Code ein: `<?= domain::getHead() ?>`.

Anschließend werden die passenden Meta-Informationen, soweit ausgefüllt, ausgegeben.

> **Hinweis:** Das YRewrite-SEO-Objekt sowie OpenGraph- und weitere Meta-Tags, die bereits durch dieses Addon kommen, sollten aus deinem Template entfernt werden.
## Features
### Überblick

> Was unterscheidet dieses Addon von anderen REDAXO-Addons für Domain-Metainformationen?

- Dieses Addon kommt mit sinnvoll vorinstallierten Standard-Feldern als YForm Tableset. Installieren und loslegen!
- Die Klasse `domain` ist ein YOrm-Dataset. Du hast in deinem Code alle Features von YOrm zur Verfügung und kannst direkt loslegen, z.B. `domain::getCurrent()->getValue('mein_feld')`, oder vorhandene Dataset-Methoden verwendest.
- Bonus: Standard-Fragmente für den <head>-Bereich deiner Templates sind blitzschnell kopiert und eingefügt, wenn du bspw. eigene Metadaten pro Domain oder zusätzliche Einstellungen vergeben willst.

> Kann ich nicht benötigte Standard-Felder auch löschen?

Wenn du dich mit anderen auf YForm basierten Addons wie YCom, Events, Neues, QandA o.ä. auskennst, weißt du, dass dies zwar möglich ist, aber unvorhergesehene Dinge bei Updates oder in der aktiven Verwendung des Addons passieren können. Wenn du bestimmte Felder nicht benötigst, dann blende sie am besten über ein eigenes Backend-CSS aus.

### Die Einstellungsseite

Anders als das Metainfo-Addon selbst oder abgeleitete Addons wie das Addon "Globale Einstellungen" basiert dieses Addon auf YForm. Um sich trotzdem nahtlos in die REDAXO-Struktur einzufügen, ergänzt dieses Addon folgende Backend-Seiten:

1. `YRewrite` > `Allgemein`  - Lege hier Meta-Informationen für deine Domain an
2. `YRewrite` > `Icons und PWA-Profile` - Optional: Verwalte bequem PWA-Angaben und Favicon-Sets über das Backend und den Medienpool - ordne diese einer oder mehreren YRewrite-Domains zu.

### Die Klasse `domain` - Meta-Infos für deine YRewrite-Domain

Einfache Methoden erleichtern dir die Nutzung:

* `$domain::getCurrent()` Erhalte das YOrm-Dataset mit Meta-Informationen zu deiner aktuellen YRewrite-Domain
* `$yrewrite_domain $domain->getYRewrite()` das Original YRewrite-Domain-Objekt
* `$domain->getName()` Titel der Website, wird verwendet als, PWA-Titel, `og:title` u.a.
* `$domain->getLogo()` Logo der Website aus dem Medienpool, z.B. `file.svg`;

Weitere Methoden für die vorinstallierten Felder findest du in der Klasse `lib/domain.php` sowie in den zugehörigen Klassen `icon.php` und `cssvars.php`.

### Fragmente

#### `head.php` optimiert Metadaten deiner Website/Arikel für soziale Netzwerke

Die Standard-Methoden von YRewrite zum anpassen des Titelschemas reichen oft nicht aus. Soziale Netzwerke, Messenger und andere Dienste erwarten heute vollständige Metadaten, Redakteure können diese in REDAXO passend pflegen und Besucher deiner Website erhalten beim Teilen von Links eine sinnvolle Linkvorschau.

Füge das Fragment `yrewrite_metainfo/head.php` im Head anstelle der YRewrite-SEO-Methoden ein. Überschreibe dieses Fragment in deinem `project`-Addon, wenn du zusätzliche Metadaten ausgeben möchtest - z.B. anhand des URL-Addons.

## Lizenz

MIT Lizenz, siehe [LICENSE.md](https://github.com/alexplusde/dummy/blob/master/LICENSE.md)  

## Autoren

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde  

**Projekt-Lead**  
[Alexander Walther](https://github.com/alexplusde)

## Credits
