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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_firefighters/assets/css/firefighters.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function() {
        
	js('input:hidden.abteilungen').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('abteilungenhidden')){
			js('#jform_abteilungen option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_abteilungen").trigger("liszt:updated");
    });

    Joomla.submitbutton = function(task)
    {
        if (task == 'termin.cancel') {
            Joomla.submitform(task, document.getElementById('termin-form'));
        }
        else {
            
            if (task != 'termin.cancel' && document.formvalidator.isValid(document.id('termin-form'))) {
                
	if(js('#jform_abteilungen option:selected').length == 0){
		js("#jform_abteilungen option[value=0]").attr('selected','selected');
	}
                Joomla.submitform(task, document.getElementById('termin-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_firefighters&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="termin-form" class="form-validate">

    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_FIREFIGHTERS_TITLE_TERMIN', true)); ?>
        <div class="row-fluid">
            <div class="span10 form-horizontal">
                <fieldset class="adminform">

                    				<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('bild'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('bild'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('abteilungen'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('abteilungen'); ?></div>
			</div>

			<?php
				foreach((array)$this->item->abteilungen as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="abteilungen" name="jform[abteilungenhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>		

			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('datum_start'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('datum_start'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('datum_ende'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('datum_ende'); ?></div>
			</div>
			
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('beschreibung'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('beschreibung'); ?></div>
			</div>
			
<?php
	$plugin = JPluginHelper::getPlugin('system', 'ftm_event_mail') ;
	if ($plugin) : 
?>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
	</div>
<?php else:?>
	<div class="control-group">
		<div class="control-label"><?php echo '<label id="jform_email-lbl" for="jform_email" class="">
	Erinnerung per Mail aktivieren <br/><span style="color:#ff0000;">(Achtung ! Das Plugin ist nicht aktiviert !!)</span></label>'; ?></div>
		<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
	</div>
<?php endif;?>
			
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('email_gesendet'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('email_gesendet'); ?></div>
			</div>
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
			</div>


                </fieldset>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        
        <?php if (JFactory::getUser()->authorise('core.admin','firefighters')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('JGLOBAL_ACTION_PERMISSIONS_LABEL', true)); ?>
		<?php echo $this->form->getInput('rules'); ?>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
<?php endif; ?>

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>