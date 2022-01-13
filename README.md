# LYRASOFT Faq Package

![screenshot 2022-01-13 下午04 01 08](https://user-images.githubusercontent.com/34531644/149287418-4de6ef36-85b3-4610-9511-f85c1a25ea96.png)

## Installation

Install from composer

```shell
composer require lyrasoft/faq
```

Then copy files to project

```shell
php windwalker pkg:install lyrasoft/faq -t routes -t lang -t migrations -t seeders
```

Seeders

- Add `faq-seeder.php` to `resources/seeders/main.php`
- Add `faq` type to `category-seeder.php`

Languages

If you don't want to copy language files, remove `-t lang` from install command.

Then add this line to admin & front middleware:

```php
$this->lang->loadAllFromVendor('lyrasoft/faq', 'ini');
```

## Register Admin Menu

Edit `resources/menu/admin/sidemenu.menu.php`

```php
// Category
$menu->link('常見問題分類')
    ->to($nav->to('category_list', ['type' => 'faq']))
    ->icon('fal fa-sitemap');

// Portfolio
$menu->link('常見問題管理')
    ->to($nav->to('faq_list'))
    ->icon('fal fa-question');
```
