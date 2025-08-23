firstfold
===

firstfold Wordpress Theme that uses Atomic Design Pattern and ACF Blocks.

* A modern workflow with a pre-made command-line interface to turn your project into a more pleasant experience.
* A just right amount of lean, well-commented, modern, HTML5 templates.

### Requirements

this theme requires the following dependencies:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)
- [ACF Pro Plugin](https://www.advancedcustomfields.com/)

### Setup

```sh
$ composer install
$ yarn install
```

### Available CLI commands

this theme comes packed with CLI commands tailored for WordPress theme development :

- `composer lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- `composer lint:php` : checks all PHP files for syntax errors.
- `composer make-pot` : generates a .pot file in the `languages/` directory.
- `yarn run gulp` : watches all SASS and JS files and recompiles them to css/js when they change.
- `yarn run compile:css` : compiles SASS files to css.
- `yarn run compile:rtl` : generates an RTL stylesheet.
- `yarn run watch` : watches all SASS files and recompiles them to css when they change.
- `yarn run lint` : runs all lint commands.
- `yarn run lint:scss` : checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
- `yarn run lint:js` : checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
- `yarn run bundle` : generates a .zip archive for distribution, excluding development and system files.
