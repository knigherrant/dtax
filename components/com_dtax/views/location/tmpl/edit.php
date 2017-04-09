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
JHTML::_('script', 'system/multiselect.js', false, true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_dtax/assets/css/dtax.css');
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar('location'); ?>
<?php JST::tabsMenuOfice(); ?>

<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'location.cancel') {
                    Joomla.submitform(task, document.getElementById('location-form'));
                }
                else{
                    
                    if (task != 'location.cancel' && document.formvalidator.isValid(document.id('location-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('location-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }

</script>

<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="location-form" class="form-validate">
    <div class="form-horizontal row-fluid">
            <div class="clearfix fltlft">
                <legend><?php echo JText::_('Office');?></legend>
               

                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('name'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('address'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('city'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('state'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('zip'); ?></div>
                        </div>
                
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('phone'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('email'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('username'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('password'); ?></div>
                        </div>
                        
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('created'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="controlsx"><?php echo $this->form->getInput('created_by'); ?></div>
                        </div>
                
                        <div class="span12">
                            <div class="control-group">
                                <div class="controlsx"><?php echo $this->form->getInput('longitude'); ?></div>
                                <div class="controlsx"><?php echo $this->form->getInput('latitude'); ?></div>
                            </div>
                        </div>
						
						<div class="clr"></div>
							<div style="clear:both">
								<div class="control-group">
								
									<div class="controlsx">
								<?php 
									
									$cfg = array(
										'id' => $this->item->id,
										'address' => $this->item->address,
										'lat' => $this->item->latitude,
										'lng' => $this->item->longitude,
									);
									echo jSont::googleMap($cfg); 
								?>
									</div>
								</div>
							</div>
               
            </div>
          
            
        </div>
    
    
    

    <?php echo $this->form->getInput('id'); ?>
    <?php echo $this->form->getInput('userid'); ?>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>
<?php echo JST::footer(); ?>