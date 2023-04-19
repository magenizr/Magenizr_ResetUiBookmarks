# Reset Ui Bookmarks
Reset UI Bookmarks becomes an invaluable tool while working daily in the admin panel, especially on Magento® instances with a large catalogue. The regular use of grid filters, applied sorting ( e.g `Sales > Orders or Catalog > Product` ) or other options provided by third party integrations can cause server time-outs ( depending on the filter combinations ) and make the grid tables unusable. With Reset UI Bookmarks any admin user can reset their filters back to default without having an agency support team involved.

![Magenizr ResetUiBookmarks - Backend](https://images2.imgbox.com/a3/7b/Nzdq7r9y_o.png)
![Magenizr ResetUiBookmarks - Backend](https://images2.imgbox.com/74/23/EprsvLRC_o.png)

## Business Value
Usually a technical person ( e.g developer ) is required to reset those filters back to default. This can be annoying for a client and create unnecessarily noise for a developer team. Here are the advantages of Reset UI Bookmarks.

* A client can reset filters and column positions back to default. A developer is not required.
* A client support team, which usually has no access to the MySQL database can fix broken grid tables without having a developer involved.
* Practical for small businesses, which can not afford expensive agency support.

## System Requirements
- Magento 2.3.x, 2.4.x
- PHP 5.6.x, 7.x

## Installation (Composer)

1. Update your composer.json `composer require "magenizr/magento2-resetuibookmarks":"1.2.2" --no-update`
2. Install dependencies and update your composer.lock `composer update magenizr/magento2-resetuibookmarks --lock`

```
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)              
Package operations: 1 install, 0 updates, 0 removals
  - Installing magenizr/magento2-resetuibookmarks (1.2.2): Downloading (100%)
Writing lock file
Generating autoload files
```

3. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_ResetUiBookmarks
```

## Installation (Composer 2)

1. Update your composer.json `composer require "magenizr/magento2-resetuibookmarks":"1.2.2" --no-update`
2. Use `composer update magenizr/magento2-resetuibookmarks --no-install` to update your composer.lock file.

```
Updating dependencies
Lock file operations: 1 install, 1 update, 0 removals
  - Locking magenizr/magento2-resetuibookmarks (1.2.2)
```

3. And then `composer install` to install the package.

```
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Package operations: 1 install, 0 update, 0 removals
  - Installing magenizr/magento2-resetuibookmarks (1.2.2): Extracting archive
```

4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_ResetUiBookmarks
```

## Installation (Manually)
1. Download the code.
2. Extract the downloaded tar.gz file. Example: `tar -xzf Magenizr_ResetUiBookmarks_1.2.2.tar.gz`.
3. Copy the code into `./app/code/Magenizr/ResetUiBookmarks/`.
4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_ResetUiBookmarks --clear-static-content
php bin/magento setup:upgrade
```

## Features
* A red button `Reset UI Bookmarks` within your `Account Settings` page as well as on `System > Permissions > All Users > {User} > User Info`.
* Once a admin user hits the button `Reset UI Bookmarks`, it will clear the history of state of filters, column positions or applied sorting which are stored in the MySQL table `ui_bookmark`.
* Choose between the options `All Bookmarks`, `Saved Filters Only` and `Keep Saved Filters`

## Usage
Simply hit the button `Reset UI Bookmarks` to clear the bookmarks and wait for the confirmation `Your UI bookmarks were cleared successfully`. After that all filters and grid settings are set back to default. More details are available in the attached user guide.

## Support
If you experience any issues, don't hesitate to open an issue on [Github](https://github.com/magenizr/Magenizr_Debugger/issues). For a custom build, don't hesitate to contact us on [Magento Marketplace](https://marketplace.magento.com/partner/magenizr).

## Purchase
This module is available for free on [GitHub](https://github.com/magenizr). If you purchase the module on [Magenizr Shop](https://shop.magenizr.com) or [Magento Marketplace](https://marketplace.magento.com/partner/magenizr) we offer 60 days free support, 90 days warranty and 12 month free updates.

## Contact
Follow us on [GitHub](https://github.com/magenizr), [Twitter](https://twitter.com/magenizr) and [Facebook](https://www.facebook.com/magenizr).

## History
===== 1.2.2 =====
* 2.4.6 compatibility check
* Code cleanup
* Improved $form and $userId check

===== 1.2.1 =====
* Validation issue ( `Cannot read properties of undefined (reading 'settings')` ) on `Save User` action fixed.

===== 1.2.0 =====
* ResetUiBookmarks Button added to `System > Permissions > All Users > {User} > User Info` so that bookmarks can be cleared for non-administrator users.

===== 1.1.2 =====
* `setup_version=""` removed from module.xml

===== 1.1.1 =====
* 2.4.x compatibility added
* Cleanup various files to follow coding standard (EQP, ECG)
* Remove framework requirement in composer.json

===== 1.1.0 =====
* Choose between the options `All Bookmarks`, `Saved Filters Only` and `Keep Saved Filters`

===== 1.0.3 =====
* Cleanup in `resetuibookmarks.phtml`

===== 1.0.2 =====
* Magento 2.4.x compatibility added

===== 1.0.1 =====
* Magento 2.3.1 compatibility added

===== 1.0.0 =====
* Stable version

## License
[OSL - Open Software Licence 3.0](https://opensource.org/licenses/osl-3.0.php)
