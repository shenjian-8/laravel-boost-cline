# Laravel Boost Cline Agent

A Cline agent integration for Laravel Boost that provides MCP (Model Context Protocol) support for CLINE in Laravel projects.

## Installation

You can install the package via Composer:

```bash
composer require laravel-boost/cline:@dev
```

The package will automatically register its service provider through Laravel's package discovery mechanism.

## Configuration

The package will automatically integrate with Laravel Boost. To enable the Cline agent, make sure it's added to your `boost.json` configuration file:

```json
{
    "agents": ["cline"]
}
```

You can publish the configuration file if you need to customize settings:

```bash
php artisan vendor:publish --provider="Laravel\BoostCline\ClineServiceProvider" --tag="config"
```

## Features

- MCP (Model Context Protocol) support for CLINE
- Cross-platform compatibility (Windows, macOS, Linux)
- Automatic detection of CLINE installation
- Project-specific configuration via AGENTS.md
- Skill support for enhanced functionality

## Requirements

- Laravel 12.x
- PHP 8.1+
- Laravel Boost package
- CLINE extension installed in VS Code

## License

This package is open-sourced software licensed under the MIT license.
