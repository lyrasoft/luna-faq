<?php

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

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

@extends('global.body')

@section('content')
    <div class="l-faq-list">
        <form action="{{ $nav->to('faq_list') }}" method="GET" enctype="multipart/form-data">
            <div class="container">
                <div class="d-flex justify-content-end">
                    <div class="input-group">
                        <input type="text" name="search[*]" value="{{ $search['*'] }}" class="form-control" placeholder="請輸入關鍵字" />
                    </div>
                </div>
                <div class="accordion my-4" id="faq-accordion">
                    @foreach($items as $i => $item)
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $i }}">
                                    {{ $item->title }}
                                </button>
                            </div>

                            <div id="faq-collapse-{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                <div class="accordion-body">
                                    {!! $item->description !!}
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
