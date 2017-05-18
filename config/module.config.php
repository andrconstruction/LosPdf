<?php

    namespace LosPdf;
    return [
        'view_manager'    => [
            'strategies' => [
                ViewPdfStrategy::class,
            ],
        ],
        'service_manager' => [
            'factories' => [
                'ViewPdfRenderer' => Model\ViewPdfRenderer::class,
                ViewPdfStrategy::class => Model\ViewPdfStrategy::class,
            ],
        ],
    ];
