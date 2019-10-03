<?php
namespace Snowdog\DevTest\Migration;
use Snowdog\DevTest\Core\Database;
use Snowdog\DevTest\Model\PageManager;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\DevTest\Model\WebsiteManager;
class Version4
{
    /**
     * @var Database|\PDO
     */
    private $database;
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var WebsiteManager
     */
    private $websiteManager;
    /**
     * @var PageManager
     */
    private $pageManager;
    public function __construct(
        Database $database,
        UserManager $userManager,
        WebsiteManager $websiteManager,
        PageManager $pageManager
    ) {
        $this->database = $database;
        $this->userManager = $userManager;
        $this->websiteManager = $websiteManager;
        $this->pageManager = $pageManager;
    }
    public function __invoke()
    {
        $this->changeWebsiteTable();
        // $this->addPageData();
    }
    private function changeWebsiteTable()
    {
        $createQuery = <<<SQL
ALTER TABLE `pages` ADD `time_visit_page` DATETIME NOT NULL AFTER `website_id`;
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL;
        $this->database->exec($createQuery);
    }
}