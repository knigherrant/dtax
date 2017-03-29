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
$item = $this->item;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
//k($item);
?>
<?php echo jSont::menuSiderbar(); ?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'profile.cancel') {
                    Joomla.submitform(task, document.getElementById('profile-form'));
                }
                else{
                    
                    if (task != 'profile.cancel' && document.formvalidator.isValid(document.id('profile-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('profile-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }

</script>
<div id="DTaxContent">
    <div id="profile-content">
        <form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="profile-form" class="form-validate">
        <?php echo jSont::showProfileHtml($item->userid); ?>
        <div class="bio lineButtom">
            <legend><?php echo JText::_('Personal Bio'); ?></legend>
            <div class="content-bio"><?php echo $item->bio; ?></div>

        </div>

        <div class="prayrequest lineButtom">
            <legend><?php echo JText::_('Prayer Request'); ?></legend>
            <?php echo @$item->prayerRequest->prayer_request; ?>
            <div class="clearfix clear"></div>
			<div class="bntRight">
				<a href="<?php echo JRoute::_('index.php?option=com_dtax&view=requests'); ?>" class="btn btn-xs">
						View All Request
				</a>
			</div>
        </div>
        
        <div class="testimonials lineButtom">
            <legend><?php echo JText::_('Testimonials'); ?></legend>
            <div class="content-testimonials">
				<a href="<?php echo JRoute::_('index.php?option=com_dtax&view=profiles&&layout=testimonials'); ?>" class="btn btn-xs">View All Testimonials</a>
				<?php //echo $item->testimonials ;?>
            </div>
        </div>
        
        
        <div class="prayfor lineButtom">
            <legend><?php echo JText::_('Praying For'); ?></legend>
            <?php echo @$item->prayerRequest->prayer_request; ?>
            <div class="clearfix clear"></div>
			<div class="bntRight">
				<a href="<?php echo JRoute::_('index.php?option=com_dtax&view=warriors&userid='. $item->userid); ?>" class="btn btn-xs">View All Praying For</a>
			</div>
		</div>
        
        <?php //if($item->account){ ?>
            <div class="bible">
                <legend><?php echo JText::_('Bible Study'); ?></legend>
                <div class="span3"><p class="key">Title</p><p class="val"><?php echo $item->bible->title; ?></p></div>
                <div class="span3"><p class="key">Category</p><p class="val"><?php echo $item->bible->category; ?></p></div>
                <div class="span3"><p class="key">Date</p><p class="val"><?php echo jSont::format($item->bible->created); ?></p></div>
                <div class="clearfix clear"></div>
                <div class="span12">
					<p class="key">Description</p>
					<div class="txtContent"><?php echo $item->bible->description; ?></div>
                    <p class="key">Documents</p>
                    <p><?php echo jSont::playAudio($item->bible->audio); ?></p>
                    <p class="key">Link</p>
                    <p><?php echo $item->bible->link; ?></p>
                </div>
                <div class="clearfix clear"></div>
				<div class="bntRight">
					<a href="<?php echo JRoute::_('index.php?option=com_dtax&view=bibles'); ?>" class="btn btn-xs">View All Bible Studies</a>
				</div>
			</div>

        <?php //} ?>
            
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
        <input type="hidden" name="option" value="com_dtax" />
        <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>
</div>