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
     * @param \Magento\User\Model\UserFactory $userFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory,
        \Magento\Ui\Model\ResourceModel\BookmarkRepository $bookmarkRepository,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\User\Model\UserFactory $userFactory
    ) {
        parent::__construct($context);

        $this->bookmarkFactory = $bookmarkFactory;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->userFactory = $userFactory;
    }

    /**
     * Execute the controller.
     *
     * @return mixed
     */
    public function execute()
    {
        $system = true;
        $params = $this->request->getParam('magenizr_resetuibookmarks');

        $userId = $this->_auth->getUser()->getId();
        
        if (!empty($params['userId'])) {

            $system = false;
            $userId = $params['userId'];
        }

        $user = $this->userFactory->create()->load($userId);

        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('adminhtml/user/edit', ['user_id' => $userId]);

        if ($system) {
            $redirect->setPath('adminhtml/system_account/index');
        }

        try {
            $collection = $this->bookmarkFactory->create()->getCollection();
            $collection->addFieldToFilter('user_id', ['eq' => $userId]);

            switch ($params['identifier']) {
                case 'saved-only':
                    $collection->addFieldToFilter('identifier', ['like' => '_%']);
                    break;
                case 'saved-exclude':
                    $collection->addFieldToFilter('identifier', ['in' => ['current','default']]);
                    break;
            }

            $message = __('No UI Bookmarks found for user (%1).', $user->getEmail());

            if (!empty($collection->getItems())) {

                foreach ($collection->getItems() as $bookmark) {
                    $this->bookmarkRepository->deleteById($bookmark->getBookmarkId());
                }

                $message = __('The UI Bookmarks for user (%1) have been cleared successfully.', $user->getEmail());

                if ($system) {
                    $message = __('Your UI Bookmarks were cleared successfully.');
                }
            }

            $this->messageManager->addSuccessMessage($message);

            return $redirect;
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('We were unable to submit your request. Please try again.'));

            return $redirect;
        }
    }
}
