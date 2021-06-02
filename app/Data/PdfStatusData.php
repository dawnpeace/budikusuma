<?php


namespace App\Data;


use Illuminate\Contracts\Support\Arrayable;

class PdfStatusData implements Arrayable
{

    private $name;

    private $createdAt;

    private $status = "Selesai";

    private $note;

    private $docType;

    /**
     * PdfStatusData constructor.
     */
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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note): void
    {
        $this->note = $note;
    }


    public function toArray()
    {
        return [
            "name" => $this->name,
            "createdAt" => $this->createdAt,
            "status" => $this->status,
            "note" => $this->note,
            "docType" => $this->docType
        ];
    }
}
