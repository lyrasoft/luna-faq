<?php

declare(strict_types=1);

namespace App\View;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $vm        object          The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

use Lyrasoft\Faq\Entity\Faq;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

/**
 * @var $item Faq
 */
?>

@extends('global.body')

@section('content')
    <div class="l-faq-list" itemscope itemtype="https://schema.org/FAQPage">
        <form action="{{ $nav->to('faq_list') }}" method="GET" enctype="multipart/form-data">
            <div class="container">
                <div class="d-flex justify-content-end">
                    <div class="input-group">
                        <input type="text" name="search[*]" value="{{ $search['*'] }}" class="form-control"
                            placeholder="請輸入關鍵字" />
                    </div>
                </div>
                <div class="accordion my-4" id="faq-accordion">
                    @foreach($items as $i => $item)
                        <div class="accordion-item"
                            itemscope itemprop="mainEntity"
                            itemtype="https://schema.org/Question"
                        >
                            <div class="accordion-header" itemprop="name">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-collapse-{{ $i }}">
                                    {{ $item->getTitle() }}
                                </button>
                            </div>

                            <div id="faq-collapse-{{ $i }}" class="accordion-collapse collapse"
                                data-bs-parent="#faq-accordion">
                                <div class="accordion-body"
                                    itemscope itemprop="acceptedAnswer"
                                    itemtype="https://schema.org/Answer">
                                    {!! $item->getDescription() !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {!! $pagination->render() !!}
                </div>
            </div>
        </form>
    </div>
@stop
