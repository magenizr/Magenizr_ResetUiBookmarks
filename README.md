# Magenizr ResetUiBookmarks
This Magento 2 module allows you to reset your UI bookmarks such as state of filters, column positions, grid sorting ( e.g `Sales > Orders` ), pagination and so on.

It basically clears all records in table `ui_bookmark` from the current admin user.

![Magenizr ResetUiBookmarks - Intro](http://download.magenizr.com/pub/magenizr_resetuibookmarks/all/intro.gif)

![Magenizr ResetUiBookmarks - Backend](http://download.magenizr.com/pub/magenizr_resetuibookmarks/all/backend/01.gif)

## System Requirements
- Magento 2.1.x, 2.2.x
- PHP 5.6.x, 7.x

## Installation (Composer)

1. Add this extension to your repository `composer config repositories.magenizr/magento2-resetuibookmarks git https://github.com/magenizr/Magenizr_ResetUiBookmarks.git`
2. Update your composer.json `composer require "magenizr/magento2-resetuibookmarks":"1.0.0"`

```
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)              
Package operations: 1 install, 0 updates, 0 removals
  - Installing magenizr/magento2-resetuibookmarks (1.0.0): Downloading (100%)         
Writing lock file
Generating autoload files
```

3. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_ResetUiBookmarks --clear-static-content
php bin/magento setup:upgrade
```

## Installation (Manually)
1. Download the code.
2. Extract the downloaded tar.gz file. Example: `tar -xzf Magenizr_ResetUiBookmarks_1.0.0.tar.gz`.
3. Copy the code into `./app/code/Magenizr/ResetUiBookmarks/`.
4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_ResetUiBookmarks --clear-static-content
php bin/magento setup:upgrade
```

## Features
* A red button `Reset UI Bookmarks` is available on the `Account Settings` page for each admin user.

## Usage
Simply hit the red button `Reset UI Bookmarks` to clear your bookmarks and wait for the confirmation `Your UI bookmarks were cleared successfully.`.

## Support
If you have any issues with this extension, open an issue on [GitHub](https://github.com/magenizr/Magenizr_ResetUiBookmarks/issues).

## Contact
Follow us on [GitHub](https://github.com/magenizr), [Twitter](https://twitter.com/magenizr) and [Facebook](https://www.facebook.com/magenizr).

## History
===== 1.0.0 =====
* Stable version

## License
[OSL - Open Software Licence 3.0](https://opensource.org/licenses/osl-3.0.php)