# Meta-Infos und Globale Einstellungen für REDAXO auf Basis von YForm 4 / YForm 5 und YRewrite

Ergänzt YRewrite-Domains um die Möglichkeit, Metainformationen an Domains zu verwalten. Mit vorgefertigten, einfachen aber sinnvollen Konfigurationsfeldern, passender YOrm-Dataset-Methoden und Backend-Seiten für die Eingabe.

## Installation und Ersteinrichtung

### Upgrade-Hinweise von Version 1 auf 2

Durch den Wechsel zu FriendsOfREDAXO, dem Hinzufügen von Namespaces, dem Angleichen von Tabellennamen und dem Entfernen bestimmter Felder & Methoden ist das Upgrade nicht rückwärtskompatibel. Es wird dringend empfohlen, ein Upgrade im Wartungsmodus durchzuführen und die entsprechenden Änderungen zu übernehmen.

Tipp: Die Umbenennung der Tabellendefinition und Tabellen in `rex_yrewrite_metainfo` und `rex_yrewrite_metainfo_icon` vor dem Upgrade ausführen, um die bestehenden Daten zu übernehmen.

### Installation

Voraussetzungen: YRewrite ^2.10 mit mindestens einer eingerichteten Domain sowie YForm ^4.

1. Installiere das Addon über den REDAXO-Installer
2. Fülle in `YRewrite` > `Metainfo` Angaben zu deiner YRewrite-Domain aus
3. Füge in den `<head>`-Bereich deines oder deiner Templates folgenden Code ein: `<?= Domain::getHead() ?>`.

Anschließend werden die passenden Meta-Informationen, soweit ausgefüllt, ausgegeben.

> **Hinweis:** Das YRewrite-SEO-Objekt sowie OpenGraph- und weitere Meta-Tags, die bereits durch dieses Addon kommen, sollten aus deinem Template entfernt werden.

## Features

### Gemeinsamkeiten und Unterschiede zu anderen Addons

| Funktionen                 | Globale Einstellungen | Domain Settings     | YRewrite Metainfo      |
|----------------------------|-----------------------|---------------------|------------------------|
| Mindest-Anforderung        | REDAXO ^5.0           | REDAXO 5.3, PHP >=5 | REDAXO 5.17, PHP >=8.3 |
| Aktive Entwicklung         | ❌ Nein               | ⚠️ Unbekannt        | ✅ Ja                 |
| Multidomain-fähig          | ❌ Nein               | ✅ Ja               | ✅ Ja                 |
| Mehrsprachigkeit           | ✅ Ja                 | ✅ Ja               | ✅ Ja                 |
| Backend-Sprachen           | DE, EN, ES, SV        | DE                   | DE, EN                |
| YForm-basiert              | ❌ Nein               | ⚠️ Teilweise        | ✅ Ja                 |
| Feldtypen                  | ⚠️ 8                  | Alle YForm-Feldtypen | Alle YForm-Feldtypen  |
| Eigene Feldtypen           | ❌ Nein               | ✅ Ja               | ✅ Ja                 |
| HTML5-Feldtypen            | ❌ Nein               | ✅ Ja               | ✅ Ja                 |
| YOrm-Dataset-Methoden      | ❌ Nein               | ❌ Nein             | ✅ Ja                 |
| Head-Fragment              | ❌ Nein               | ❌ Nein             | ✅ Ja                 |
| Unterstützung von PWA      | ❌ Nein               | ❌ Nein             | ✅ Ja                 |
| Integration von `url`      | ❌ Nein               | ❌ Nein             | ✅ Ja                 |
| Integration von `speed_up` | ❌ Nein               | ❌ Nein             | ✅ Ja                 |
| Integration von `wsm`      | ❌ Nein               | ❌ Nein             | ✅ Ja                 |
| Umfangreiche Dokumentation | ✅ Ja                 | ❌ Nein             | ✅ Ja                 |
| Berechtigungssystem        | ❌ Nein               | ✅ Ja               | ❌ Nein               |
| rexstan-Level              | ⚠️ Unbekannt          | ⚠️ Unbekannt        | 🏆 Level 9            |
| Automatischer Import       | ❌ Nein               | ❌ Nein             | ✅ Ja                 |

### Fragen

#### Was unterscheidet dieses Addon von anderen REDAXO-Addons für Domain-Metainformationen?

- Dieses Addon kommt mit sinnvoll vorinstallierten Standard-Feldern als YForm Tableset. Installieren und loslegen!
- Die Klasse `domain` ist ein YOrm-Dataset. Du hast in deinem Code alle Features von YOrm zur Verfügung und kannst direkt loslegen, z.B. `domain::getCurrent()->getValue('mein_feld')`, oder vorhandene Dataset-Methoden verwendest.
- Standard-Fragment für den `<head>`-Bereich deiner Templates sind blitzschnell kopiert und eingefügt, wenn du bspw. eigene Metadaten pro Domain oder zusätzliche Einstellungen vergeben willst.

#### Kann ich nicht benötigte Standard-Felder auch löschen?

Wenn du dich mit anderen auf YForm basierten Addons wie YCom, Events, Neues, QandA o.ä. auskennst, weißt du, dass dies zwar möglich ist, aber unvorhergesehene Dinge bei Updates oder in der aktiven Verwendung des Addons passieren können. Wenn du bestimmte Felder nicht benötigst, dann blende sie am besten über ein eigenes Backend-CSS aus.

### Die Einstellungsseite

Anders als das Metainfo-Addon selbst oder abgeleitete Addons wie das Addon "Globale Einstellungen" basiert dieses Addon auf YForm. Um sich trotzdem nahtlos in die REDAXO-Struktur einzufügen, ergänzt dieses Addon folgende Backend-Seiten:

1. `YRewrite` > `Metainfo` > `Allgemein` - Lege hier Meta-Informationen für deine Domain an
2. `YRewrite` > `Icons und PWA-Profile` - Optional: Verwalte bequem PWA-Angaben und Favicon-Sets über das Backend und den Medienpool - ordne diese einer oder mehreren YRewrite-Domains zu.

> Tipp: Lasse dir das Set passender Icons über den [RealFavicon-Generator](https://realfavicongenerator.net/) erstellen und lade sie in den Medienpool hoch.

### Die Klasse `domain` - Meta-Infos für deine YRewrite-Domain

Einfache Methoden erleichtern dir die Nutzung:

- `Domain::getCurrent()` Erhalte das YOrm-Dataset mit Meta-Informationen zu deiner aktuellen YRewrite-Domain
- `$yrewrite_domain = $domain->getYRewrite()` das Original YRewrite-Domain-Objekt
- `$domain->getName()` Titel der Website, wird verwendet als, PWA-Titel, `og:title` u.a.
- `$domain->getLogo()` Logo der Website aus dem Medienpool, z.B. `file.svg`;

Weitere Methoden für die vorinstallierten Felder findest du in der Klasse `lib/domain.php` sowie in der zugehörigen Klasse `lib/icon.php` sowie in der Dokumentation.

### Fragmente

#### `head.php` optimiert Metadaten deiner Website/Arikel für soziale Netzwerke

Die Standard-Methoden von YRewrite zum anpassen des Titelschemas reichen oft nicht aus. Soziale Netzwerke, Messenger und andere Dienste erwarten heute vollständige Metadaten, Redakteure können diese in REDAXO passend pflegen und Besucher deiner Website erhalten beim Teilen von Links eine sinnvolle Linkvorschau.

Füge das Fragment `yrewrite_metainfo/head.php` im Head anstelle der YRewrite-SEO-Methoden ein. Überschreibe dieses Fragment in deinem `project`-Addon, wenn du zusätzliche Metadaten ausgeben möchtest - z.B. anhand des URL-Addons.

## Weiterentwicklung unterstützen

Du möchtest dieses Addon weiterentwickeln oder hast Vorschläge für Verbesserungen? Autor*innen und die Community bedanken sich für deine Unterstützung!

Du hast folgende Möglichkeiten:

1. 🙏🏻 [Issues](https://github.com/FriendsOfREDAXO/yrewrite_metainfo/issues) lösen und Pull Requests erstellen.
2. 💶 Projekt finanziell sponsoren: [GitHub Sponsors](https://github.com/alxndr-w) oder [Ko-fi](https://ko-fi.com/alxndr-w)

Damit wird auch die zukünftige Entwicklung dieses Addons gesichert.

## Lizenz

MIT Lizenz, siehe [LICENSE.md](https://github.com/alexplusde/yrewrite_metainfo/blob/master/LICENSE.md)  

## Autoren

Friends of REDAXO

**Projekt-Lead**  
[Alexander Walther](https://github.com/alxndr-w)

- <https://www.alexplus.de>  
- <https://github.com/alexplusde>

## Credits
