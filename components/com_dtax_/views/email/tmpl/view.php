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
JHtml::_('behavior.modal', 'a.modal');
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar('view'); ?>
<script type="text/javascript">
            Joomla.submitbutton = function(task)
            {
                if (task == 'email.cancel') {
                    Joomla.submitform(task, document.getElementById('email-form'));
                }
                else{
                    
                    if (task != 'email.cancel' && document.formvalidator.isValid(document.id('email-form'))) {
                        
                        Joomla.submitform(task, document.getElementById('email-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }

</script>

<form action="<?php echo JRoute::_('index.php?option=com_dtax&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="email-form" class="form-validate">
    <div class="jsont form-horizontal row-fluid">
        <div class="clearfix fltlft">
                <div class="clearfix fltlft full">
                    <br />
                    <!-- <legend><?php echo JText::_('Email');?></legend> -->
                    <ul class="nav nav-tabs" id="myTabTabs">
                        <li class="active"><a  href="#emails" data-toggle="tab">Email</a></li>
                        <li class=""><a  href="#images" data-toggle="tab" >Images</a></li>         
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div id="emails" class="tab-pane active">
                            <div class="control-group">
                                <div class="control-label"> Taxpayer </div>
                                <div class="controls"> <?php echo $this->item->taxpayer; ?> </div>
                            </div>
                            <div class="control-group">
                                <div class="control-label"> Phone </div>
                                <div class="controls"> <?php echo $this->item->phone; ?> </div>
                            </div>  
                            <div class="control-group">
                                <div class="control-label"> Email </div>
                                <div class="controls"> <?php echo $this->item->email; ?> </div>
                            </div>  
                            <div class="control-group">
                                <div class="control-label"> Reason For Submission </div>
                                <div class="controls"> <?php echo $this->item->reason; ?> </div>
                            </div>  
                            <div class="control-group">
                                <div class="control-label"> Date Submit </div>
                                <div class="controls"> <?php echo JST::format($this->item->created); ?> </div>
                            </div>   
                        </div>
                        <div id="images" class="tab-pane">
                            <?php for($i=1; $i < 10; $i ++){ ?>
                                <?php if($img = $this->item->{'image'.$i}){ ?>
                                    <div class="img-item">
                                        <a class="modal" href="<?php echo JURI::root() . $img; ?>"  rel="{handler: 'iframe', size: {x:600, y:600}}">
                                            <img src="<?php echo JURI::root() . $img; ?>" />
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>
<?php echo JST::footer(); ?>