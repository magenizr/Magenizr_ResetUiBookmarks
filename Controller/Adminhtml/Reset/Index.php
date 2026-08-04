<?php
declare(strict_types=1);

/**
 * Magenizr ResetUiBookmarks
 * @copyright   Copyright (c) 2018 - 2024 Magenizr (https://magenizr.com.au)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\ResetUiBookmarks\Controller\Adminhtml\Reset;

use Magento\Framework\App\Action\HttpPostActionInterface;

class Index extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Magenizr_ResetUiBookmarks::reset';

    /**
     * @var \Magento\Ui\Api\Data\BookmarkInterfaceFactory
     */
    protected $bookmarkFactory;

    /**
     * @var \Magento\Ui\Model\ResourceModel\BookmarkRepository
     */
    protected $bookmarkRepository;

    /**
     * @var \Magento\User\Model\UserFactory
     */
    protected $userFactory;

    /**
     * Index constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory
     * @param \Magento\Ui\Model\ResourceModel\BookmarkRepository $bookmarkRepository
     * @param \Magento\User\Model\UserFactory $userFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context                $context,
        \Magento\Ui\Api\Data\BookmarkInterfaceFactory      $bookmarkFactory,
        \Magento\Ui\Model\ResourceModel\BookmarkRepository $bookmarkRepository,
        \Magento\User\Model\UserFactory                    $userFactory
    )
    {
        parent::__construct($context);

        $this->bookmarkFactory = $bookmarkFactory;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * Execute the controller.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $system = true;
        $params = $this->getRequest()->getParam('magenizr_resetuibookmarks');

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
            if (!is_array($params) || !isset($params['identifier'], $params['namespace'])) {
                $this->messageManager->addErrorMessage(__('Invalid request parameters.'));
                return $redirect;
            }

            $collection = $this->bookmarkFactory->create()->getCollection();
            $collection->addFieldToFilter('user_id', ['eq' => $userId]);

            switch ($params['identifier']) {
                case 'saved-only':
                    $collection->addFieldToFilter('identifier', ['like' => '_%']);
                    break;
                case 'saved-exclude':
                    $collection->addFieldToFilter('identifier', ['in' => ['current', 'default']]);
                    break;
            }

            switch ($params['namespace']) {
                case 'all':
                    $collection->addFieldToFilter('namespace', ['like' => '%']);
                    break;
                default:
                    $collection->addFieldToFilter('namespace', ['eq' => $params['namespace']]);
                    break;
            }

            $message = __('No UI Bookmarks found for user (%1).', $user->getEmail());

            if (!empty($collection->getItems())) {

                foreach ($collection->getItems() as $bookmark) {
                    $this->bookmarkRepository->deleteById($bookmark->getBookmarkId());
                }

                $message = __('The UI Bookmarks for user (%1) have been cleared successfully.', $user->getEmail());

                if ($system) {
                    $message = __('Your UI Bookmarks have been cleared successfully.');
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
