<?php
/**
 * @version     1.0.0
 * @package     com_dtax
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Joomlavi <info@joomlavi.com> - http://www.joomlavi.com
 */

defined('_JEXEC') or die;
$items = $this->items;
$itemid = JFactory::getApplication()->input->getInt('Itemid');
?>
<div id="DTaxContent">
    <div id="bibles-content">
        <?php echo jSont::showProfileHtml(); ?>
        <div class='bibles bodyContents'>
            <legend><?php echo JText::_('Bible Studies'); ?></legend>
            <p class="addnew bntTopRight"><a class="btn btn-xs" href="<?php echo JRoute::_('index.php?option=com_dtax&view=bible&layout=edit&Itemid='.$itemid); ?>"><?php echo JText::_('Add Bible Study'); ?></a></p>
            <form action="<?php echo JRoute::_('index.php?option=com_dtax&view=bibles&Itemid='.$itemid); ?>" method="post" name="adminForm" id="adminForm">
                <div id="j-main-container">
                    <div id="filter-bar" class="btn-toolbar">
                            <div class="filter-search btn-group pull-left">
                                    <input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" class="hasTooltip" title="<?php echo JHtml::tooltipText('Search'); ?>" />
                            </div>
                            <div class="filter-search btn-group pull-left">
                                <?php echo JHTML::_('select.genericlist', jSont::getOptionCategory('categories_bible'),'category', 'class="inputbox" ', 'value', 'text'); ?>
                            </div>
                            <div class="btn-group pull-left btn_right">
                                    <button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>"><span class="icon-search"></span></button>
                                    <button type="button" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.getElementById('filter_search').value='';this.form.submit();"><span class="icon-remove"></span></button>
                            </div>
                    </div>
                    <div class="clr"> </div>

                    <table class="table-prayer">
                        <thead>
                            <tr>
                                <th class="left"> <?php echo JText::_( 'Title'); ?> </th>
                                <th class="left"> <?php echo JText::_( 'Category'); ?> </th>
                                <th class="left"> <?php echo JText::_( 'Documents'); ?> </th>
                                <th class="left"> <?php echo JText::_( 'Recording'); ?> </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>  <td colspan="4"> <?php echo $this->pagination->getListFooter(); ?> </td> </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($this->items as $i => $item) : ?>
                                <tr class="row<?php echo $i % 2; ?> lineButtom">
                                    <td data-field="Title">
                                        <a href="<?php echo JRoute::_('index.php?option=com_dtax&view=bible&layout=view&id=' . (int) $item->id . '&Itemid='.$itemid); ?>">
                                                <?php echo $item->title; ?>
                                        </a>
                                    </td>
                                    <td data-field="Category"> <?php echo $item->category; ?> </td>
                                    <td data-field="Documents"> <?php echo $item->link; ?>  </td>
                                    <td data-field="Recording"> <?php echo jSont::playAudio($item->audio); ?> </td>           
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                <div>
                    <input type="hidden" name="task" value="" />
                    <input type="hidden" name="boxchecked" value="0" />
                    <?php echo JHtml::_('form.token'); ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo jSont::footer(); ?>