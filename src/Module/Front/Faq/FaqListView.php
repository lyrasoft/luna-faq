<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Lyrasoft\Faq\Module\Front\Faq;

use Lyrasoft\Faq\Repository\FaqRepository;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\DI\Attributes\Autowire;

/**
 * The FaqListView class.
 */
#[ViewModel(
    layout: 'faq-list',
    js: 'faq-list.js'
)]
class FaqListView implements ViewModelInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        #[Autowire] protected FaqRepository $repository
    )
    {
        //
    }

    /**
     * Prepare View.
     *
     * @param  AppContext  $app   The web app context.
     * @param  View        $view  The view object.
     *
     * @return  mixed
     */
    public function prepare(AppContext $app, View $view): array
    {
        $state = $this->repository->getState();

        $page     = $state->rememberFromRequest('page');
        $search   = (array) $state->rememberFromRequest('search');

        $items = $this->repository->getListSelector()
            ->searchTextFor(
                $search['*'] ?? '',
                [
                    'faq.title',
                    'faq.description'
                ]
            )
            ->order('created', 'DESC')
            ->page($page);

        $pagination = $items->getPagination();

        return compact(
            'items',
            'search',
            'pagination'
        );
    }
}
