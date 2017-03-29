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

JHtml::_('formbehavior.chosen', 'select');

JHtml::_('behavior.keepalive');
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'invoice.cancel') {
            Joomla.submitform(task, document.getElementById('invoice-form'));
        }
        else {
            
            if (task != 'invoice.cancel' && document.formvalidator.isValid(document.id('invoice-form'))) {
                if($JVDAM('#jform_storage_type').val() == 'file' && $JVDAM('#jform_storage_path_file').val() == ''){
                    alert('<?php echo $this->escape(JText::_('COM_DTAX_MSG_FILE_PATH_REQUIRE')); ?>');
                }else if($JVDAM('#jform_storage_type').val() == 'remote' && $JVDAM('#jform_storage_path_remote').val() == ''){
                    alert('<?php echo $this->escape(JText::_('COM_DTAX_MSG_FILE_PATH_REMOTE_REQUIRE')); ?>');
                }else{
                    Joomla.submitform(task, document.getElementById('invoice-form'));
                }
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>
<?php echo jSont::menuSiderbar(); ?>
<div class="dtax">
    <form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="invoice-form" class="form-validate">
        <div class="form-horizontal row-fluid">
            <div class="span6">
                <legend><?php echo JText::_('Detail');?></legend>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('title'); ?></div>
                </div>
   
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('cpaid'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('cpaid'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('category'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('category'); ?></div>
                </div>
        
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('storage_type'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('storage_type'); ?></div>
                </div>
                <div class="control-group" style="<?php if($this->item->storage_type == 'remote') echo 'display:none;'?>">
                    <div class="control-label"><?php echo $this->form->getLabel('storage_path_file'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('storage_path_file'); ?></div>
                </div>
                <div class="control-group" style="<?php if(!$this->item->storage_type || $this->item->storage_type == 'file') echo 'display:none;'?>">
                    <div class="control-label"><?php echo $this->form->getLabel('storage_path_remote'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('storage_path_remote'); ?></div>
                </div>
                <legend><?php echo JText::_('Description');?></legend>
                <div>
                    <?php echo $this->form->getInput('description'); ?>
                </div>
            </div>
            <div class="span6">
                <legend><?php echo JText::_('Metadata');?></legend>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('company'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('company'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('access'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('access'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('state'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('image'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('icon'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('icon'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('publish_on'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('publish_on'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('unpublish_on'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('unpublish_on'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('created'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('created'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('modified_by'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('modified_by'); ?></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('modified'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('modified'); ?></div>
                </div>
                
              
            </div>

            <?php echo $this->form->getInput('id'); ?>
            <?php echo $this->form->getInput('icon_custom'); ?>
            <?php echo $this->form->getInput('filesize'); ?>
            <?php echo $this->form->getInput('ext'); ?>
            <input type="hidden" name="task" value="" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
