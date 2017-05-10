<?php
return [
    'view_manager' => [
        'strategies' => [
            'ViewPdfStrategy',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'ViewPdfRenderer' => LosPdf\Model\ViewPdfRenderer::class,
            'ViewPdfStrategy' => LosPdf\Model\ViewPdfStrategy::class,
        ],
    ],
];
