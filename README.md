# Magenizr ResetUiBookmarks
Reset UI Bookmarks becomes an invaluable tool while working daily in the admin panel, especially on Magento® instances with a large catalogue. The regular use of grid filters, applied sorting ( e.g `Sales > Orders or Catalog > Product` ) or other options provided by third party integrations can cause server time-outs ( depending on the filter combinations ) and make the grid tables unusable. With Reset UI Bookmarks any admin user can reset their filters back to default without having an agency support team involved.

![Magenizr ResetUiBookmarks - Intro](http://download.magenizr.com/pub/magenizr_resetuibookmarks/all/intro.gif)

![Magenizr ResetUiBookmarks - Backend](http://download.magenizr.com/pub/magenizr_resetuibookmarks/all/backend/01.gif)

## Business Value
Usually a technical person ( e.g developer ) is required to reset those filters back to default. This can be annoying for a client and create unnecessarily noise for a developer team. Here are the advantages of Reset UI Bookmarks.

* A client can reset filters and column positions back to default. A developer is not required.
* A client support team, which usually has no access to the MySQL database can fix broken grid tables without having a developer involved.
* Practical for small businesses, which can not afford expensive agency support.

## Features
* A red button `Reset UI Bookmarks` is available on the `Account Settings` page for each admin user.
* Once a admin user hits the button `Reset UI Bookmarks`, it will clear the history of state of filters, column positions or applied sorting which are stored in the MySQL table `ui_bookmark`.
* It doesn't delete any other data related to the grid.

## Usage
Simply hit the button `Reset UI Bookmarks` to clear the bookmarks and wait for the confirmation `Your UI bookmarks were cleared successfully`. After that all filters and grid settings are set back to default. More details are available in the attached user guide.

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

## Support
If you have any issues with this extension, open an issue on [GitHub](https://github.com/magenizr/Magenizr_ResetUiBookmarks/issues).

## Purchase
This module is available for free on [GitHub](https://github.com/magenizr). If you purchase the module on [Magento Marketplace](https://marketplace.magento.com/partner/magenizr) we offer three month warranty / free support.

## Contact
Follow us on [GitHub](https://github.com/magenizr), [Twitter](https://twitter.com/magenizr) and [Facebook](https://www.facebook.com/magenizr).

## History
===== 1.0.0 =====
* Stable version

## License
[OSL - Open Software Licence 3.0](https://opensource.org/licenses/osl-3.0.php)
