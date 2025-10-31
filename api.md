# YRewrite Metainfo - API-Dokumentation

Meta-Infos und globale Einstellungen für REDAXO auf Basis von YForm 4+ und YRewrite

Ergänzt YRewrite-Domains um die Möglichkeit, Metainformationen an Domains zu verwalten. Mit vorgefertigten, einfachen aber sinnvollen Konfigurationsfeldern, passender YOrm-Dataset-Methoden und Backend-Seiten für die Eingabe.

## Die Klasse `Domain`

Kind-Klasse von `rex_yform_manager_dataset`, damit stehen alle Methoden von YOrm-Datasets zur Verfügung. Greift auf die Tabelle `rex_yrewrite_metainfo` zu.

> Es werden nachfolgend nur die durch dieses Addon ergänzten Methoden beschrieben. Lerne mehr über YOrm und die Methoden für Querys, Datasets und Collections in der [YOrm Doku](https://github.com/yakamara/yform/blob/master/docs/04_yorm.md)

### Infos zur aktuellen Domain erhalten

```php
$domain = Domain::getCurrent(); // Aktuelle Domain
$domain->getName(); // Website-Titel
$domain->getLogo(); // Logo
$domain->getValue('mein_feld') // Eigene Felder auslesen

// Statische Methoden
Domain::getCurrentValue('mein_feld'); // Direkt Wert der aktuellen Domain abrufen
Domain::getHead(); // HTML-Head-Fragment ausgeben
```

### Verfügbare Methoden

#### `getYrewriteDomainId()`

Gibt den Wert für das Feld `yrewrite_domain_id` (Domain) zurück:

```php
$dataset = Domain::get($id);
echo $dataset->getYrewriteDomainId();
```

#### `setYrewriteDomainId(mixed $value)`

Setzt den Wert für das Feld `yrewrite_domain_id` (Domain).

```php
$dataset = Domain::create();
$dataset->setYrewriteDomainId($value);
$dataset->save();
```

#### `getName()`

Gibt den Wert für das Feld `name` (Website-Titel) zurück:

```php
$dataset = Domain::get($id);
echo $dataset->getName();
```

#### `setName(mixed $value)`

Setzt den Wert für das Feld `name` (Website-Titel).

```php
$dataset = Domain::create();
$dataset->setName($value);
$dataset->save();
```

#### `getLogo(bool $asMedia = false)`

Gibt den Wert für das Feld `logo` (Logo) zurück: Logo, das im Template ausgegeben werden kann.

```php
$dataset = Domain::get($id);
$media = $dataset->getLogo(true);
```

#### `setLogo(string $filename)`

Setzt den Wert für das Feld `logo` (Logo).

```php
$dataset = Domain::create();
$dataset->setLogo($filename);
$dataset->save();
```

#### `getType()`

Gibt den Wert für das Feld `type` (og:type) zurück: OpenGraph-Type (Standard: `website`)

```php
$dataset = Domain::get($id);
echo $dataset->getType();
```

#### `setType(mixed $value)`

Setzt den Wert für das Feld `type` (og:type).

```php
$dataset = Domain::create();
$dataset->setType($value);
$dataset->save();
```

#### `getThumbnail(bool $asMedia = false)`

Gibt den Wert für das Feld `thumbnail` (og:image) zurück: OpenGraph-Bild (Linkvorschau)

```php
$dataset = Domain::get($id);
$media = $dataset->getThumbnail(true);
```

#### `setThumbnail(string $filename)`

Setzt den Wert für das Feld `thumbnail` (og:image).

```php
$dataset = Domain::create();
$dataset->setThumbnail($filename);
$dataset->save();
```

#### `getIcon()`

Gibt den Wert für das Feld `icon` (Profil (Icons, PWA)) zurück: In diesem Profil können Favicon- und Browser-Icons, Farbschema u.v.a. Eigenschaften für Progressive Web Apps ggf. für mehrere Domains angegeben werden.

```php
$dataset = Domain::get($id);
$beziehung = $dataset->getIcon();
```

#### `setIcon(mixed $value)`

Setzt den Wert für das Feld `icon` (Profil (Icons, PWA)).

```php
$dataset = Domain::create();
$dataset->setIcon($value);
$dataset->save();
```

#### `getYRewrite()`

Gibt das zugehörige YRewrite-Domain-Objekt zurück:

```php
$dataset = Domain::get($id);
$yrewrite_domain = $dataset->getYRewrite();
```

#### `getColor()`

Gibt die Theme-Farbe des verknüpften Icon-Profils zurück:

```php
$dataset = Domain::get($id);
$theme_color = $dataset->getColor();
```

#### `getLogoImg()`

Gibt die Logo-URL zurück (unterstützt Media Manager Responsive):

```php
$dataset = Domain::get($id);
$logo_url = $dataset->getLogoImg();
```

#### `getScripts()`

Gibt ein Array der konfigurierten JavaScript-Dateien zurück:

```php
$dataset = Domain::get($id);
$scripts = $dataset->getScripts(); // Array von Dateinamen
```

#### `setScripts(array $value)`

Setzt JavaScript-Dateien für die Domain:

```php
$dataset = Domain::create();
$dataset->setScripts(['script1.js', 'script2.js']);
$dataset->save();
```

#### `getStyles()`

Gibt ein Array der konfigurierten CSS-Dateien zurück:

```php
$dataset = Domain::get($id);
$styles = $dataset->getStyles(); // Array von Dateinamen
```

#### `setStyles(array $value)`

Setzt CSS-Dateien für die Domain:

```php
$dataset = Domain::create();
$dataset->setStyles(['style1.css', 'style2.css']);
$dataset->save();
```

#### Statische Hilfsmethoden

##### `getCurrentValue(string $key)`

Ruft direkt einen Wert der aktuellen Domain ab:

```php
$website_name = Domain::getCurrentValue('name');
$logo = Domain::getCurrentValue('logo');
```

##### `getHead()`

Gibt das HTML-Head-Fragment aus:

```php
echo Domain::getHead(); // Vollständige Meta-Tags
```

##### `getAvailableStyles()`

Gibt verfügbare CSS-Dateien aus dem Assets-Ordner zurück (für Choice-Felder):

```php
$css_files = Domain::getAvailableStyles(); // Array für YForm Choice-Feld
```

##### `getAvailableScripts()`

Gibt verfügbare JavaScript-Dateien aus dem Assets-Ordner zurück (für Choice-Felder):

```php
$js_files = Domain::getAvailableScripts(); // Array für YForm Choice-Feld
```

## Die Klasse `Icon`

Kind-Klasse von `rex_yform_manager_dataset`, damit stehen alle Methoden von YOrm-Datasets zur Verfügung. Greift auf die Tabelle `rex_yrewrite_metainfo_icon` zu.

> Es werden nachfolgend nur die durch dieses Addon ergänzten Methoden beschrieben. Lerne mehr über YOrm und die Methoden für Querys, Datasets und Collections in der [YOrm Doku](https://github.com/yakamara/yform/blob/master/docs/04_yorm.md)

### Icons und PWA-Daten abrufen

```php
$domain = Domain::getCurrent();
$icon = $domain->getIcon();
if ($icon) {
    echo $icon->getIcon16();
    echo $icon->getIcon16Url();
    echo $icon->getIcon32();
    echo $icon->getIcon32Url();
    echo $icon->getManifest();
    // usw.
}
```

### Verfügbare Methoden

#### `getName()`

Gibt den Wert für das Feld `name` (Profilname) zurück: Name des Profils (wird nur für die Anzeige unter "Allgemein" verwendet)

```php
$dataset = Icon::get($id);
echo $dataset->getName();
```

#### `setName(mixed $value)`

Setzt den Wert für das Feld `name` (Profilname).

```php
$dataset = Icon::create();
$dataset->setName($value);
$dataset->save();
```

#### `getShortName()`

Gibt den Wert für das Feld `short_name` (PWA Kurzname (App-Verknüpfung)) zurück: Wird verwendet, wenn die Website als PWA-Verknüpfung auf dem Home-Screen oder Startmenü dargestellt wird.

```php
$dataset = Icon::get($id);
echo $dataset->getShortName();
```

#### `setShortName(mixed $value)`

Setzt den Wert für das Feld `short_name` (PWA Kurzname (App-Verknüpfung)).

```php
$dataset = Icon::create();
$dataset->setShortName($value);
$dataset->save();
```

#### `getDisplay()`

Gibt den Wert für das Feld `display` (PWA Browser-UI) zurück: Gibt an, wie viel Browser-UI innerhalb der PWA noch sichtbar ist, z.B. Reload-Button

```php
$dataset = Icon::get($id);
echo $dataset->getDisplay();
```

#### `setDisplay(mixed $value)`

Setzt den Wert für das Feld `display` (PWA Browser-UI).

```php
$dataset = Icon::create();
$dataset->setDisplay($value);
$dataset->save();
```

#### `getThemeColor()`

Gibt den Wert für das Feld `theme_color` (PWA Theme-Farbe) zurück: `<meta name="theme-color">`

```php
$dataset = Icon::get($id);
echo $dataset->getThemeColor();
```

#### `setThemeColor(mixed $value)`

Setzt den Wert für das Feld `theme_color` (PWA Theme-Farbe).

```php
$dataset = Icon::create();
$dataset->setThemeColor($value);
$dataset->save();
```

#### `getBackgroundColor()`

Gibt den Wert für das Feld `background_color` (PWA Hintergrund-Farbe) zurück: Hintergrundfarbe, z.B. beim Starten der PWA

```php
$dataset = Icon::get($id);
echo $dataset->getBackgroundColor();
```

#### `setBackgroundColor(mixed $value)`

Setzt den Wert für das Feld `background_color` (PWA Hintergrund-Farbe).

```php
$dataset = Icon::create();
$dataset->setBackgroundColor($value);
$dataset->save();
```

#### `getMsapplicationTitleColor()`

Gibt den Wert für das Feld `msapplication_title_color` (PWA Titelleisten-Farbe) zurück: (nur Microsoft Windows), `<meta name="msapplication-TileColor">`

```php
$dataset = Icon::get($id);
echo $dataset->getMsapplicationTitleColor();
```

#### `setMsapplicationTitleColor(mixed $value)`

Setzt den Wert für das Feld `msapplication_title_color` (PWA Titelleisten-Farbe).

```php
$dataset = Icon::create();
$dataset->setMsapplicationTitleColor($value);
$dataset->save();
```

#### `getShortcutIcon(bool $asMedia = false)`

Gibt den Wert für das Feld `shortcut_icon` (Favicon) zurück: `favicon.ico`

```php
$dataset = Icon::get($id);
$media = $dataset->getShortcutIcon(true);
```

#### `setShortcutIcon(string $filename)`

Setzt den Wert für das Feld `shortcut_icon` (Favicon).

```php
$dataset = Icon::create();
$dataset->setShortcutIcon($filename);
$dataset->save();
```

#### `getIcon16(bool $asMedia = false)`

Gibt den Wert für das Feld `icon_16` (16x16) zurück: 16×16px

```php
$dataset = Icon::get($id);
$media = $dataset->getIcon16(true);
```

#### `setIcon16(string $filename)`

Setzt den Wert für das Feld `icon_16` (16x16).

```php
$dataset = Icon::create();
$dataset->setIcon16($filename);
$dataset->save();
```

#### `getIcon32(bool $asMedia = false)`

Gibt den Wert für das Feld `icon_32` (32x32) zurück: 32×32px

```php
$dataset = Icon::get($id);
$media = $dataset->getIcon32(true);
```

#### `setIcon32(string $filename)`

Setzt den Wert für das Feld `icon_32` (32x32).

```php
$dataset = Icon::create();
$dataset->setIcon32($filename);
$dataset->save();
```

#### `getAppleTouchIcon(bool $asMedia = false)`

Gibt den Wert für das Feld `apple_touch_icon` (Apple Touch) zurück: 180×180px

```php
$dataset = Icon::get($id);
$media = $dataset->getAppleTouchIcon(true);
```

#### `setAppleTouchIcon(string $filename)`

Setzt den Wert für das Feld `apple_touch_icon` (Apple Touch).

```php
$dataset = Icon::create();
$dataset->setAppleTouchIcon($filename);
$dataset->save();
```

#### `getSafariPinnedTab(bool $asMedia = false)`

Gibt den Wert für das Feld `safari_pinned_tab` (Safari Pinned Tab) zurück: `safari-pinned-tab.svg`

```php
$dataset = Icon::get($id);
$media = $dataset->getSafariPinnedTab(true);
```

#### `setSafariPinnedTab(string $filename)`

Setzt den Wert für das Feld `safari_pinned_tab` (Safari Pinned Tab).

```php
$dataset = Icon::create();
$dataset->setSafariPinnedTab($filename);
$dataset->save();
```

#### `getManifest(bool $asMedia = false)`

Gibt den Wert für das Feld `manifest` (webmanifest.json) zurück: `site.webmanifest`

```php
$dataset = Icon::get($id);
$media = $dataset->getManifest(true);
```

#### `setManifest(string $filename)`

Setzt den Wert für das Feld `manifest` (webmanifest.json).

```php
$dataset = Icon::create();
$dataset->setManifest($filename);
$dataset->save();
```

#### `getFaviconPng96(bool $asMedia = false)`

Gibt den Wert für das Feld `favicon_png_96` (PNG Favicon 96x96) zurück:

```php
$dataset = Icon::get($id);
$media = $dataset->getFaviconPng96(true);
```

#### `getFaviconPng96Url()`

Gibt die URL für das PNG Favicon (96x96) zurück:

```php
$dataset = Icon::get($id);
$url = $dataset->getFaviconPng96Url();
```

#### `setFaviconPng96(string $filename)`

Setzt den Wert für das Feld `favicon_png_96` (PNG Favicon 96x96):

```php
$dataset = Icon::create();
$dataset->setFaviconPng96($filename);
$dataset->save();
```

#### `getFaviconSvg(bool $asMedia = false)`

Gibt den Wert für das Feld `favicon_svg` (SVG Favicon) zurück:

```php
$dataset = Icon::get($id);
$media = $dataset->getFaviconSvg(true);
```

#### `getFaviconSvgUrl()`

Gibt die URL für das SVG Favicon zurück:

```php
$dataset = Icon::get($id);
$url = $dataset->getFaviconSvgUrl();
```

#### `setFaviconSvg(string $filename)`

Setzt den Wert für das Feld `favicon_svg` (SVG Favicon):

```php
$dataset = Icon::create();
$dataset->setFaviconSvg($filename);
$dataset->save();
```

### URL-Hilfsmethoden

Für alle Media-Felder gibt es entsprechende URL-Methoden:

```php
$icon = Icon::get($id);

// URL-Methoden für direkte Ausgabe
echo $icon->getShortcutIconUrl();     // Favicon URL
echo $icon->getAppleTouchIconUrl();   // Apple Touch Icon URL
echo $icon->getManifestUrl();         // Manifest URL
echo $icon->getFaviconPng96Url();     // PNG Favicon URL
echo $icon->getFaviconSvgUrl();       // SVG Favicon URL
```

## `<head>`-Fragment

YRewrite Metainfo kommt standardmäßig mit einem passenden Fragment für den `<head>`-Bereich des HTML-Dokuments.

Das Fragment befindet sich in `fragments/yrewrite_metainfo/head.php`.

### Head-Fragment verwenden

Verwende folgenden Code: `<?= Domain::getHead() ?>` für die Ausgabe in deinem Template.

### Head-Fragment anpassen / überschreiben

Erstelle eine Datei `fragments/yrewrite_metainfo/head.php` in deinem Project-Addon oder Theme-Verzeichnis, um das mitgelieferte Fragment zu überschreiben.

> **Hinweis:** Diese Methode ist updatesicher, jedoch können mit zukünftigen Updates weitere Features in `yrewrite_metainfo` aufgenommen werden - diese müssen dann im eigenen `<head>`-Fragment angepasst werden.

### Template-Integration

```php
// Standard-Integration im Template-Head
<?= Domain::getHead() ?>

// Manueller Zugriff auf Metadaten
<?php
$domain = Domain::getCurrent();
if ($domain && $domain->getName()) {
    echo '<title>' . rex_escape($domain->getName()) . '</title>';
}
?>

// Logo nur ausgeben wenn vorhanden
<?php
$domain = Domain::getCurrent();
if ($domain && $domain->getLogo()) {
    $media = rex_media::get($domain->getLogo());
    if ($media) {
        echo '<img src="' . rex_url::media($media->getFileName()) . '" alt="Logo">';
    }
}
?>

// PWA-Manifest nur bei verfügbarem Icon-Profil
<?php
$domain = Domain::getCurrent();
if ($domain && $domain->getIcon()) {
    echo '<link rel="manifest" href="/manifest.json">';
}
?>
```

### Eigene Meta-Tags ergänzen

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
