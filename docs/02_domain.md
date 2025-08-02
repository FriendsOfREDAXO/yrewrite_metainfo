# Die Klasse `Domain`

Kind-Klasse von `rex_yform_manager_dataset`, damit stehen alle Methoden von YOrm-Datasets zur Verfügung. Greift auf die Tabelle `rex_yrewrite_metainfo` zu.

> Es werden nachfolgend zur die durch dieses Addon ergänzte Methoden beschrieben. Lerne mehr über YOrm und den Methoden für Querys, Datasets und Collections in der [YOrm Doku](https://github.com/yakamara/yform/blob/master/docs/04_yorm.md)

## Infos zur aktuellen Domain erhalten

```php
use FriendsOfREDAXO\YRewriteMetainfo\Domain;

$domain = Domain::getCurrent(); // Aktuelle Domain
$domain->getName(); // Website-Titel
$domain->getLogo(); // Logo
$domain->getValue('mein_feld') // Eigene Felder auslesen
```

## Methoden und Beispiele

### `getYrewriteDomainId()`

Gibt den Wert für das Feld `yrewrite_domain_id` (Domain) zurück:

Beispiel:

```php
$dataset = Domain::get($id);
echo $dataset->getYrewriteDomainId();
```

### `setYrewriteDomainId(mixed $value)`

Setzt den Wert für das Feld `yrewrite_domain_id` (Domain).

```php
$dataset = Domain::create();
$dataset->setYrewriteDomainId($value);
$dataset->save();
```

### `getName()`

Gibt den Wert für das Feld `name` (Website-Titel) zurück:

Beispiel:

```php
$dataset = Domain::get($id);
echo $dataset->getName();
```

### `setName(mixed $value)`

Setzt den Wert für das Feld `name` (Website-Titel).

```php
$dataset = Domain::create();
$dataset->setName($value);
$dataset->save();
```

### `getLogo(bool $asMedia = false)`

Gibt den Wert für das Feld `logo` (Logo) zurück: Logo, das im Template ausgegeben werden kann.

Beispiel:

```php
$dataset = Domain::get($id);
$media = $dataset->getLogo(true);
```

### `setLogo(string $filename)`

Setzt den Wert für das Feld `logo` (Logo).

```php
$dataset = Domain::create();
$dataset->setLogo($filename);
$dataset->save();
```

### `getType()`

Gibt den Wert für das Feld `type` (og:type) zurück: OpenGraph-Type (Standard: `website`)

Beispiel:

```php
$dataset = Domain::get($id);
echo $dataset->getType();
```

### `setType(mixed $value)`

Setzt den Wert für das Feld `type` (og:type).

```php
$dataset = Domain::create();
$dataset->setType($value);
$dataset->save();
```

### `getThumbnail(bool $asMedia = false)`

Gibt den Wert für das Feld `thumbnail` (og:image) zurück: OpenGraph-Bild (Linkvorschau, wird zu einer späteren Version dynamisch pro Artikelseite)

Beispiel:

```php
$dataset = Domain::get($id);
$media = $dataset->getThumbnail(true);
```

### `setThumbnail(string $filename)`

Setzt den Wert für das Feld `thumbnail` (og:image).

```php
$dataset = Domain::create();
$dataset->setThumbnail($filename);
$dataset->save();
```

### `getIcon()`

Gibt den Wert für das Feld `icon` (Profil (Icons, PWA)) zurück: In diesem Profil können Favicon- und Browser-Icons, Farbschema u.v.a. Eigenschaften für Progessive Web Apps ggf. für mehrere Domains angegeben werden.

Beispiel:

```php
$dataset = Domain::get($id);
$beziehung = $dataset->getIcon();
```

### `setIcon(mixed $value)`

Setzt den Wert für das Feld `icon` (Profil (Icons, PWA)).

```php
$dataset = Domain::create();
$dataset->setIcon($value);
$dataset->save();
```
