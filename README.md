# LYRASOFT Faq Package

![screenshot 2022-01-13 下午04 01 08](https://user-images.githubusercontent.com/34531644/149287418-4de6ef36-85b3-4610-9511-f85c1a25ea96.png)

## Installation

Install from composer

```shell
composer require lyrasoft/faq
```

Then copy files to project

```shell
php windwalker pkg:install lyrasoft/faq -t routes -t migrations -t seeders
```

Seeders

- Add `faq.seeder.php` to `resources/seeders/main.seeder.php`
- Package will auto add categories to seeders
- If you want to modify categories, edit `seeders/categories/faq.categories.php`

### Languages

Add this line to admin & front middleware:

```php
$this->lang->loadAllFromVendor(\Lyrasoft\Faq\FaqPackage::class, 'ini');
```

If you want to copy language files, Run this command:

```shell
php windwalker pkg:install lyrasoft/faq -t lang
```

## Register Admin Menu

Edit `resources/menu/admin/sidemenu.menu.php`

```php
$menu->link('常見問題', '#')
    ->icon('fal fa-question-circle');

$menu->registerChildren(
    function (MenuBuilder $menu) use ($nav, $lang) {
        // Category
        $menu->link('常見問題分類')
            ->to($nav->to('category_list', ['type' => 'faq']));

        // FAQ
        $menu->link('常見問題管理')
            ->to($nav->to('faq_list'));
    }
);
```
