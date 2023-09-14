<?php

use CobwebInfo\Cobra5Sdk\Entity\Entity;

class EntityStub extends Entity
{

    protected $fillable = ['name', 'description', 'published', 'document_type'];

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

}
