# YRewrite Metainfo

Meta-Informationen und Einstellungen für YRewrite-Domains

Ermöglicht die Verwaltung von Metainformationen für YRewrite-Domains. Das Addon stellt vorkonfigurierte Felder, YOrm-Dataset-Methoden und Backend-Seiten zur Verfügung.

## Installation

### Neuinstallation

Voraussetzungen: YRewrite ^2.10 mit mindestens einer eingerichteten Domain sowie YForm >=4, <6.

1. Installiere das Addon über den REDAXO-Installer
2. Konfiguriere in `YRewrite` > `Metainfo` die gewünschten Angaben für deine YRewrite-Domain
3. Füge in den `<head>`-Bereich deines Templates folgenden Code ein: `<?= Domain::getHead() ?>`

Die konfigurierten Meta-Informationen werden automatisch ausgegeben.

> **Hinweis:** Das YRewrite-SEO-Objekt sowie OpenGraph- und weitere Meta-Tags, die bereits durch dieses Addon kommen, sollten aus deinem Template entfernt werden.

### Upgrade von Version 1 auf 2

Das Upgrade ist nicht rückwärtskompatibel. Führe das Upgrade im Wartungsmodus durch. Tabellennamen wurden zu `rex_yrewrite_metainfo` und `rex_yrewrite_metainfo_icon` geändert.

### Upgrade von Version 2 auf 3

Methodennamen für Icon-Handling haben sich geändert. Bei überschriebenem `head.php` Fragment sind Anpassungen erforderlich.

## Funktionen

Das Addon bietet folgende Hauptfunktionen:

- Verwaltung von Meta-Informationen für YRewrite-Domains
- Vorkonfigurierte YForm-Felder für häufig benötigte Metadaten
- YOrm-Dataset-Klassen für programmatischen Zugriff
- Integration von PWA-Features und Icon-Management
- Template-Fragmente für automatische Meta-Tag-Ausgabe

### Verfügbare Felder

- Domain-Name und Beschreibung
- OpenGraph-Metadaten (og:title, og:image, og:type)
- PWA-Einstellungen (App-Name, Icons, Farben)
- Favicon und Touch-Icons
- Custom Meta-Tags

### Backend-Verwaltung

Das Addon basiert auf YForm und integriert sich in die REDAXO-Backend-Struktur mit folgenden Seiten:

1. `YRewrite` > `Metainfo` > `Allgemein` - Verwaltung der Meta-Informationen für Domains
2. `YRewrite` > `Icons und PWA-Profile` - Verwaltung von PWA-Einstellungen und Favicon-Sets

Icon-Sets können über den [RealFavicon-Generator](https://realfavicongenerator.net/) erstellt und über den Medienpool verwaltet werden.

## API-Referenz

### Die Klasse `Domain` - YOrm-Dataset für Meta-Informationen

Das Addon stellt eine YOrm-Dataset-Klasse zur Verfügung:

#### Grundlegende Methoden

```php
// Aktuelles Domain-Dataset abrufen
$domain = Domain::getCurrent();

// Original YRewrite-Domain-Objekt
$yrewrite_domain = $domain->getYRewrite();

// Domain-ID
$domain_id = $domain->getId();
```

#### Meta-Informationen abrufen

```php
$domain = Domain::getCurrent();

// Website-Titel (für PWA, og:title, etc.)
$title = $domain->getName();

// Website-Logo aus dem Medienpool
$logo = $domain->getLogo();

// OpenGraph-Typ
$og_type = $domain->getType();

// OpenGraph-Bild
$og_image = $domain->getThumbnail();

// Beschreibung
$description = $domain->getDescription();
```

#### Icon/PWA-Verwaltung

```php
$domain = Domain::getCurrent();

// Icon-Profil abrufen
$icon_profile = $domain->getIcon();

if ($icon_profile) {
    // PWA-Name
    $app_name = $icon_profile->getName();
    
    // Kurzer App-Name
    $short_name = $icon_profile->getShortname();
    
    // Theme-Farbe
    $theme_color = $icon_profile->getThemeColor();
    
    // Hintergrundfarbe
    $bg_color = $icon_profile->getBackgroundColor();
    
    // Favicon-Dateien
    $favicon_png = $icon_profile->getFaviconPng96();
    $favicon_svg = $icon_profile->getFaviconSvg();
    $apple_touch = $icon_profile->getAppleTouchIcon();
}
```

### Codebeispiele

#### Template-Integration

```php
// Im Template-Head
<?= Domain::getHead() ?>

// Manueller Zugriff auf Metadaten
<?php
$domain = Domain::getCurrent();
if ($domain && $domain->getName()) {
    echo '<title>' . rex_escape($domain->getName()) . '</title>';
}
?>
```

#### Bedingte Ausgaben

```php
<?php
$domain = Domain::getCurrent();

// Logo nur ausgeben wenn vorhanden
if ($domain && $domain->getLogo()) {
    $media = rex_media::get($domain->getLogo());
    if ($media) {
        echo '<img src="' . rex_url::media($media->getFileName()) . '" alt="Logo">';
    }
}

// PWA-Manifest nur bei verfügbarem Icon-Profil
if ($domain && $domain->getIcon()) {
    echo '<link rel="manifest" href="/manifest.json">';
}
?>
```

#### Eigene Meta-Tags ergänzen

```php
// Im project-Addon: fragments/yrewrite_metainfo/head.php
<?php
// Standard-Head ausgeben
echo $this->subfragment('yrewrite_metainfo/head.php');

// Zusätzliche Meta-Tags
$domain = Domain::getCurrent();
if ($domain) {
    echo '<meta name="author" content="' . rex_escape($domain->getName()) . '">';
    echo '<meta name="generator" content="REDAXO">';
}
?>
```

### Fragmente

#### `head.php` - Metadaten für soziale Netzwerke

Das Fragment erweitert die Standard-YRewrite-Funktionen um zusätzliche Metadaten für soziale Netzwerke, Messenger und andere Dienste. Dies ermöglicht aussagekräftige Linkvorschauen beim Teilen von Inhalten.

Das Fragment `yrewrite_metainfo/head.php` kann als Ersatz für die Standard-YRewrite-SEO-Methoden verwendet werden. Bei Bedarf lässt sich das Fragment im `project`-Addon anpassen oder erweitern.

## Mitarbeit

Du möchtest dieses Addon weiterentwickeln oder hast Vorschläge für Verbesserungen? Die Community freut sich über deine Unterstützung!

Möglichkeiten zur Mitarbeit:
- [Issues](https://github.com/FriendsOfREDAXO/yrewrite_metainfo/issues) melden und beheben
- Pull Requests mit Verbesserungen erstellen

## Lizenz

MIT Lizenz, siehe [LICENSE](https://github.com/FriendsOfREDAXO/yrewrite_metainfo/blob/master/LICENSE)  

## Autor

**Friends of REDAXO**

Dank an [Alexander Walther](https://github.com/AWqxKAWERbXo) für die ursprüngliche Entwicklung und Projektleitung.
