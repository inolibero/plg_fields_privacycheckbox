<?php
/**
 * PrivacyCheckbox Plugin
 *
 * @copyright  Copyright (C) 2018 Tobias Zulauf All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License Version 2 or Later
 */

defined('_JEXEC') or die;

JLoader::import('components.com_fields.libraries.fieldsplugin', JPATH_ADMINISTRATOR);

/**
 * Fields Checkboxes Plugin
 *
 * @since  1.0.0
 */
class PlgFieldsPrivacyCheckbox extends FieldsPlugin
{
	/**
	 * Transforms the field into a DOM XML element and appends it as a child on the given parent.
	 *
	 * @param   stdClass    $field   The field.
	 * @param   DOMElement  $parent  The field node parent.
	 * @param   JForm       $form    The form.
	 *
	 * @return  DOMElement
	 *
	 * @since   1.0.0
	 */
	public function onCustomFieldsPrepareDom($field, DOMElement $parent, JForm $form)
	{
		$fieldNode = parent::onCustomFieldsPrepareDom($field, $parent, $form);

		if (!$fieldNode)
		{
			return $fieldNode;
		}

		$fieldNode->setAttribute('validate', 'options');

		$textValue = htmlspecialchars(strip_tags(JText::_($this->getTextValue($field)), '<a>'), ENT_COMPAT, 'UTF-8');

		$option = new DOMElement('option');
		$option->nodeValue = $textValue;
		$fieldNode->appendChild($option);

		return $fieldNode;
	}

	/**
	 * Returns an array of key values to put in a list from the given field.
	 *
	 * @param   stdClass  $field  The field.
	 *
	 * @return  string
	 *
	 * @since   1.0.0
	 */
	public function getTextValue($field)
	{
		// Fetch the options from the plugin
		$params = clone $this->params;
		$params->merge($field->fieldparams);

		return $params->get('textvalue', '');
	}
}
