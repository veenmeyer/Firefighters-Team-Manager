<?php
/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - https://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_firefighters', JPATH_ADMINISTRATOR);

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_firefighters');
$canCheckin = $user->authorise('core.manage', 'com_firefighters');
$canChange = $user->authorise('core.edit.state', 'com_firefighters');
$canDelete = $user->authorise('core.delete', 'com_firefighters');

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_firefighters');

?>

<!--Page Heading-->
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<div class="page-header eiko_header_main">
<h1 class="eiko_header_main_h1"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1> 
</div>
<br/>
<?php endif;?>

<?php
require_once JPATH_SITE.'/components/com_firefighters/views/termine/tmpl/'.$this->params->get('main_layout','main_layout_1.php').''; 

?>
