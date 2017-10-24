<?php
/**
 * @version     1.0.0
 * @package     com_businesssystem
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
<?php echo JST::header(); ?>
<?php echo JST::toolbar('location'); ?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'location.cancel') {
                    Joomla.submitform(task, document.getElementById('location-form'));
                }
                else{
                    
                    if (task != 'location.cancel' && document.formvalidator.isValid(document.id('location-form'))) {

						 if(jQuery('#jLong').val() == '' || jQuery('#jLat').val() == ''){
							var address =  jQuery('#jform_address1').val() + ' ' + jQuery('#jform_city').val()+ ' ' + jQuery('#jform_state').val();
							jSont.codeAddress(address);
						}
						
                        Joomla.submitform(task, document.getElementById('location-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }

</script>

<form action="<?php echo JRoute::_('index.php?option=com_businesssystem&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="location-form" class="form-validate">
    <div class="jsContents form-horizontal row-fluid jscustom12">
        <legend><?php echo JText::_('BDS');?></legend>
        <?php JST::tabBDS(); ?>
            <div class="clearfix fltlft span12">
                <div class="jsontfirst">
                    <div class="control-group field1">
                        <div class="controlsx"><?php echo $this->form->getInput('company'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('firstname'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('midname'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('lastname'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group field1">
                        <div class="controlsx"><?php echo $this->form->getInput('address1'); ?></div>
                    </div>
                </div>
                <div class="jscustom12 full">
                    <div class="control-group field1">
                        <div class="controlsx"><?php echo $this->form->getInput('address2'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('city'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('state'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('zip'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('phone'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('cell_phone'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('fax'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('email'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('url'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('logo'); ?></div>
                    </div>
                </div>
                <div class="jscustom12 full">
                    <div class="control-group">
                        <p>Notes</p>
                        <div class="controlsx"><?php echo $this->form->getInput('notes'); ?></div>
                    </div>
                </div>
              
                <div class="jscustom12">
                    <div class="control-group span6" style="text-align: right">
                        <div class="control-label"><?php echo $this->form->getLabel('featured'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('featured'); ?></div>
                    </div>
                </div>
            </div>
            
            <div class="jscustom12" >
                <div class="control-group">
                        <div class="controlsx">
                            <input type="text" value="<?php echo @$this->item->longitude ;?>" placeholder="Longitude" class="inputbox" name="jform[longitude]" id="jLong"/>
                        </div>
                </div>
                <div class="control-group">
                    <div class="controlsx">
                            <input type="text" value="<?php echo @$this->item->latitude ;?>" placeholder="Latitude" class="inputbox" name="jform[latitude]" id="jLat"/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controlsx">
                            <?php 					
                                $cfg = array(
                                        'id' => $this->item->id,
                                        'address' => $this->item->address1 . ' ' . $this->item->city. ' '. $this->item->state,
                                        'lat' => @$this->item->latitude,
                                        'lng' => @$this->item->longitude,
                                        'width' => '320px',
                                        'height' => '200px',
                                );
                                echo jSont::googleMap($cfg); 
                            ?>
                    </div>
                </div>
               
            </div>

        
    </div>
    <?php echo $this->form->getInput('id'); ?>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
    <div style="display: none"><?php echo $this->form->getInput('userid'); ?><?php echo $this->form->getInput('created_by'); ?></div>
</form>
<?php echo JST::footer(); ?>