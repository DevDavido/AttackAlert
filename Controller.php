<?php
/**
 * Piwik - Open source web analytics
 * 
 * @category Piwik_Plugins
 * @package  Piwik_AttackAlert
 */

require_once PIWIK_INCLUDE_PATH . '/plugins/UserSettings/functions.php';

/**
 * AttackAlert
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * 
 * @package Piwik_AttackAlert
 * @extends Piwik_Controller
 */
class Piwik_AttackAlert_Controller extends Piwik_Controller
{    
    /**
     * Plugin constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->idSite = Piwik_Common::getRequestVar('idSite');
    }
    
    /**
     * Show widget
     *
     * @return void
     */
    public function index()
    {
        $this->widget(true);
    }
    
    /**
     * Widget
     *
     * @param  bool $fetch Echo or return widget
     * @return void|string
     */
    public function widget($fetch = false)
    {
        $view = Piwik_View::factory('index');
        $this->setGeneralVariablesView($view);
        $view->visits = $this->getLastActions($this->idSite, 30);
        if ($fetch) {
            return $view->render();
        }
        echo $view->render();
    }
    
    /**
     * Get last actions
     *
     * @param  null|int  $idSite The site ID
     * @param  int       $limit  The limit how many actions should be shown
     * @return array
     */
    public function getLastActions($idSite = null, $limit = null)
    {
        if (is_null($idSite)) {
            Piwik::checkUserIsSuperUser();
        } else {
            Piwik::checkUserHasViewAccess($idSite);
        }
        $actions = $this->loadLastActionsFromDatabase($idSite, $limit);
        print_r($actions);
        /*foreach ($actions as $key => $row) {

            $row['config_os_logo'] = Piwik_getOSLogo($row['config_os']);
            $row['config_os'] = Piwik_getOSLabel($row['config_os']);

            $browser = $row['config_browser_name'] . ";" . $row['config_browser_version'];
            $row['config_browser_logo'] = Piwik_getBrowsersLogo($browser);
            $row['config_browser_name'] = Piwik_getBrowserLabel($browser);

            $actions[$key] = $row;
        }
        return $actions;*/
    }
    
    /**
     * Get last actions from database
     *
     * @param  null|int  $idSite The site ID
     * @param  int       $limit  The limit how many actions should be shown
     * @return array
     */
    private function loadLastActionsFromDatabase($idSite = null, $limit = null)
    {
        $where = $whereBind = array();
        
        if (!is_null($idSite)) {
            $where[] = 'idsite = ? ';
            $whereBind[] = $idSite;
        }
        
        $sqlWhere = '';
        if (count($where) > 0) {
            $sqlWhere = ' WHERE ' . join(' AND ', $where);
        }
        $sql = 'SELECT * FROM `' . Piwik::prefixTable('???table_name???') . '`' . $sqlWhere . ' ORDER BY `id` DESC LIMIT ' . $limit;
        
        
        return Piwik_FetchAll($sql, $whereBind);
    }

}
