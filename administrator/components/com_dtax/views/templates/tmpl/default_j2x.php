<?php
/**
 * @version     1.0.0
 * @package     com_sigloaccmgr
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      SonNguyen <info@phpkungfu.club> - http://www.phpkungfu.club
 */


// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js',false,true);

$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
?>
<div class="sigloaccmgr">
    <form action="<?php echo JRoute::_('index.php?option=com_sigloaccmgr&view=templates'); ?>" method="post" name="adminForm" id="adminForm">
        <fieldset id="filter-bar">
            <div class="filter-search fltlft">
                <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
                <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('JSEARCH_FILTER'); ?>" />
                <button class="btn" type="submit"><i class="fa fa-search"></i> <?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
                <button class="btn" type="button" onclick="document.id('filter_search').value='';this.form.submit();"><i class="fa fa-times"></i> <?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
            </div>

            <div class='filter-select fltrt'>
                <select name="filter_published" class="inputbox" onchange="this.form.submit()">
                    <option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
                    <?php echo JHtml::_('select.options', $this->f_state, "value", "text", $this->state->get('filter.state'), true);?>
                </select>

                <select name="filter_category" class="inputbox" onchange="this.form.submit()">
                    <option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
                    <?php echo JHtml::_('select.options', $this->f_category, "value", "text", $this->state->get('filter.category'), true);?>
                </select>

                <select name="filter_owner" class="inputbox" onchange="this.form.submit()">
                    <option value=""><?php echo  JText::_('Select Client');?></option>
                    <?php echo JHtml::_('select.options', $this->f_owner, "value", "text", $this->state->get('filter.owner'), true);?>
                </select>
            </div>
        </fieldset>
        <div class="clr"> </div>

        <table class="table table-bordered adminlist">
            <thead>
            <tr>
                <th width="1%" class="hidden-phone">
                    <input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
                </th>
                <th width="5%">
                    <?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
                </th>
                <th class='left'>
                    <?php echo JHtml::_('grid.sort',  'Title', 'a.title', $listDirn, $listOrder); ?>
                </th>
    
                <th class='left'>
                    <?php echo JHtml::_('grid.sort',  'COM_SIGGLOACCMGR_CATEGORY', 'cat_title', $listDirn, $listOrder); ?>
                </th>
               
                <th class='left'>
                    <?php echo JHtml::_('grid.sort',  'Created', 'created_by', $listDirn, $listOrder); ?>
                </th>
                <th width="1%" class="nowrap center hidden-phone">
                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
                
            </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="11">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
              </tr>
            </tfoot>
            <tbody>
            <?php foreach ($this->items as $i => $item) :
                $ordering	= ($listOrder == 'a.ordering');
                $canCreate	= $user->authorise('core.create',		'com_jvsocial_publish');
                $canEdit	= $user->authorise('core.edit',			'com_jvsocial_publish');
                $canCheckin	= $user->authorise('core.manage',		'com_jvsocial_publish');
                $canChange	= $user->authorise('core.edit.state',	'com_jvsocial_publish');
                ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td class="center"><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
                    <td class="center">
                        <?php echo JHtml::_('jgrid.published', $item->state, $i, 'templates.', $canChange, 'cb'); ?>
                    </td>
                    <td>
                        <?php
                       
                        if ($canEdit) : ?>
                           
                            <div>
                                <a href="<?php echo JRoute::_('index.php?option=com_sigloaccmgr&task=template.edit&id='.(int) $item->id); ?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            </div>
                        <?php else : ?>
                            <?php echo $this->escape($item->title); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <a href="<?php echo JRoute::_('index.php?option=com_sigloaccmgr&task=category.edit&id='.(int) $item->catid); ?>" target="_blank">
                            <?php echo $item->cat_title; ?>
                        </a>
                    </td>
                    	<td>
                        <a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id='.(int) $item->created_by); ?>" target="_blank">
                            <?php echo $item->created_by_name; ?>
                        </a>
                    </td>
                    
                    <td class="center"><?php echo (int) $item->id; ?></td>
                    
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
            <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>