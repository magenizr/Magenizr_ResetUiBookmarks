<?php
declare(strict_types=1);

/**
 * Magenizr ResetUiBookmarks
 * @copyright   Copyright (c) 2018 - 2024 Magenizr (https://magenizr.com.au)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\ResetUiBookmarks\Plugin\Block\Adminhtml\User\Edit\Tab;

class ResetUiBookmarks
{

    /**
     * Add fieldset for reset ui bookmarks before the form html is rendered
     *
     * @param \Magento\User\Block\User\Edit\Tab\Main $subject
     * @return void
     */
    public function beforeGetFormHtml(
        \Magento\User\Block\User\Edit\Tab\Main $subject
    ) {
        $form = $subject->getForm();

        if (!$form instanceof \Magento\Framework\Data\Form) {
            return;
        }

        $userId = 0;
        $fieldset = $form->getElement('base_fieldset');

        foreach ($fieldset->getElements() as $element) {

            if ($element->getId() === 'user_id') {
                $userId = $element->getValue();
                break;
            }
        }

        $block = $subject->getLayout()->getBlock('magenizr.resetuibookmarks.system.account');

        if ($userId === 0 || !$block) {
            return;
        }

        $fieldset = $form->addFieldset('magenizr_resetuibookmarks', ['legend' => __('Bookmarks')]);

        $fieldset->addField(
            'reset_ui_bookmarks',
            'label',
            [
                'container_id' => 'reset_ui_bookmarks',
                'after_element_html' => $block
                    ->setData('userId', $userId)
                    ->toHtml()
            ]
        );

        $subject->setForm($form);
    }
}
