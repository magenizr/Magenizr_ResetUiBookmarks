<?php
declare(strict_types=1);

/**
 * Magenizr ResetUiBookmarks
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\ResetUiBookmarks\Controller\Adminhtml\Reset;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Ui\Api\Data\BookmarkInterfaceFactory
     */
    protected $bookmarkFactory;

    /**
     * @var \Magento\Ui\Model\ResourceModel\BookmarkRepository
     */
    protected $bookmarkRepository;

    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;
    
    /**
     * Index constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory
     * @param \Magento\Ui\Model\ResourceModel\BookmarkRepository $bookmarkRepository
     * @param \Magento\Framework\Controller\ResultFactory $resultFactory
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory,
        \Magento\Ui\Model\ResourceModel\BookmarkRepository $bookmarkRepository,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\App\RequestInterface $request
    ) {
        parent::__construct($context);

        $this->bookmarkFactory = $bookmarkFactory;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->resultFactory = $resultFactory;
        $this->request = $request;
    }

    /**
     * Execute the controller.
     *
     * @return mixed
     */
    public function execute()
    {
        $userId = $this->_auth->getUser()->getId();

        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('adminhtml/system_account/index');

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

            $this->messageManager->addSuccessMessage(__('Your UI Bookmarks were cleared successfully.'));

            return $redirect;
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('We were unable to submit your request. Please try again.'));

            return $redirect;
        }
    }
}
