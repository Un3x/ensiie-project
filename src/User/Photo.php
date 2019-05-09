<?php
namespace User;

class Photo
{
    /**
     * @var int
     */
    private $id_photo;

    /**
     * @var string
     */
    private $extension;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_photo;
    }

    /**
     */
    public function setId($id)
    {
        $this->id_photo= $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getExt()
    {
        return $this->extension;
    }

    /**

     */
    public function setExt($ext)
    {
        $this->extension = $ext;
        return $this;
    }

    public function getPath(){
        return "public/uploads/".$this->getId().".".$this->extension;
    }

}

?>
