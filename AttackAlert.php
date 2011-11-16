<?php
/**
 * Piwik - Open source web analytics
 * 
 * @category Piwik_Plugins
 * @package  Piwik_AttackAlert
 */

/**
 * AttackAlert
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @package Piwik_AttackAlert
 * @extends Piwik_Plugin
 */
class Piwik_AttackAlert extends Piwik_Plugin
{
    public function getInformation()
    {
        return array(
            'name'                 => 'AttackAlert',
            'description'          => Piwik_Translate('AttackAlert_PluginDescription'),
            'author'               => 'DevDavido',
            'version'              => 0.1,
            'translationAvailable' => true
        );
    }

    function postLoad()
    {
        Piwik_AddWidget('AttackAlert_widgets', 'AttackAlert_widget', 'AttackAlert', 'widget');
    }

}
