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
<<<<<<< HEAD
JHtml::_('formbehavior.chosen', 'select');	
$this->form->setFieldAttribute('image', 'type', 'jkfile');
=======
JHtml::_('formbehavior.chosen', 'select');							
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar('taxreturn'); ?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'taxreturn.cancel') {
                    Joomla.submitform(task, document.getElementById('taxreturn-form'));
                }
                else{
                    
                    if (task != 'taxreturn.cancel' && document.formvalidator.isValid(document.id('taxreturn-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('taxreturn-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }

</script>

<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="taxreturn-form" class="form-validate">
<<<<<<< HEAD
    <div class="jsont jCustommer form-horizontal row-fluid">

                    <ul class="nav nav-tabs" id="myTabTabs">
                        <li class="active"><a href="#taxpayer" data-toggle="tab">Taxpayer</a></li>
                        <li class=""><a href="#spouse" data-toggle="tab">Spouse</a></li>
                        <li class=""><a href="#address" data-toggle="tab">Address</a></li>
                        <li class=""><a href="#dependent1" data-toggle="tab">Dependent 1</a></li>
=======
   <div class="jsContents jCustommer form-horizontal row-fluid jscustom12">
        <legend><?php echo JText::_('Tax Return');?></legend>
            <div class="clearfix fltlft jscustom12">
                <!-- TAX RETURN -->
                <div class="jscustom12 jsontfirst">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_firstname'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_midname'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_lastname'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_birthday'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_social_number'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_filing_status'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_license_id'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_issue_date'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_expiration_date'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_occupation'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('tax_dependents'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"></div>
                    </div>
                </div>
                <!-- END TAX -->
                <legend><?php echo JText::_('Spouse');?></legend>
                <div class="jscustom12 jsontfirst">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_firstname'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_midname'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_lastname'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_birthday'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_social_number'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_filing_status'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_license_id'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_issue_date'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_expiration_date'); ?></div>
                    </div>
                </div>
                <div class="jscustom12">
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('spouse_occupation'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"></div>
                    </div>
                </div>
                <!--- END SPOUSE -->
                <!-- ADDRESS -->
                <div class="jscustom12 full">
                    <div class="control-group jscustom8">
                        <div class="controlsx"><?php echo $this->form->getInput('address'); ?></div>
                    </div>
                    <div class="control-group jscustom4 field3">
                        <div class="controlsx"><?php echo $this->form->getInput('apartment'); ?></div>
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
                    <div class="control-group jscustom8">
                        <div class="controlsx"><?php echo $this->form->getInput('email'); ?></div>
                    </div>
                </div>
                
                <div class="jscustom12">
                    <ul class="nav nav-tabs" id="myTabTabs">
                        <li class="active"><a href="#dependent1" data-toggle="tab">Dependent 1</a></li>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                        <li class=""><a href="#dependent2" data-toggle="tab">Dependent 2</a></li>
                        <li class=""><a href="#dependent3" data-toggle="tab">Dependent 3</a></li>
                        <li class=""><a href="#dependent4" data-toggle="tab">Dependent 4</a></li>
                        <li class=""><a href="#dependent5" data-toggle="tab">Dependent 5</a></li>
<<<<<<< HEAD
                        <li class=""><a href="#images" data-toggle="tab">Images</a></li>
                    </ul>
                   <div id="myTabContent" class="tab-content">
                       <div id="taxpayer" class="tab-pane active">
                                <div class="control-label"><?php echo $this->form->getLabel('tax_firstname'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_firstname'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_midname'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_midname'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_lastname'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_lastname'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_birthday'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_birthday'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_social_number'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_social_number'); ?></div>
                                </div>
                                 <div class="control-label"><?php echo $this->form->getLabel('tax_license_id'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_license_id'); ?></div>
                                </div>
                                
                                
                                <div class="control-label"><?php echo $this->form->getLabel('tax_issue_date'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_issue_date'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_issue_state'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_issue_state'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_expiration_date'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_expiration_date'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_employment'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_employment'); ?></div>
                                </div>
                                
                                <div class="control-label"><?php echo $this->form->getLabel('tax_filing_status'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_filing_status'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_dependents'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_dependents'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_email'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_email'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_cellphone'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_cellphone'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('tax_cellprovider'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('tax_cellprovider'); ?></div>
                                </div>
                            
                       </div>
                       <div id="spouse" class="tab-pane">
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_firstname'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_firstname'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_midname'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_midname'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_lastname'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_lastname'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_birthday'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_birthday'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_social_number'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_social_number'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_filing_status'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_filing_status'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_license_id'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_license_id'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_issue_date'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_issue_date'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_expiration_date'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_expiration_date'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_issue_state'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_issue_state'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_employment'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_employment'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('spouse_cellphone'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('spouse_cellphone'); ?></div>
                                </div>
                            
                       </div>
                       <div id="address" class="tab-pane">
                                <div class="control-label"><?php echo $this->form->getLabel('address'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('address'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('apartment'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('apartment'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('city'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('city'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('state'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('zip'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('zip'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('phone'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('phone'); ?></div>
                                </div>
                                <div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
                                <div class="control-group ">
                                    <div class="controls"><?php echo $this->form->getInput('email'); ?></div>
                                </div>
                           
                       </div>
                       <div id="dependent1" class="tab-pane">
                           <?php $i = 0; foreach ($this->form->getFieldset('d1') as $field){  ?>
                                <div class="control-group  custom<?php echo $i; ?>">
                                        <div class="control-label"><?php echo $field->label; ?></div>
                                         <div class="controls"> 
=======
                    </ul>
                   <div id="myTabContent" class="tab-content">
                       <div id="dependent1" class="tab-pane active">
                           <?php $i = 0; foreach ($this->form->getFieldset('d1') as $field){  ?>
                                <div class="control-group jscustom4 field3 custom<?php echo $i; ?>">
                                         <div class="controlsx"> 
                                             <?php if($i == 6 || $i == 7){ ?> <?php echo $field->description; ?> <?php } ?> 
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                                 <?php echo $field->input; ?> 
                                         </div>
                                 </div>
                            <?php $i ++; }; ?>
                       </div>
                       <div id="dependent2" class="tab-pane">
                           <?php $i = 0; foreach ($this->form->getFieldset('d2') as $field){  ?>
<<<<<<< HEAD
                                <div class="control-group  custom<?php echo $i; ?>">
                                        <div class="control-label"><?php echo $field->label; ?></div>
                                         <div class="controls"> 
=======
                                <div class="control-group jscustom4 field3 custom<?php echo $i; ?>">
                                         <div class="controlsx"> 
                                             <?php if($i == 6 || $i == 7){ ?> <?php echo $field->description; ?> <?php } ?> 
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                                 <?php echo $field->input; ?> 
                                         </div>
                                 </div>
                            <?php $i ++; }; ?>
                       </div>
                       <div id="dependent3" class="tab-pane">
                           <?php $i = 0; foreach ($this->form->getFieldset('d3') as $field){  ?>
<<<<<<< HEAD
                                <div class="control-group  custom<?php echo $i; ?>">
                                        <div class="control-label"><?php echo $field->label; ?></div>
                                         <div class="controls"> 
=======
                                <div class="control-group jscustom4 field3 custom<?php echo $i; ?>">
                                         <div class="controlsx"> 
                                             <?php if($i == 6 || $i == 7){ ?> <?php echo $field->description; ?> <?php } ?> 
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                                 <?php echo $field->input; ?> 
                                         </div>
                                 </div>
                            <?php $i ++; }; ?>
                       </div>
                       <div id="dependent4" class="tab-pane">
                           <?php $i = 0; foreach ($this->form->getFieldset('d4') as $field){  ?>
<<<<<<< HEAD
                                <div class="control-group  custom<?php echo $i; ?>">
                                        <div class="control-label"><?php echo $field->label; ?></div>
                                         <div class="controls"> 
=======
                                <div class="control-group jscustom4 field3 custom<?php echo $i; ?>">
                                         <div class="controlsx"> 
                                             <?php if($i == 6 || $i == 7){ ?> <?php echo $field->description; ?> <?php } ?> 
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                                 <?php echo $field->input; ?> 
                                         </div>
                                 </div>
                            <?php $i ++; }; ?>
                       </div>
                       <div id="dependent5" class="tab-pane">
                           <?php $i = 0; foreach ($this->form->getFieldset('d5') as $field){  ?>
<<<<<<< HEAD
                                <div class="control-group  custom<?php echo $i; ?>">
                                        <div class="control-label"><?php echo $field->label; ?></div>
                                         <div class="controls"> 
=======
                                <div class="control-group jscustom4 field3 custom<?php echo $i; ?>">
                                         <div class="controlsx"> 
                                             <?php if($i == 6 || $i == 7){ ?> <?php echo $field->description; ?> <?php } ?> 
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                                 <?php echo $field->input; ?> 
                                         </div>
                                 </div>
                            <?php $i ++; }; ?>
                       </div>
<<<<<<< HEAD
                       <div id="images" class="tab-pane">
                                <div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
                                <div class="controls"><?php echo $this->form->getInput('image'); ?></div>
                        </div>
                   </div>
             
=======
                   </div>
               </div>
                <div class="jscustom12">
                        <div class="controlsx"><?php echo $this->form->getInput('image'); ?></div>
                </div>
                
            </div>
            
            <div class="jscustom3" >
                <legend><?php echo JText::_('Infomaion');?></legend>
                <?php foreach ($this->form->getFieldset('right') as $field){  ?>
                       <div class="control-group">
                                <div class="controlsx">
                                        <?php echo $field->input; ?>
                                </div>
                        </div>
                <?php }; ?>
            </div>
        
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
    </div>
    <?php echo $this->form->getInput('id'); ?>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>

<?php echo JST::footer(); ?>