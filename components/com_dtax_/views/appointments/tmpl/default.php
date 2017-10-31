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
$document->addStyleSheet('components/com_dtax/assets/css/fullcalendar.min.css');
$document->addScript('components/com_dtax/assets/js/moment.min.js');
$document->addScript('components/com_dtax/assets/js/fullcalendar.min.js');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canOrder = $user->authorise('core.edit.state', 'com_dtax');
$saveOrder = $listOrder == 'a.ordering';
$calendar = JST::getJsonAppoint();
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar('appointment', true); ?>
<?php JST::tabsMenuAppoint(); ?>
<form action="<?php echo JRoute::_('index.php?option=com_dtax&view=appointments'); ?>" method="post" name="adminForm" id="adminForm">

        <div id="j-main-container">
            <div id="calendar"></div>
        </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
<script>
jQuery(function ($) {
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events:[
          <?php foreach ($calendar as $d){ ?>
            {
                title: '<?php echo $d->title; ?>',
                start: '<?php echo $d->start; ?>',
                url : '<?php echo $d->url; ?>',
            },              
          <?php } ?>
      ] 
    });
});
</script>

<?php echo JST::footer(); ?>