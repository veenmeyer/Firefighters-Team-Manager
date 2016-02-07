<?php
/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - http://einsatzkomponente.de
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Abteilung controller class.
 */
class FirefightersControllerAbteilung extends JControllerForm
{

    function __construct() {
        $this->view_list = 'abteilungen';
        parent::__construct();
    }

}