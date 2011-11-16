<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html Gpl v3 or later
 * @version $Id: $
 * 
 * @category Piwik_Plugins
 * @package Piwik_AttackAlert
 */

/**
 *
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
