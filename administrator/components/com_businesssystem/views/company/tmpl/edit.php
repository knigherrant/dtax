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
JHtml::_('formbehavior.chosen', 'select', null, array('disable_search_threshold' => 0 ));
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

<form action="<?php echo JRoute::_('index.php?option=com_businesssystem&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="company-form" class="form-validate">
     <?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
    <?php else : ?>
        <div id="j-main-container">
    <?php endif;?>
    
    <div class="jsont form-horizontal row-fluid">
        <div class="clearfix fltlft">
                <div class="clearfix fltlft span6 full">
                    <legend><?php echo JText::_('Company');?></legend>
                    <?php foreach ($this->form->getFieldset('basic') as $field) : ?>
                           <div class="control-group <?php echo $field->fieldname; ?>">
                                    <div class="control-label">
                                            <?php echo $field->label; ?>
                                    </div>
                                    <div class="controls">
                                            <?php echo $field->input; ?>
                                    </div>
                            </div>
                    <?php endforeach; ?>
                        
                </div>
                <div class="clearfix fltlft span6">
                    <legend><?php echo JText::_('Business');?></legend>
                    <?php foreach ($this->form->getFieldset('info') as $field) : ?>
                           <div class="control-group">
                                    <div class="control-label">
                                            <?php echo $field->label; ?>
                                    </div>
                                    <div class="controls">
                                            <?php echo $field->input; ?>
                                    </div>
                            </div>
                    <?php endforeach; ?>
                </div>
                
        </div>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
    </div>
</form>