<?php namespace CobwebInfo\Cobra5Sdk\Entity;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

class Category extends Entity implements Arrayable, Jsonable
{

    /**
     * The attributes that can be filled
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'last_mod_date',
        'creation_date',
        'parent_id',
        'deleted',
        'api_last_update_time',
        'vyre_id',
        'document_count'
    ];

    /**
     * Create a new Category entity
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->fill($data);

        $this->relations = [
            'children' => new Collection,
            'documents' => new Collection
        ];
    }

    /**
     * Is the category deleted?
     *
     * @return bool
     */
    public function isDeleted()
    {
        return (bool)$this->attributes['deleted'];
    }

    /**
     * Get all of the category's children
     *
     * @return Illuminate\Support\Collection
     */
    public function children()
    {
        return $this->relations['children'];
    }

    /**
     * Add a child category
     *
     * @param CobwebInfo\Cobra5Sdk\Entity\Category
     * @return void
     */
    public function addChild(Category $category)
    {
        $this->relations['children']->put($category->id, $category);
    }

    /**
     * Check to see if the category has children
     *
     * @return bool
     */
    public function hasChildren()
    {
        return !$this->relations['children']->isEmpty();
    }

    /**
     * Get all of the documents for the category
     *
     * @return Illuminate\Support\Collection
     */
    public function documents()
    {
        return $this->relations['documents'];
    }

    /**
     * Add a new document to the category
     *
     * @param CobwebInfo\Cobra5Sdk\Entity\Document
     * @return void
     */
    public function addDocument(Document $document)
    {
        $this->relations['documents']->put($document->id, $document);
    }

}
