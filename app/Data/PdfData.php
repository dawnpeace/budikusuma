<?php


namespace App\Data;


use Illuminate\Contracts\Support\Arrayable;

class PdfData implements Arrayable
{
    private $name;

    private $docType;

    private $docId;

    private $cardNo;

    private $publishedAt;

    private $userName;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDocType()
    {
        return $this->docType;
    }

    /**
     * @param mixed $docType
     */
    public function setDocType($docType): void
    {
        $this->docType = $docType;
    }

    /**
     * @return mixed
     */
    public function getDocId()
    {
        return $this->docId;
    }

    /**
     * @param mixed $docId
     */
    public function setDocId($docId): void
    {
        $this->docId = $docId;
    }

    /**
     * @return mixed
     */
    public function getCardNo()
    {
        return $this->cardNo;
    }

    /**
     * @param mixed $cardNo
     */
    public function setCardNo($cardNo): void
    {
        $this->cardNo = $cardNo;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }


    public function toArray()
    {
        return [
            'name' => $this->name,
            'docType' => $this->docType,
            'docId' => $this->docId,
            'cardNo' => $this->cardNo,
            'publishedAt' => $this->publishedAt,
            'userName' => $this->userName
        ];
    }
}
