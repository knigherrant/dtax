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
JHtml::_('behavior.modal', 'a.modal');
							
?>
<?php echo jSont::menuSiderbar(); ?>
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

<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="company-form" class="form-validate">
    <div class="jsont form-horizontal row-fluid span12">
        
            <div class="clearfix fltlft span9">
                <legend><?php echo JText::_('Company');?></legend>
<<<<<<< HEAD
                <div class="span12">
                    <div class="control-group full">
                        <div class="controlsx "><?php echo $this->form->getInput('company'); ?></div>
=======
                <div class="span12 jsontfirst">
                    <div class="control-group span6">
                        <div class="controlsx"><?php echo $this->form->getInput('userid'); ?></div>
                    </div>
                    <div class="control-group span6">
                        <div class="controlsx"><?php echo $this->form->getInput('company'); ?></div>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                    </div>
                </div>
                <div class="span12">
                    <div class="control-group span6">
                        <div class="controlsx"><?php echo $this->form->getInput('owner'); ?></div>
                    </div>
                    <div class="control-group span6">
                        <div class="controlsx"><?php echo $this->form->getInput('address'); ?></div>
                    </div>
                </div>
                
                <div class="span12">
                    <div class="control-group span4">
                        <div class="controlsx"><?php echo $this->form->getInput('city'); ?></div>
                    </div>
                    <div class="control-group span4">
                        <div class="controlsx"><?php echo $this->form->getInput('usstate'); ?></div>
                    </div>
                    <div class="control-group span4">
                        <div class="controlsx"><?php echo $this->form->getInput('zip'); ?></div>
                    </div>
                </div>
                <div class="span12">
                    <div class="control-group span4">
                        <div class="controlsx"><?php echo $this->form->getInput('phone'); ?></div>
                    </div>
                    <div class="control-group span4">
                        <div class="controlsx"><?php echo $this->form->getInput('username'); ?></div>
                    </div>
                    <div class="control-group span4">
                        <div class="controlsx"><?php echo $this->form->getInput('password'); ?></div>
                    </div>
                </div>
                
                <div class="span12 full">
                    <div class="control-group">
                        <div class="controlsx"><?php echo $this->form->getInput('email'); ?></div>
                    </div>
                </div>
                
                <div class="span12">
                    <div class="control-group span4">
                        <div class="controlsx"><input type="text" value="<?php echo @$this->item->location->longitude ;?>" placeholder="Longitude" class="inputbox" name="jLong" id="jLong"/></div>
                    </div>
                    <div class="control-group span4">
                        <div class="controlsx"><input type="text" value="<?php echo @$this->item->location->latitude ;?>" placeholder="Latitude" class="inputbox" name="jLat" id="jLat"/></div>
                    </div>
                    <div class="control-group span4">
                        <div class="controlsx"><?php echo $this->form->getInput('logo'); ?></div>
                    </div>
                </div>
                <div class="span12 full">
                    <div class="control-group">
                        <div class="controlsx">
                        <?php echo $this->form->getInput('location_id'); ?>
                            <?php 					
                                $cfg = array(
                                        'id' => $this->item->id,
                                        'address' => @$this->item->location->address,
                                        'lat' => @$this->item->location->latitude,
                                        'lng' => @$this->item->location->longitude,
                                        'width' => '97%',
                                        'height' => '250px',
                                );
                                echo jSont::googleMap($cfg); 
                            ?>
                        </div>
                    </div>
                </div>
              
                <div class="span12">
                    <div class="control-group span6">
                        <div class="controlsx"><a href="index.php?option=com_dtax&view=location&layout=edit&tmpl=component" rel="{handler: 'iframe', size: {x:600, y:600}}" class="btn btn-small btn-success modal">Add Location</a></div>
                    </div>
                    <div class="control-group span6" style="text-align: right">
                        <div class="control-label"><?php echo $this->form->getLabel('featured'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('featured'); ?></div>
                    </div>
                </div>
            </div>
            
            <div class="span3" >
                <legend><?php echo JText::_('Server Configuration');?></legend>
                <?php foreach ($this->form->getFieldset('server') as $field){  ?>
                       <div class="control-group">
                                <div class="controlsx">
                                        <?php echo $field->input; ?>
                                </div>
                        </div>
                <?php }; ?>
                <legend><?php echo JText::_('Banner Ads');?></legend>
                <?php foreach ($this->form->getFieldset('banner') as $field){  ?>
                       <div class="control-group">
                                <div class="controlsx">
                                        <?php echo $field->input; ?>
                                </div>
                        </div>
                <?php }; ?>
                <legend><?php echo JText::_('Design Configuration');?></legend>
                <?php foreach ($this->form->getFieldset('design') as $field){  ?>
                       <div class="control-group">
                                <div class="controlsx">
                                        <?php echo $field->input; ?>
                                </div>
                        </div>
                <?php }; ?>
                
                
                
            </div>
        <div class="span12" style="padding: 10px">
            <?php echo $this->loadTemplate('locations');?>
        </div>
        
    </div>
<<<<<<< HEAD
    <div style="display: none;">
        <?php echo $this->form->getInput('userid'); ?>
    </div>
=======
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
    <?php echo $this->form->getInput('id'); ?>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>