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
JHTML::_('script', 'system/multiselect.js', false, true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_dtax/assets/css/dtax.css');
$user = JFactory::getUser();
$userId = $user->get('id');
$locations = JST::getLocation();
$employee = JST::getEmployee();
$appoint = JST::getAppoint();
$email = JST::getEmail();

$input = JFactory::getApplication()->input;
$Itemid = $input->getInt('Itemid', 0);

?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar(); ?>
<form action="<?php echo JRoute::_('index.php?option=com_dtax&view=homepage'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="wrapcontent">
        <div class="headContent">
            <div class="home1 taxcol span4">
                <div class="htop">
                    <div class="bg">
                        <p class="viewpage"><a href="<?php echo JST::getLink('locations'); ?>">View</a></p>
                        <?php foreach ($locations as $l){ ?>
                        <p class="jItem">
                            <a href="<?php echo JRoute::_('index.php?option=com_dtax&task=location.edit&id=' . $l->id); ?>"><?php echo $l->address; ?></a>
                            <span data-id="<?php echo $l->id; ?>" data-action="locations" class="icon-trash"></span>
                        </p>
                        <?php } ?>
                        <div class="titleButtom">
                            <h3>My Office(s)</h3>
                        </div>
                    </div>
                </div>
                <div class="hbottom">
                    <div class="bg">
                        <p class="viewpage"><a href="<?php echo JST::getLink('employees'); ?>">View</a></p>
                        <?php foreach ($employee as $e){ ?>
                        <p class="jItem">
                            <a href="<?php echo JRoute::_('index.php?option=com_dtax&task=employee.edit&id=' . $e->id); ?>"><?php echo $e->employee; ?></a> - <?php echo $e->title; ?>
                            <span data-id="<?php echo $e->id; ?>" data-action="employees" class="icon-trash"></span>
                        </p>
                        <?php } ?>
                        <div class="titleButtom">
                            <h3>Employee(s)</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home2 taxcol span4">
                <div class="bg">
                    <p class="viewpage"><a href="<?php echo JST::getLink('appointments'); ?>">View</a></p>
                    <?php foreach ($appoint as $a){ ;?>
                        <p class="jItem">
                            <a href="<?php echo JRoute::_('index.php?option=com_dtax&task=appointment.edit&id=' . $a->id); ?>">
                                <?php echo $a->taxpayer; ?></a> 
                                - <?php echo JST::format($a->appdate); ?>
                                - <?php echo $a->apptime; ?>
                                - <?php echo $a->service; ?>
                            <span data-id="<?php echo $a->id; ?>" data-action="appointments" class="icon-trash"></span>
                        </p>
                    <?php } ?>
                        <div class="titleButtom">
                            <h3>Appointments</h3>
                        </div>
                </div>
            </div>
            <div class="home3 taxcol span4">
                <div class="bg">
                    <p class="viewpage"><a href="<?php echo JST::getLink('emails'); ?>">View</a></p>
                    <?php foreach ($email as $m){ ?>
                        <p class="jItem">
                            <a href="<?php echo JRoute::_('index.php?option=com_dtax&task=email.edit&id=' . $m->id); ?>"><?php echo $m->taxpayer; ?></a>
                            - <?php echo $m->reason; ?>
                            <span data-id="<?php echo $m->id; ?>" data-action="email" class="icon-trash"></span>
                        </p>
                    <?php } ?>
                        <div class="titleButtom">
                            <h3>Email</h3>
                        </div>
                </div>
            </div>
        </div>
        <div class="taxContent">
            <div class="bg">
                <p class="viewpage"><a href="<?php echo JST::getLink('taxreturns'); ?>">View</a><p>
                <table>
                    <?php foreach ($this->items as $item){ ?>
                    <tr class="jItem">
                        <td><a href="<?php echo JRoute::_('index.php?option=com_dtax&task=taxreturn.edit&id=' . $item->id); ?>"><?php echo $item->name ;?></a></td>
                        <td><?php echo $item->tax_social_number ;?></td>
                        <td><?php echo $item->tax_cellphone ;?></td>
                        <td><?php echo $item->tax_email ;?></td>
                        <td><?php echo JST::format($item->created) ;?></td>
                        <td><span data-id="<?php echo $item->id; ?>" data-action="taxreturns" class="icon-trash"></span></td>
                    </tr>
                    <?php } ?>
                </table>
                <div class="titleButtom">
                    <h3>Tax Return</h3>
                </div>
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