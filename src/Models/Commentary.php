<?php

namespace App\Models;

use DateTimeImmutable;

class Commentary extends Model
{
    private int $id;
    private string $author;
    private string $content;
    private DateTimeImmutable $created_at;
    private bool $is_valid;


    public function __construct()
    {
        $this->created_at = new DateTimeImmutable("now");
    }

    /**
     * Get the value of is_valid
     */
    public function getIs_valid()
    {
        return $this->is_valid;
    }

    /**
     * Set the value of is_valid
     *
     * @return  self
     */
    public function setIs_valid($is_valid)
    {
        $this->is_valid = $is_valid;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
