<?php
/**
 * @version     16.5.5
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
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . 'components/com_businesssystem/assets/js/json2.js');
$doc->addScript(JUri::base() . 'components/com_businesssystem/assets/js/jsconfigs.js');
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task){
        if (task == 'configs.cancel') {
            Joomla.submitform(task, document.getElementById('configs-form'));
        }
        else {

            if (task != 'configs.cancel' && document.formvalidator.isValid(document.id('configs-form'))) {
                jvConfigs.setValueItems('formProducts');
                //jvConfigs.setValueItems('cOrderStatuss');
                //jvConfigs.setValueItems('expensesCategories');orderstatus
                //jvConfigs.setValueItems('receiptCategories');
                Joomla.submitform(task, document.getElementById('configs-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>
<div class="signaturedoc">
    <form action="<?php echo JRoute::_('index.php?option=com_businesssystem')?>" method="post" enctype="multipart/form-data" name="adminForm" id="configs-form" class="form-validate dam-dashboad">
        <?php if(!empty($this->sidebar)): ?>
        <div id="j-sidebar-container" class="span2">
            <?php echo $this->sidebar; ?>
        </div>
        <div id="j-main-container" class="span10">
        <?php else : ?>
        <div id="j-main-container">
            <?php endif;?>
            <div class="row-fluid form-horizontal" >
                <div id="addCategories" class="span12">
                    <div id="taxformCategory" class="span3">
                        <legend>List Products</legend>
                            <div id="formProducts"></div>
                            <textarea style="display:none" class="formProducts" name="products"><?php echo $this->item->products; ?></textarea>
                            <input type="button" name="button" data-id="formProducts" class="btn btn-small btn-success addItem button-hero" value="Add">
                     </div>  
                    <!--
                    <div id="configOrderStatus" class="span3">
                        <legend>Order Status</legend>
                            <div id="cOrderStatuss"></div>
                            <textarea style="display:none" class="cOrderStatuss" name="orderstatus"><?php echo $this->item->orderstatus; ?></textarea>
                            <input type="button" name="button" data-id="cOrderStatuss" class="btn btn-small btn-success addItem button-hero" value="Add">
                     </div>  
                    -->
                    
                    <div id="link" class="span6">
                        <legend>Link Menu</legend>
                        <div class="control-group">
                            <div class="control-label"><?php echo $this->form->getLabel('menu1'); ?></div>
                            <div class="controls"><?php echo $this->form->getInput('menu1'); ?><?php echo $this->form->getInput('text1'); ?></div>
                        </div>
                        <div class="control-group">
                            <div class="control-label"><?php echo $this->form->getLabel('menu2'); ?></div>
                            <div class="controls"><?php echo $this->form->getInput('menu2'); ?><?php echo $this->form->getInput('text2'); ?></div>
                        </div>
                       
                     </div>  
                    
                </div>
                
                 <br/>
                <input type="hidden" name="task" value="" />
                <?php echo JHtml::_('form.token'); ?>

            </div>
        </div>
    </form>
</div>

<style>
    #import_email_body_ifr{
        height: 250px !important;
    }
</style>