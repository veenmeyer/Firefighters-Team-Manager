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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_firefighters', JPATH_ADMINISTRATOR);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_firefighters/assets/js/form.js');


?>
</style>
<script type="text/javascript">
    function() {
        jQuery(document).ready(function() {
            jQuery('#form-termin').submit(function(event) {
                
            });

            
			jQuery('input:hidden.abteilungen').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('abteilungenhidden')){
					jQuery('#jform_abteilungen option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
	jQuery('#jform_abteilungen').change(function(){
		if(jQuery('#jform_abteilungen option:selected').length == 0){
		jQuery("#jform_abteilungen option[value=0]").attr('selected', 'selected');
		}
	});
					jQuery("#jform_abteilungen").trigger("liszt:updated");
        });
    });

</script>

<div class="termin-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Termin <small>bearbeiten</small> (ID.Nr.<?php echo $this->item->id; ?>)</h1>
    <?php else: ?>
        <h1>Termin <small>eintragen</small></h1>
    <?php endif; ?>

    <form id="form-termin" action="<?php echo JRoute::_('index.php?option=com_firefighters&task=termin.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
        
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
	<?php foreach((array)$this->item->abteilungen as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="abteilungen" name="jform[abteilungenhidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	
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

	<div class="control-group"  style="display:none;">
		<div class="control-label"><?php echo $this->form->getLabel('email_gesendet'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('email_gesendet'); ?></div>
	</div>
	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />

	<div class="control-group" style="display:none;">
		<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
	</div>				
	
	<!--<div class="fltlft" <?php if (!JFactory::getUser()->authorise('core.admin','firefighters')): ?> style="display:none;" <?php endif; ?> >
                <?php echo JHtml::_('sliders.start', 'permissions-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
                <?php echo JHtml::_('sliders.panel', JText::_('ACL Configuration'), 'access-rules'); ?>
                <fieldset class="panelform">
                    <?php echo $this->form->getLabel('rules'); ?>
                    <?php echo $this->form->getInput('rules'); ?>
                </fieldset>
                <?php echo JHtml::_('sliders.end'); ?>
            </div> -->
				<?php if (!JFactory::getUser()->authorise('core.admin','firefighters')): ?>
                <script type="text/javascript">
                    jQuery.noConflict();
                    jQuery('.tab-pane select').each(function(){
                       var option_selected = jQuery(this).find(':selected');
                       var input = document.createElement("input");
                       input.setAttribute("type", "hidden");
                       input.setAttribute("name", jQuery(this).attr('name'));
                       input.setAttribute("value", option_selected.val());
                       document.getElementById("form-termin").appendChild(input);
                    });
                </script>
             <?php endif; ?>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=terminform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        
        <input type="hidden" name="option" value="com_firefighters" />
        <input type="hidden" name="task" value="terminform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
