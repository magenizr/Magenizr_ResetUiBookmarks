<?php
declare(strict_types=1);

/**
 * Magenizr ResetUiBookmarks
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\ResetUiBookmarks\Block\System\Account;

class ResetUiBookmarks extends \Magento\Backend\Block\Template
{
    /**
     * @var \Magento\Ui\Api\Data\BookmarkInterfaceFactory
     */
    protected $bookmarkFactory;

    /**
     * Init Constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context       $context,
        \Magento\Ui\Api\Data\BookmarkInterfaceFactory $bookmarkFactory,
        array                                         $data = []
    )
    {
        parent::__construct($context, $data);
        $this->bookmarkFactory = $bookmarkFactory;
    }

    /**
     * Return a list of namespaces from table ui_bookmarks
     *
     * @return array
     */
    public function getNamespaceList()
    {
        $data = [];
        $items = $this->bookmarkFactory->create()
            ->getCollection()
            ->addFieldToSelect('namespace')
            ->addOrder('namespace', \Magento\Framework\DB\Select::SQL_DESC)
            ->getItems();

        if (!empty($items)) {
            foreach ($items as $item) {
                $data[$item->getData('namespace')] = ucwords(str_replace('_', ' ', $item->getData('namespace')));
            }
        }

        return $data;
    }
}
