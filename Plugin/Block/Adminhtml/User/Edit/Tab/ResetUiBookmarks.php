<?php
declare(strict_types=1);

/**
 * Magenizr ResetUiBookmarks
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\ResetUiBookmarks\Plugin\Block\Adminhtml\User\Edit\Tab;

class ResetUiBookmarks
{

    /**
     * Add fieldset for reset ui bookmarks
     *
     * @param \Magento\User\Block\User\Edit\Tab\Main $subject
     * @param \Closure $proceed
     * @return mixed
     */
    public function aroundGetFormHtml(
        \Magento\User\Block\User\Edit\Tab\Main $subject,
        \Closure                               $proceed
    ) {
        $form = $subject->getForm();

        if (get_class($form) !== \Magento\Framework\Data\Form::class) {
            return $proceed();
        }

        $userId = 0;
        $fieldset = $form->getElement('base_fieldset');

        foreach ($fieldset->getElements() as $element) {

            if ($element->getId() === 'user_id') {
                $userId = $element->getValue();
                break;
            }
        }

        if ($userId === 0) {
            return $proceed();
        }
        
        $fieldset = $form->addFieldset('magenizr_resetuibookmarks', ['legend' => __('Bookmarks')]);

        $fieldset->addField(
            'reset_ui_bookmarks',
            'label',
            [
                'container_id' => 'reset_ui_bookmarks',
                'after_element_html' => $subject->getLayout()
                    ->getBlock('magenizr.resetuibookmarks.system.account')
                    ->setData('userId', $userId)
                    ->toHtml()
            ]
        );

        $subject->setForm($form);

        return $proceed();
    }
}
