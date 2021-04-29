<?php
/**
 * Magenizr ResetUiBookmarks
 *
 * @category    Magenizr
 * @package     Magenizr_ResetUiBookmarks
 * @copyright   Copyright (c) 2018 - 2021 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\ResetUiBookmarks\Controller\Adminhtml\Reset;

class Index extends \Magento\Backend\App\Action
{

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory
     * @param \Magento\Ui\Model\ResourceModel\BookmarkRepository $bookmarkRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory,
        \Magento\Ui\Model\ResourceModel\BookmarkRepository $bookmarkRepository
    ) {
        parent::__construct($context);
        $this->request = $request;
        $this->bookmarkFactory = $bookmarkFactory;
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $userId = $this->_auth->getUser()->getId();

        try {
            $collection = $this->bookmarkFactory->create()->getCollection();
            $collection->addFieldToFilter('user_id', ['eq' => $userId]);

            switch ($this->request->getParam('identifier')) {
                case 'saved-only':
                    $collection->addFieldToFilter('identifier', ['like' => '_%']);
                    break;
                case 'saved-exclude':
                    $collection->addFieldToFilter('identifier', ['in' => ['current','default']]);
                    break;
            }

            foreach ($collection->getItems() as $bookmark) {
                $this->bookmarkRepository->deleteById($bookmark->getBookmarkId());
            }

            $this->messageManager->addSuccess(__('Your UI Bookmarks were cleared successfully.'));

            return $this->_redirect('adminhtml/system_account/index');
        } catch (\Exception $e) {
            $this->messageManager->addError(__('We were unable to submit your request. Please try again.'));

            return $this->_redirect('adminhtml/system_account/index');
        }
    }
}
