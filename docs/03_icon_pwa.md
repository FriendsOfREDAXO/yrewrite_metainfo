# Die Klasse `Icon`

Kind-Klasse von `rex_yform_manager_dataset`, damit stehen alle Methoden von YOrm-Datasets zur Verfügung. Greift auf die Tabelle `yrewrite_metainfo_icon` zu.

> Es werden nachfolgend nur die durch dieses Addon ergänzten Methoden beschrieben. Lerne mehr über YOrm und den Methoden für Querys, Datasets und Collections in der [YOrm Doku](https://github.com/yakamara/yform/blob/master/docs/04_yorm.md)

## Alle Einträge erhalten

```php
use FriendsOfREDAXO\YRewriteMetainfo\Domain;
use FriendsOfREDAXO\YRewriteMetainfo\Icon;

$domain = Domain::getCurrent();
$icon = $domain->getIcon();
echo $icon->getFaviconPng96();
echo $icon->getFaviconPng96Url();
echo $icon->getFaviconSvg();
echo $icon->getFaviconSvgUrl();
echo $icon->getManifest();
// usw.
```

## Methoden und Beispiele

### `getName()`

Gibt den Wert für das Feld `name` (Profilname) zurück: Name des Profils (wird nur für die Anzeige unter "Allgemein" verwendet)

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getName();
```

### `setName(mixed $value)`

Setzt den Wert für das Feld `name` (Profilname).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setName($value);
$dataset->save();
```

### `getShortName()`

Gibt den Wert für das Feld `short_name` (PWA Kurzname (App-Verknüpfung)) zurück: Wird verwendet, wenn die Website als PWA-Verknüpfung auf dem Home-Screen oder Startmenü dargestellt wird.

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getShortName();
```

### `setShortName(mixed $value)`

Setzt den Wert für das Feld `short_name` (PWA Kurzname (App-Verknüpfung)).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setShortName($value);
$dataset->save();
```

### `getDisplay()`

Gibt den Wert für das Feld `display` (PWA Browser-UI) zurück: Gibt an, wie viel Browser-UI innerhalb der PWA noch sichtbar ist, z.B. Reload-Button

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getDisplay();
```

### `setDisplay(mixed $value)`

Setzt den Wert für das Feld `display` (PWA Browser-UI).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setDisplay($value);
$dataset->save();
```

### `getThemeColor()`

Gibt den Wert für das Feld `theme_color` (PWA Theme-Farbe) zurück: `<meta name="theme-color">`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getThemeColor();
```

### `setThemeColor(mixed $value)`

Setzt den Wert für das Feld `theme_color` (PWA Theme-Farbe).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setThemeColor($value);
$dataset->save();
```

### `getBackgroundColor()`

Gibt den Wert für das Feld `background_color` (PWA Hintergrund-Farbe) zurück: Hintergrundfarbe, z.B. beim Starten der PWA

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getBackgroundColor();
```

### `setBackgroundColor(mixed $value)`

Setzt den Wert für das Feld `background_color` (PWA Hintergrund-Farbe).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setBackgroundColor($value);
$dataset->save();
```

### `getShortcutIcon(bool $asMedia = false)`

Gibt den Wert für das Feld `shortcut_icon` (Favicon) zurück: `favicon.ico`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getShortcutIcon(true);
```

### `setShortcutIcon(string $filename)`

Setzt den Wert für das Feld `shortcut_icon` (Favicon).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setShortcutIcon($filename);
$dataset->save();
```

### `getAppleTouchIcon(bool $asMedia = false)`

Gibt den Wert für das Feld `apple_touch_icon` (Apple Touch) zurück: 180×180px

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getAppleTouchIcon(true);
```

### `setAppleTouchIcon(string $filename)`

Setzt den Wert für das Feld `apple_touch_icon` (Apple Touch).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setAppleTouchIcon($filename);
$dataset->save();
```

### `getFaviconPng96(bool $asMedia = false)`

Gibt den Wert für das Feld `favicon_png_96` (PNG Favicon 96x96) zurück: `favicon-96x96.png`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getFaviconPng96(true);
```

### `setFaviconPng96(string $filename)`

Setzt den Wert für das Feld `favicon_png_96` (PNG Favicon 96x96).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setFaviconPng96($filename);
$dataset->save();
```

### `getFaviconSvg(bool $asMedia = false)`

Gibt den Wert für das Feld `favicon_svg` (SVG Favicon) zurück: `favicon.svg`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getFaviconSvg(true);
```

### `setFaviconSvg(string $filename)`

Setzt den Wert für das Feld `favicon_svg` (SVG Favicon).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setFaviconSvg($filename);
$dataset->save();
```

### `getManifest(bool $asMedia = false)`

Gibt den Wert für das Feld `manifest` (webmanifest.json) zurück: `site.webmanifest`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getManifest(true);
```

### `setManifest(string $filename)`

Setzt den Wert für das Feld `manifest` (webmanifest.json).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setManifest($filename);
$dataset->save();
```
