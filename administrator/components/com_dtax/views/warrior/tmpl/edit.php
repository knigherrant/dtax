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
JHtml::_('formbehavior.chosen', 'select', null, array('disable_search_threshold' => 0 ));
?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'warrior.cancel') {
                    Joomla.submitform(task, document.getElementById('warrior-form'));
                }
                else{
                    
                    if (task != 'warrior.cancel' && document.formvalidator.isValid(document.id('warrior-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('warrior-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }

</script>
<?php echo jSont::menuSiderbar(); ?>
<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="warrior-form" class="form-validate">
    <div class="form-horizontal row-fluid">
            <div class="clearfix fltlft">
                <legend><?php echo JText::_('Warrior');?></legend>
                <?php foreach ($this->form->getFieldset('basic') as $field) : ?>
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
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>