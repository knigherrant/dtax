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
JHTML::_('script', 'system/multiselect.js', false, true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_businesssystem/assets/css/businesssystem.css');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canOrder = $user->authorise('core.edit.state', 'com_businesssystem');
$saveOrder = $listOrder == 'a.ordering';
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar(); ?>
<form action="<?php echo JRoute::_('index.php?option=com_businesssystem&view=expenses'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="wrapcontent">
        <div id="profile">
            <?php echo JST::profile(); ?>
        </div>
        <div class="clearfix"></div>
        <div id="static">
            <div class="block block1">
                <div class="bcontent">
                    <?php if(JST::isBDS()){ ?>
                        <p class="key">Total Invoices</p>
                        <p class="value"><?php echo JST::getInvoices()->total ; ?></p>
                    <?php }else{ ?>
                        <p class="key">Total Expenses</p>
                        <p class="value">$<?php echo (int)JST::getExpenses()->total ; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="block block2">
                <div class="bcontent">
                    <?php if(JST::isBDS()){ ?>
                        <p class="key">Tax Returns</p>
                        <p class="value"><?php echo JST::getTaxs()->total ; ?></p>
                    <?php }else{ ?>
                        <p class="key">Total Receipts</p>
                        <p class="value">$<?php echo (int)JST::getReceipts()->total ; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="block block3">
                <div class="bcontent">
                    <?php if(JST::isBDS()){ ?>
                        <p class="key">Customer</p>
                        <p class="value"><?php echo JST::getCustomer()->total ; ?></p>
                    <?php }else{ ?>
                        <p class="key">Total Mileages</p>
                        <p class="value"><?php echo JST::getMileages()->total ; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="chartContent">
            <div class="heading">
                <h4>STATISTICS</h4>
            </div>
            <div class="chartx">
                <?php echo JST::getChart(); ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="message">
            <div class="inbox">
                <div class="inbox-head">
                    <h4>MESSAGE</h4>
                </div>
            </div> 
            
            <div class="sendmsg">
                <textarea></textarea>
                
            </div>
        </div>
    </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>

<?php echo JST::footer(); ?>