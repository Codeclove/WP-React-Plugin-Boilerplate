# WP REACT PLUGIN BOILERPLATE
This repository is based on [DevinVinson Boilerplate](https://github.com/DevinVinson/WordPress-Plugin-Boilerplate)

## Features
- OOP design
- WP REST API
- Webpack with React support
- Material UI

## Installation
Rename files from plugin-name to example-me
- change `test_plugin` to `example_me`
- change `test-plugin to example-me`
- change `Test_Plugin to Example_Me`
- change `TEST_PLUGIN_ to EXAMPLE_ME_`

## Settings
Edit backend and react files according to your needs. 
change url in config.js

## Internationalization
1. [Generate](https://developer.wordpress.org/cli/commands/i18n/make-pot/) `.pot` file: `wp i18n make-pot PATH-TO-DIRECTORY PATH-TO-POT-FILE --exclude=assets`
2. Translate file in Poedit or other editor and save as `test-plugin-sk_SK`.
3. Generated .mo / .po file and it in the language folder. 

