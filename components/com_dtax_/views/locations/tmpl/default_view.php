<?php
/**
 * @version     1.0.0
 * @package     com_dtax
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_dtax/assets/css/dtax.css');

?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'company.cancel') {
                    Joomla.submitform(task, document.getElementById('company-form'));
                }
                else{
                    
                    if (task != 'company.cancel' && document.formvalidator.isValid(document.id('company-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('company-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }
</script>

<?php echo JST::header(); ?>
<?php echo JST::toolbar('company'); ?>
<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="company-form" class="form-validate">
    <div class="jsont form-horizontal row-fluid span12">
        
            <div class="clearfix fltlft">
                <legend><?php echo JText::_('Office');?></legend>
                <div class="span12">
					
                    <div class="control-group">
                        <div class="controlsx">Company: <b><?php echo $this->item->company; ?></b></div>
                    </div>
					<div class="control-group">
                        <div class="controlsx">Owner: <b><?php echo $this->item->owner; ?></b></div>
                    </div>
					<div class="control-group">
                        <div class="controlsx">Address: <b><?php echo $this->item->address; ?></b></div>
                    </div>
					<div class="control-group">
                        <div class="controlsx">City: <b><?php echo $this->item->city; ?></b></div>
                    </div>
					<div class="control-group">
                        <div class="controlsx">State: <b><?php echo $this->item->usstate; ?></b></div>
                    </div>
					<div class="control-group">
                        <div class="controlsx">Zip Code: <b><?php echo $this->item->zip; ?></b></div>
                    </div>
					<div class="control-group">
                        <div class="controlsx">Phone: <b><?php echo $this->item->phone; ?></b></div>
                    </div>
					<div class="control-group">
                        <div class="controlsx">Email: <b><?php echo $this->item->email; ?></b></div>
                    </div>
					<?php if($this->item->logo){ ?>
					<div class="control-group">
                        <div class="controlsx">Logo: <b><img src="<?php echo $this->item->logo; ?>"/></b></div>
                    </div>
					<?php } ?>
                </div>

                <div class="span12">
                    <div class="control-group span4">
                        <div class="controlsx"><input disabled type="text" value="<?php echo $this->item->longitude ;?>" placeholder="Longitude" class="inputbox" name="jform[longitude]" id="jLong"/></div>
                    </div>
                    <div class="control-group span4">
                        <div class="controlsx"><input disabled type="text" value="<?php echo $this->item->latitude ;?>" placeholder="Latitude" class="inputbox" name="jform[latitude]" id="jLat"/></div>
                    </div>
                </div>
                <div class="span12 full">
                    <div class="control-group">
                        <div class="controlsx">
                            <?php 					
                                $cfg = array(
                                        'id' => $this->item->id,
                                        'address' => @$this->item->address . ' ' . $this->item->city . ' ' . $this->item->usstate,
                                        'lat' => @$this->item->latitude,
                                        'lng' => @$this->item->longitude,
                                        'width' => '97%',
                                        'height' => '250px',
                                );
                                echo jSont::googleMap($cfg); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <?php echo $this->form->getInput('id'); ?>
    <div style="display:none"><?php echo $this->form->getInput('userid'); ?></div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>
<?php echo JST::footer(); ?>