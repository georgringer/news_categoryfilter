<?php
defined('TYPO3_MODE') or die();

$boot = function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GeorgRinger.news_categoryfilter',
        'Filter',
        [
            'Filter' => 'list',
        ],
        [
            'Filter' => 'list',
        ]
    );

    $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Domain/Repository/AbstractDemandedRepository.php']['findDemanded']['news_categoryfilter']
        = \GeorgRinger\NewsCategoryfilter\Hooks\Frontend\News\FilterNewsRepositoryHook::class . '->modify';

};

$boot();
unset($boot);
