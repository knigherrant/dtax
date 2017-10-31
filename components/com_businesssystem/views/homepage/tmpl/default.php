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
$orders = $this->items;
$alerts = JST::getAlerts();
$company = JST::getCompanies();
?>
<?php echo JST::header(); ?>
<form action="<?php echo JRoute::_('index.php?option=com_businesssystem&view=expenses'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="wrapcontent">
        <div class="contenBlock">
            <div class="blockOrders">
                <div class="blockHeader ordersHeader">
                    Orders In Progress
                </div>
                <div class="blockContent ordersContent">
                <?php if($orders){ ?>
                    <?php foreach ($orders as $order){ ?>
                        <p><?php echo $order->order_status;?></p>
                    <?php } ?>
                <?php } ?>
                </div>
            </div>
            <div class="blockAlerts">
                <div class="blockHeader alertsHeader">
                    Alerts
                </div>
                <div class="blockContent alertsContent">
                <?php if($alerts){ ?>
                    <?php foreach ($alerts as $a){ ?>
                        <p><?php echo $a->alerts;?></p>
                    <?php } ?>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="blockCompany">
            <div class="blockHeader companyHeader">
                My Company
            </div>
            <div class="blockContent companyContent">
                <table>
                    <tr>
                        <th>Company</th>
                        <th>Classification</th>
                        <th>Fiscal Year End</th>
                    </tr>
                    <?php if($company){ ?>
                        <?php foreach ($company as $c){ ?>
                        <tr>
                            <td><?php echo $c->business_name1; ?></td>
                            <td><?php echo $c->title; ?></td>
                            <td><?php echo $c->fiscal_year; ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
            
        </div>
    </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />

        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>

<?php echo JST::footer(); ?>