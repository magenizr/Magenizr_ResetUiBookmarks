<?php
declare(strict_types=1);

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
        \Closure $proceed
    ) {
        $form = $subject->getForm();
        if (is_object($form)) {
            $fieldset = $form->getElement('base_fieldset');
            $userId = 0;

            foreach ($fieldset->getElements() as $element) {

                if ($element->getId() === 'user_id') {
                     $userId = $element->getValue();
                }
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
        }

        return $proceed();
    }
}
