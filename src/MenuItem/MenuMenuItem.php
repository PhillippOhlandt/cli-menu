<?php

namespace MikeyMike\CliMenu\MenuItem;

use MikeyMike\CliMenu\CliMenu;

/**
 * Class MenuItem
 * @author Michael Woodward <michael@wearejh.com>
 */
class MenuMenuItem implements MenuItemInterface
{
    use SelectableTrait;

    /**
     * @var CliMenu
     */
    private $parentMenu;

    /**
     * @var CliMenu
     */
    private $subMenu;

    /**
     * @param string $text
     * @param CliMenu $subMenu
     */
    public function __construct($text, CliMenu $subMenu)
    {
        $this->text    = $text;
        $this->subMenu = $subMenu;

        $this->subMenu->addAction(
            new SelectableItem('Go Back', [$this, 'showParentMenu'])
        );
    }

    /**
     * Execute the items callable if required
     *
     * @return callable
     */
    public function getSelectAction()
    {
        return [$this, 'showSubMenu'];
    }

    /**
     * Return the raw string of text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Display the sub menu
     * @param CliMenu $parentMenu
     */
    public function showSubMenu(CliMenu $parentMenu)
    {
        $this->parentMenu = $parentMenu;
        $this->subMenu->display();
    }

    /**
     * Display the parent menu
     */
    public function showParentMenu()
    {
        $this->parentMenu->display();
    }
}