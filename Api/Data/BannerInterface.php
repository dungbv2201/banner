<?php

namespace Dungbv\Banner\Api\Data;

/**
 * CMS banner interface.
 * @api
 * @since 100.0.2
 */
interface BannerInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const BANNER_ID = 'id';
    const TITLE     = 'title';
    const CONTENT   = 'content';
    const STATUS    = 'status';
    /**#@-*/

    /**
     * @return string
     */
    public function name();
    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * status
     *
     * @return bool|null
     */
    public function getStatus();

    /**
     * Set ID
     *
     * @param int $id
     * @return BannerInterface
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param string $title
     * @return BannerInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     * @return BannerInterface
     */
    public function setContent($content);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return BannerInterface
     */
    public function setStatus($status);
}
