<?php
defined('TYPO3_MODE') or die();

/***************
 * Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'news_categoryfilter',
    'Filter',
    'LLL:EXT:news_categoryfilter/Resources/Private/Language/locallang_be.xlf:plugin-title'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['newscategoryfilter_filter'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['newscategoryfilter_filter'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('newscategoryfilter_filter',
    'FILE:EXT:news_categoryfilter/Configuration/FlexForms/flexform_news_categoryfilter.xml');

