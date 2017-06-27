<?php namespace CobwebInfo\Cobra5Sdk\Tree;

use CobwebInfo\Cobra5Sdk\Cobra5;
use Illuminate\Support\Collection;
use CobwebInfo\Cobra5Sdk\Entity\Category;
use CobwebInfo\Cobra5Sdk\Entity\Datastore;

class DatastoreTree extends AbstractTree implements Tree
{

    /**
     * The Cobra5 instance
     *
     * @var CobwebInfo\Cobra5Sdk\Cobra5
     */
    protected $cobra5;

    /**
     * Create a new instance of the DatastoreTree
     *
     * @param CobwebInfo\Cobra5Sdk\Cobra5
     * @return void
     */
    public function __construct(Cobra5 $cobra5)
    {
        $this->cobra5 = $cobra5;
    }

    /**
     * Create a tree of all branches
     *
     * @param array $branches
     * @return Illuminate\Support\Collection
     */
    public function all(array $branches = [])
    {
        $datastores = $this->cobra5->getStores();

        foreach ($datastores as $datastore) {
            $datastore = $this->hydrateRoots($datastore);
        }

        if (in_array('categories', $branches)) {
            foreach ($datastores as $datastore) {
                $datastore = $this->hydrateParents($datastore);
            }

            foreach ($datastores as $datastore) {
                foreach ($datastore->categories() as $category) {
                    $category = $this->hydrateChildren($category);
                }
            }
        }

        if (in_array('documents', $branches)) {
            foreach ($datastores as $datastore) {
                foreach ($datastore->categories() as $category) {
                    $category = $this->hydrateDocuments($category);
                }
            }
        }

        return $datastores;
    }

    /**
     * Create a tree of a single branch
     *
     * @param array $branches
     * @return CobwebInfo\Cobra5Sdk\Entity\Entity
     */
    public function branch($id, array $branches = [])
    {
        $datastore = $this->cobra5->getStore($id);

        $datastore = $this->hydrateRoots($datastore);

        if (in_array('categories', $branches)) {
            $datastore = $this->hydrateParents($datastore);

            foreach ($datastore->categories() as $category) {
                $category = $this->hydrateChildren($category);
            }
        }

        if (in_array('documents', $branches)) {
            foreach ($datastore->categories() as $category) {
                $category = $this->hydrateDocuments($category);
            }
        }

        return $datastore;
    }

}
