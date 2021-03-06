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
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canOrder = $user->authorise('core.edit.state', 'com_dtax');
$saveOrder = $listOrder == 'a.ordering';
?>
<?php echo JST::header(); ?>
<?php echo JST::toolbar('taxreturn', true); ?>
<<<<<<< HEAD
<?php echo JST::tabActive('taxreturns', 'Tax Return'); ?>
<form action="<?php echo JRoute::_('index.php?option=com_dtax&view=taxreturns'); ?>" method="post" name="adminForm" id="adminForm">
    
        <div id="j-main-container">

=======
<form action="<?php echo JRoute::_('index.php?option=com_dtax&view=taxreturns'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="jsContents form-horizontal row-fluid jscustom12">  
            <div id="j-main-container">
               <legend><?php echo JText::_('Tax Returns');?></legend>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
        <div id="filter-bar" class="btn-toolbar">
                <div class="filter-search btn-group pull-left">
                        <input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" class="hasTooltip" title="<?php echo JHtml::tooltipText('Search'); ?>" />
                </div>
<<<<<<< HEAD
            
=======
            <div class="btn-group pull-right hidden-phone">
                        <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
                        <?php echo $this->pagination->getLimitBox(); ?>
                    </div>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                <div class="btn-group pull-left">
                        <button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>"><span class="icon-search"></span></button>
                        <button type="button" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.getElementById('filter_search').value='';this.form.submit();"><span class="icon-remove"></span></button>
                </div>
        </div>
        <div class="clr"> </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th width="1%">
                    <?php echo JHtml::_('grid.checkall'); ?>
                </th>
                <!--
                                <th width="80" class='left'>
				<?php echo JHtml::_('grid.sort',  'Featured', 'a.featured', $listDirn, $listOrder); ?>
				</th>
             -->
                                <th class="left">
					<?php echo JHtml::_('grid.sort',  'Taxpayer', 'a.taxpayer', $listDirn, $listOrder); ?>
				</th>
                                
				<th class="left">
<<<<<<< HEAD
					<?php echo JHtml::_('grid.sort',  'Address', 'a.address', $listDirn, $listOrder); ?>
				</th>
				
=======
					<?php echo JHtml::_('grid.sort',  'Phone', 'a.phone', $listDirn, $listOrder); ?>
				</th>
				<th class="left">
					<?php echo JHtml::_('grid.sort',  'Email', 'a.email', $listDirn, $listOrder); ?>
				</th>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                <th class="left">
					<?php echo JHtml::_('grid.sort',  'Company', 'c.company', $listDirn, $listOrder); ?>
				</th>
				<th class="left">
<<<<<<< HEAD
					<?php echo JHtml::_('grid.sort',  'Employee', 'c.employee', $listDirn, $listOrder); ?>
=======
					<?php echo JHtml::_('grid.sort',  'CPA', 'c.cpa', $listDirn, $listOrder); ?>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
				</th>

                               
                                <th class="left">
					<?php echo JHtml::_('grid.sort',  'Date', 'a.created', $listDirn, $listOrder); ?>
				</th>
                                

                <?php if (isset($this->items[0]->id)) : ?>
                    <th width="1%" class="nowrap">
                        <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                <?php endif; ?>
            </tr>
        </thead>
        <tfoot>
            <?php
            if (isset($this->items[0])) {
                $colspan = count(get_object_vars($this->items[0]));
            } else {
                $colspan = 10;
            }
            ?>
            <tr>
                <td colspan="<?php echo $colspan ?>">
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            foreach ($this->items as $i => $item) :
                $ordering = ($listOrder == 'a.ordering');
                $canCreate = $user->authorise('core.create', 'com_dtax');
                $canEdit = $user->authorise('core.edit', 'com_dtax');
                $canCheckin = $user->authorise('core.manage', 'com_dtax');
                $canChange = $user->authorise('core.edit.state', 'com_dtax');
                ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td data-field="" class="center">
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                    </td>
<<<<<<< HEAD
                       
=======
                        <!--
                        <td>
                            <?php /* if($item->featured){ ?>
                                        <a href="#" onclick="return listItemTask('cb1','taxreturns.unfeatured')" title="Toggle to change article state to 'Unfeatured'"></a>
                                        <a href="#" onclick="return listItemTask('cb<?php echo $i; ?>','taxreturns.unfeatured')" class="btn btn-micro hasTooltip active" title="" data-original-title="Toggle featured status.">
                                            <span class="icon-featured"></span>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="#" onclick="return listItemTask('cb<?php echo $i; ?>','taxreturns.featured')" class="btn btn-micro hasTooltip" title="" data-original-title="Toggle featured status.">
                                            <span class="icon-unfeatured"></span>
                                        </a>
                                    <?php } */?>
                                </td>
                                -->
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                    
					<td data-field="Taxpayer">
					<?php if (isset($item->checked_out) && $item->checked_out) : ?>
						<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'taxreturns.', $canCheckin); ?>
					<?php endif; ?>
					<?php if ($canEdit): ?>
						<a href="<?php echo JRoute::_('index.php?option=com_dtax&task=taxreturn.edit&id=' . (int) $item->id); ?>">

							<?php echo $this->escape($item->taxpayer); ?>
						</a>
					<?php else: ?>
						<?php echo $this->escape($item->taxpayer); ?>
					<?php endif; ?>
					</td>

                                        
                                        
<<<<<<< HEAD
                                        <td data-field="Address">
						<?php echo $item->address; ?>
					</td>
                                        
                     
=======
                                        <td data-field="Phone">
						<?php echo $item->phone; ?>
					</td>
                                        
                                        <td data-field="Email">
						<?php echo $item->email; ?>
					</td>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                        
                                        <td data-field="Company">
						<?php echo $item->company; ?>
					</td>
                                        
<<<<<<< HEAD
                                        <td data-field="Employee">
						<?php echo $item->employee; ?>
=======
                                        <td data-field="CPA">
						<?php echo $item->cpa; ?>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
					</td>
                                        
                                      
                                        <td data-field="Date">
						<?php echo jSont::format($item->created); ?>
					</td>
                                  
                    <?php if (isset($this->items[0]->id)) { ?>
                        <td class="center" data-field="ID">
                            <?php echo (int) $item->id; ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
<<<<<<< HEAD
</form>
<?php echo JST::footer(); ?>
=======
         </div>
    </form>
<?php echo JST::footer(); ?>
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
