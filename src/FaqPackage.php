<?php

/**
 * Part of toolstool project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    MIT
 */

declare(strict_types=1);

namespace Lyrasoft\Faq;

use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Core\Package\PackageInstaller;

/**
 * The FaqPackage class.
 */
class FaqPackage extends AbstractPackage
{
    public function install(PackageInstaller $installer): void
    {
        $installer->installLanguages(static::path('resources/languages/**/*.ini'), 'lang');
        $installer->installMigrations(static::path('resources/migrations/**/*'), 'migrations');
        $installer->installSeeders(static::path('resources/seeders/**/*'), 'seeders');
        $installer->installRoutes(static::path('routes/**/*.php'), 'routes');

        // Modules
        $installer->installModules(
            [
                static::path("src/Module/Admin/Faq/**/*") => "@source/Module/Admin/Faq",
            ],
            ['Lyrasoft\\Luna\\Module\\Admin' => 'App\\Module\\Admin'],
            ['modules', 'faq_admin'],
        );

        $installer->installModules(
            [
                static::path("src/Module/Front/Faq/**/*") => "@source/Module/Front/Faq",
            ],
            ['Lyrasoft\\Luna\\Module\\Front' => 'App\\Module\\Front'],
            ['modules', 'faq_front'],
        );

        $installer->installModules(
            [
                static::path("src/Entity/Faq.php") => '@source/Entity',
                static::path("src/Repository/FaqRepository.php") => '@source/Repository',
            ],
            [
                'Lyrasoft\\Luna\\Entity' => 'App\\Entity',
                'Lyrasoft\\Luna\\Repository' => 'App\\Repository',
            ],
            ['modules', 'faq_model']
        );
    }
}
