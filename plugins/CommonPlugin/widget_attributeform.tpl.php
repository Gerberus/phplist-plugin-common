<?php
/**
 * CommonPlugin for phplist
 * 
 * This file is a part of CommonPlugin.
 *
 * @category  phplist
 * @package   CommonPlugin
 * @author    Duncan Cameron
 * @copyright 2011-2012 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */


/**
 * Template for the attribute search and select widget form
 */

/**
 *
 * Available fields
 * - $showSearch: whether to show the search fields
 * - $model: the model
 *        searchTerm: term to search on
 *        searchBy: attribute to search on 
 *        attributes: associative array of user attributes
 *        listID: selected list to filter
 *        lists: associative array of lists
 *        selectedAttrs: array of selected attributes
 *        unconfirmed: show only unconfirmed users
 *        blacklisted: show only blacklisted users
 */
?>
<style type="text/css">
div.inline {
    display: inline;
    white-space: nowrap
}
.inline label{
    display: inline;
}
input[type="text"], select {
    width: auto !important;
    display: inline !important;
}
</style>
<form method='post'>
    <fieldset>
        <?php if ($showSearch): ?>
        <div style='padding-bottom: 10px;'>
        <?php echo $this->i18n->get('Search for'); ?>:&nbsp;
            <input size="32" type="text" value="<?php echo htmlspecialchars($model->searchTerm); ?>" 
                name="SearchForm[searchTerm]" id="SearchForm_searchTerm" />
            <?php echo CHtml::dropDownList(
            'SearchForm[searchBy]', $model->searchTerm == '' ? 'email' : $model->searchBy,
            array('email' => 'email', 'id' => 'id', 'uniqid' => 'uniquid') + CHtml::listData($model->attributes, 'id', 'name')
            ); ?>&nbsp;
            <?php echo $this->i18n->get('List'); ?>:&nbsp;
            <?php echo CHtml::dropDownList(
                'SearchForm[listID]', $model->listID,
                CHtml::listData($model->lists, 'id', 'name'),
                array('prompt' => 'All')
            ); ?>
            <div class='inline'>
            <?php echo $this->i18n->get('Confirmed'); ?>:&nbsp;
            <?php echo CHtml::dropDownList(
                'SearchForm[confirmed]', $model->confirmed,
                $this->i18n->get(array(1 => 'All subscribers', 2 => 'confirmed only', 3 => 'unconfirmed only'))
            ); ?>

            <?php echo $this->i18n->get('Blacklisted'); ?>:&nbsp;
            <?php echo CHtml::dropDownList(
                'SearchForm[blacklisted]', $model->blacklisted,
                $this->i18n->get(array(1 => 'All subscribers', 2 => 'blacklisted only', 3 => 'not blacklisted only'))
            ); ?>
            </div>
        </div>
        <?php endif; ?>
        <div class='clear'></div>
        <div>
        <?php echo CHtml::checkBoxList(
            'SearchForm[selectedAttrs]',
            $model->selectedAttrs,
             CHtml::listData($model->attributes, 'id', 'name'),
            array(
                'separator' => ' ', 'uncheckValue' => 0,
                'template' => '<div class="inline">{input} {label}</div>'
            )
        ); ?>
            <input type='submit' name='SearchForm[submit]' value='<?php echo $this->i18n->get('Show'); ?>' />
        </div>
    </fieldset>
</form>
