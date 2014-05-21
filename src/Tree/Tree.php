<?php namespace CobwebInfo\Cobra5Sdk\Tree;

interface Tree {

  /**
   * Create a tree of all branches
   *
   * @param array $branches
   * @return Illuminate\Support\Collection
   */
  public function all(array $branches = []);

  /**
   * Create a tree of a single branch
   *
   * @param array $branches
   * @return CobwebInfo\Cobra5Sdk\Entity\Entity
   */
  public function branch($id, array $branches = []);

}
