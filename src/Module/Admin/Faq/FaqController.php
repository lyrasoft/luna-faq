<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    MIT
 */

declare(strict_types=1);

namespace Lyrasoft\Faq\Module\Admin\Faq;

use Lyrasoft\Faq\Module\Admin\Faq\Form\EditForm;
use Lyrasoft\Faq\Repository\FaqRepository;
use Unicorn\Controller\CrudController;
use Unicorn\Controller\GridController;
use Unicorn\Upload\FileUploadService;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Router\Navigator;
use Windwalker\DI\Attributes\Autowire;
use Windwalker\ORM\Event\AfterSaveEvent;

/**
 * The FaqController class.
 */
#[Controller()]
class FaqController
{
    public function save(
        AppContext $app,
        CrudController $controller,
        Navigator $nav,
        FileUploadService $fileUploadService,
        #[Autowire] FaqRepository $repository,
    ): mixed {
        $controller->afterSave(function (AfterSaveEvent $event) use ($app, $repository, $fileUploadService) {
            $data = &$event->getData();

            $data['image'] = $fileUploadService->handleFileIfUploaded(
                    $app->file('item')['image'] ?? null,
                    'images/faq/image/' . md5((string) $data['id']) . '.jpg'
                )?->getUri() ?? $data['image'];

            $repository->save($data);
        });

        $form = $app->make(EditForm::class);

        $uri = $app->call([$controller, 'save'], compact('repository', 'form'));

        switch ($app->input('task')) {
            case 'save2close':
                return $nav->to(FaqListView::class);

            case 'save2new':
                return $nav->to(FaqEditView::class)->var('new', 1);

            case 'save2copy':
                $controller->rememberForClone($app, $repository);

                return $nav->self($nav::WITHOUT_VARS)->var('new', 1);

            default:
                return $uri;
        }
    }

    public function delete(
        AppContext $app,
        #[Autowire] FaqRepository $repository,
        CrudController $controller
    ): mixed {
        return $app->call([$controller, 'delete'], compact('repository'));
    }

    public function filter(
        AppContext $app,
        #[Autowire] FaqRepository $repository,
        GridController $controller
    ): mixed {
        return $app->call([$controller, 'filter'], compact('repository'));
    }

    public function batch(
        AppContext $app,
        #[Autowire] FaqRepository $repository,
        GridController $controller
    ): mixed {
        $task = $app->input('task');
        $data = match ($task) {
            'publish' => ['state' => 1],
            'unpublish' => ['state' => 0],
            default => null
        };

        return $app->call([$controller, 'batch'], compact('repository', 'data'));
    }

    public function copy(
        AppContext $app,
        #[Autowire] FaqRepository $repository,
        GridController $controller
    ): mixed {
        return $app->call([$controller, 'copy'], compact('repository'));
    }
}
