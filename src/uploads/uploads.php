<?php

class Upload
{
    /**
     * @var int
     */
    private $id;

        /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $iduploader;

    /**
     * @var string
     */
    private $uploadpath;

    /**
     * @var string
     */
    private $uploadtype;

    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Upload
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Upload
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }    

    /**
     * @return string
     */
    public function getIdUploader()
    {
        return $this->iduploader;
    }

    /**
     * @param string $author
     * @return Upload
     */
    public function setIdUploader($iduploader)
    {
        $this->iduploader = $iduploader;
        return $this;
    }

    /**
     * @return string
     */
    public function getUploadPath()
    {
        $uploadpathdir = __DIR__.'/uploadedFiles/';
        $concate = $uploadpathdir . $this->uploadpath;
        return $concate;
    }

    /**
     * @param string $content
     * @return Upload
     */
    public function setUploadPath($uploadpath)
    {
        $this->uploadpath = $uploadpath;
        return $this;
    }

    /**
     * @return bool
     */
    public function getUploadType()
    {
        return $this->uploadtype;
    }

    /**
     * @param bool $solved
     * @return Upload
     */
    public function setUploadType($uploadtype)
    {
        $this->uploadtype = $uploadtype;
        return $this;
    }

    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

}
