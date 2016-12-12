<?php
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php if (isset($row->_field_data['nid']['entity']->field_custom_price['und'][0]['value']) && $row->_field_data['nid']['entity']->field_custom_price['und'][0]['value'] == 1): ?>
<?php print $row->_field_data['nid']['entity']->field_valgfrit_pris['und'][0]['value']; ?>
<?php elseif (!isset($output)): ?>
  <?php $price = t('Free registration'); ?>
<?php elseif (intval($output) == -1 || intval($output) === 0): ?>
  <?php $price = t('Free'); ?>
<?php else: ?>
  <?php $price = intval($output) . ' kr.'; ?>
<?php endif; ?>

<?php print $price; ?>