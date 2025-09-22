# YRewrite Metainfo REDAXO Addon

YRewrite Metainfo is a REDAXO addon that extends YRewrite domains with meta information management capabilities. It provides ready-to-use configuration fields, YOrm dataset methods, and backend pages for managing domain-specific metadata including SEO, Open Graph, PWA icons, and more.

Always reference these instructions first and fallback to search or bash commands only when you encounter unexpected information that does not match the info here.

## Working Effectively

- Bootstrap and validate the repository:
  - `composer install --no-interaction --prefer-dist --no-progress` -- installs PHP CS Fixer and dependencies. Takes 5-30 seconds (up to 5 minutes with GitHub rate limiting). NEVER CANCEL. Set timeout to 10+ minutes.
  - `composer cs-dry` -- runs PHP CS Fixer in dry-run mode to check code style. Takes 1 second.
  - `composer cs-fix` -- runs PHP CS Fixer to fix code style issues. Takes 1 second. NEVER CANCEL. Set timeout to 2+ minutes.
  - `find . -name "*.php" -not -path "./vendor/*" | xargs php -l` -- validates PHP syntax of all files. Takes less than 1 second.

## Validation

- Always run `composer cs-dry` before making changes to see the current code style status.
- Always run `composer cs-fix` after making PHP code changes or the CI (.github/workflows/code-style.yml) will fail.
- Always validate PHP syntax with `php -l` on changed files before committing.
- ALWAYS run through complete workflow validation after making changes:
  1. Check syntax: `find . -name "*.php" -not -path "./vendor/*" | xargs php -l`
  2. Run code style check: `composer cs-fix`
  3. Verify no unexpected changes occurred

## Development Context

### Repository Structure
- `lib/` - Core PHP classes (Domain.php, Icon.php, rex_var_*.php)
- `pages/` - REDAXO backend page definitions for admin interface
- `fragments/` - Template fragments (especially `fragments/yrewrite_metainfo/head.php` for HTML head output)
- `docs/` - Markdown documentation files loaded in backend
- `lang/` - Translation files (German and English)
- `install/` - YForm table definitions (JSON tablesets)
- `boot.php` - Addon bootstrap and extension registration
- `package.yml` - REDAXO addon configuration and dependencies

### Core Classes
- `FriendsOfRedaxo\YrewriteMetainfo\Domain` - Main domain metadata management (extends rex_yform_manager_dataset)
- `FriendsOfRedaxo\YrewriteMetainfo\Icon` - PWA/favicon management (extends rex_yform_manager_dataset)

### Key Dependencies
- REDAXO ^5.19 with PHP ^8.2
- YRewrite ^2 (URL rewriting and domain management)  
- YForm >=4,<6 (form management and ORM)
- YForm Field >=2.11.0,<4 (additional form fields)

## Common Tasks

The following are outputs from frequently run commands. Reference them instead of running bash commands to save time.

### Repository root structure
```
.github/          # GitHub workflows and funding
.gitignore        # Git ignore rules
.php-cs-fixer.dist.php  # PHP CS Fixer configuration
LICENSE           # MIT license
README.md         # German documentation
boot.php          # Addon bootstrap
composer.json     # Composer dependencies (PHP CS Fixer)
docs/             # Documentation markdown files
fragments/        # Template fragments
install/          # YForm table definitions
install.php       # Addon installation script
lang/             # Translation files
lib/              # Core PHP classes
package.yml       # REDAXO addon configuration
pages/            # Backend page definitions
uninstall.php     # Addon uninstallation script
update.php        # Addon update script
```

### Composer configuration
```json
{
  "require-dev": {
    "redaxo/php-cs-fixer-config": "^2.0",
    "friendsofphp/php-cs-fixer": "^3.14"
  },
  "scripts": {
    "cs-dry": "php-cs-fixer fix -v --ansi --dry-run --config=.php-cs-fixer.dist.php",
    "cs-fix": "php-cs-fixer fix -v --ansi --config=.php-cs-fixer.dist.php"
  }
}
```

### REDAXO package configuration (package.yml)
- Package name: yrewrite_metainfo
- Version: 3.0.0-dev-2025-08-02
- Requires REDAXO ^5.19, PHP ^8.2, YRewrite ^2, YForm >=4,<6
- Provides backend pages under yrewrite/metainfo

## Specific Development Guidelines

### When Working with Domain Metadata:
- Always check `lib/domain.php` for available methods and properties
- The Domain class extends rex_yform_manager_dataset, providing full YOrm functionality
- Use `Domain::getCurrent()` to get the current domain's metadata
- After changing domain-related code, test the `fragments/yrewrite_metainfo/head.php` output

### When Working with Icon/PWA Features:
- Check `lib/icon.php` for PWA manifest and favicon methods  
- Icon profiles are managed separately from domain data
- Test favicon and manifest generation after making icon-related changes

### When Modifying Backend Pages:
- Backend pages are defined in `pages/` directory
- Documentation pages automatically load markdown files from `docs/`
- Always ensure backend pages follow REDAXO admin interface conventions

### When Adding New Features:
- Follow the existing namespace pattern: `FriendsOfRedaxo\YrewriteMetainfo`
- Use YForm tablesets for database changes (see `install/` directory)
- Add appropriate language keys in `lang/` files (German and English)
- Update documentation in `docs/` if user-facing

### Code Style Requirements:
- This addon uses REDAXO PHP CS Fixer configuration
- All PHP files must pass `composer cs-fix` without changes
- Follow PSR-12 coding standards as enforced by the fixer
- Use strict typing (`declare(strict_types=1);`) in new files

## Installation Dependencies

### Required for Development:
- PHP ^8.2 with CLI access
- Composer for dependency management
- No additional build tools required

### For Full REDAXO Integration Testing:
- Complete REDAXO 5.19+ installation
- YRewrite addon ^2 with configured domain
- YForm addon >=4,<6
- MySQL/MariaDB database

Note: This addon cannot be fully functionally tested outside of a REDAXO environment, but code validation and syntax checking work independently.