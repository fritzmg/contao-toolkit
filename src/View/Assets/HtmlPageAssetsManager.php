<?php

declare(strict_types=1);

namespace Netzmacht\Contao\Toolkit\View\Assets;

/**
 * Extended AssetsManager interface which also included body and head blocks
 */
interface HtmlPageAssetsManager extends AssetsManager
{
    /**
     * Add a named block to the body.
     *
     * If the block already exists, it get's overridden
     *
     * @param string $name The name of the block.
     * @param string $html The content of the block.
     *
     * @return HtmlPageAssetsManager
     */
    public function addToBody(string $name, string $html): self;

    /**
     * Append a block to the body.
     *
     * @param string $html The content of the block.
     *
     * @return HtmlPageAssetsManager
     */
    public function appendToBody(string $html): self;

    /**
     * Add a named block to the head.
     *
     * If the block already exists, it get's overridden
     *
     * @param string $name The name of the block.
     * @param string $html The content of the block.
     *
     * @return HtmlPageAssetsManager
     */
    public function addToHead(string $name, string $html): self;

    /**
     * Append a block to the head.
     *
     * @param string $html The content of the block.
     *
     * @return HtmlPageAssetsManager
     */
    public function appendToHead(string $html): self;
}
