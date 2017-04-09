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
JHtml::_('formbehavior.chosen', 'select');	
$this->form->setFieldAttribute('image', 'type', 'jkfile');
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar('employee'); ?>
<?php JST::tabsMenuOfice(); ?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'employee.cancel') {
                    Joomla.submitform(task, document.getElementById('employee-form'));
                }
                else{
                    
                    if (task != 'employee.cancel' && document.formvalidator.isValid(document.id('employee-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('employee-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }

</script>

<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="employee-form" class="form-validate">
    <div class="jsont jCustommer form-horizontal row-fluid">
        <legend><?php echo JText::_('Employee');?></legend>
            <div class="clearfix fltlft span9">
                <div class="span12">
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('employee'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('employee'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('title'); ?></div>
                    </div><div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('phone'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('phone'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('email'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('username'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('username'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('password'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('password'); ?></div>
                    </div><div class="control-group full">
                        <div class="control-label"><?php echo $this->form->getLabel('operation'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('operation'); ?></div>
                    </div>
                    <div class="control-group full">
                        <div class="control-label"><?php echo $this->form->getLabel('about'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('about'); ?></div>
                    </div>
                    <div class="control-group ">
                        <div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('image'); ?></div>
                    </div>
                    <div class="control-group ">
                        <div class="control-label"><?php echo $this->form->getLabel('created'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('created'); ?></div>
                    </div>
                     <div class="control-group ">
                        <div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
                    </div>
                </div>
            </div>    
        
    </div>
    <div style="display: none;">
        <?php echo $this->form->getInput('userid'); ?>
    </div>
    <?php echo $this->form->getInput('id'); ?>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>

<?php echo JST::footer(); ?>