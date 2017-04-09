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
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
JHtmlBootstrap::loadCss();
$document = JFactory::getDocument();
//JHtmlBootstrap::loadCss(true);
//$document->addStyleSheet('components/com_dtax/assets/css/bootstrap.min.css');
$document->addStyleSheet('components/com_dtax/assets/css/bootstrap-timepicker.min.css');
$document->addScript('components/com_dtax/assets/js/bootstrap-timepicker.min.js');
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar('appointment'); ?>
<br/>
<?php JST::tabsMenuAppoint(); ?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'appointment.cancel') {
                    Joomla.submitform(task, document.getElementById('appointment-form'));
                }
                else{
                    
                    if (task != 'appointment.cancel' && document.formvalidator.isValid(document.id('appointment-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('appointment-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }
            jQuery(function($){
                $("#jform_apptime").timepicker({
                    showInputs: false
                  });
            })

</script>
<style>
.glyphicon-chevron-down::before {
    content: "";
}
.glyphicon-chevron-up::before {
    content: "";
}
*::after, *::before {
    box-sizing: border-box;
}
*::after, *::before {
    box-sizing: border-box;
}
.bootstrap-timepicker-widget table td a i {
    margin-top: 2px;
}
.glyphicon {
    display: inline-block;
    font-family: "Glyphicons Halflings";
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    position: relative;
    top: 1px;
}
</style>
<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="appointment-form" class="form-validate">
    <div class="jsont jCustommer form-horizontal row-fluid">
            <div class="clearfix fltlft span9">
                <div class="span12">
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('taxpayer'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('taxpayer'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('phone'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('phone'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('email'); ?></div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('service'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('service'); ?></div>
                    </div>
                    
                    <div class="control-group full">
                        <div class="control-label"><?php echo $this->form->getLabel('notes'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('notes'); ?></div>
                    </div>
                    <div class="control-group ">
                        <div class="control-label"><?php echo $this->form->getLabel('appdate'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('appdate'); ?></div>
                    </div>
                    <div class="control-group ">
                        
                        
                        
                        <div class="control-label"><?php echo $this->form->getLabel('apptime'); ?></div>
                        <div class="controls">
                            <div class="bootstrap-timepicker">
             
                                <?php echo $this->form->getInput('apptime'); ?>
                
                        </div>  
                            </div>
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