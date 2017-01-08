<?php
/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - https://einsatzkomponente.de
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Dienstgrad controller class.
 */
class FirefightersControllerDienstgrad extends JControllerForm
{

    function __construct() {
        $this->view_list = 'dienstgrade';
        parent::__construct();
    }

}