<?php
/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - http://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_firefighters', JPATH_ADMINISTRATOR);

?>
<input type="button" class="btn ftm_back_button" value="Zurück" onClick="history.back();"></br>

<?php
require_once JPATH_SITE.'/components/com_firefighters/views/mitglied/tmpl/'.$this->params->get('detail_layout','detail_layout_1.php').''; 
?>
