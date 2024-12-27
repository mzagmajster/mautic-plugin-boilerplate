# Mautic Plugin Boilerplate

Empty Mautic plugin bundle (zero functionality). Tested on **Mautic 4**. Go ahead use this boilerplate and provide more custom functionality to Mautic - Open source Marketing Automation Tool.

## Getting Started

### Prerequisites

* Composer 2
* Mautic 4

### Installing

**Initial install** described below.

```
cd <mautic-root-folder>
rm -rf var/cache/dev/* var/cache/prod/*
cd plugins
git clone <repo-url> HelloWorldBundle
cd <mautic-root-folder>
composer install  # You only need this druing development.
php bin/console mautic:plugins:install --env=dev  # You should get a message saying one or more plugins have been installed in terminal.
```

Typical **update** of plugin source code described below.

* Make sure plugin root folder is clean from git´s point of view.

```
cd <mautic-root-folder>
rm -rf var/cache/dev/* var/cache/prod/*
cd plugins/HelloWorldBundle
git pull origin <branch>
php bin/console mautic:plugins:reload --env=dev  # You should get a message saying one or more plugins have been installed in terminal.
```

### Creating new plugin from this template

From Mautic core composer.json remove usage of command (as it deletes the git directories and its useful not what you want):

```
@remove-git-submodules
```

```
git clone <repo-url> <plugin-name>
./bin/manage.sh plugin:init:env  Defines plugin namespace
./bin/manage.sh dev:hooks  # Installs git hooks
./bin/manage.sh plugin:change:namespace  # Will work only once.
```

## Running the tests

[No tests yet.]

### Coding style

Please refer to Mautic core repository for coding styles in this plugin.

## Deployment

* You do not have to install any composer packages inside plugin folder since we only use it during development.
* When you are deploying the plugin make sure you call ```php bin/console``` command without --dev switch.

## Changelog

[No changelog yet.]

## Documentation

[No documentation yet.]

## Built With

* [Mautic](https://github.com/mautic/) - Open Source Marketing Automation Tool
* [Composer](https://getcomposer.org/) - Dependency Management

## Contributing

- If you have a suggestion for the feature or improvement consider opening an issue on GitHub (just make sure the same issue does not already exists).
- If you want, you can open a pull request and I will make an effort to merge it.
- Finally if this project was helpful to you consider supporting it with a donation via [PayPal](https://paypal.me/maticzagmajster). **Thank you!**

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the tags on this repository. 

## Authors

Content in this project was provided by [Matic Zagmajster](http://maticzagmajster.ddns.net/). For more information please see ```AUTHORS``` file.

## Acknowledgments

* Thanks to entire Mautic Community for providing awesome marketing automation tool.



