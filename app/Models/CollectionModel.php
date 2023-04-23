<?php

namespace App\Models;

use CodeIgniter\Model;

class CollectionModel extends Model {

  protected $table      = 'collections';
  protected $primaryKey = 'collection_id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $useSoftDeletes = false;

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;

  protected $allowedFields = ['collection_id', 'name', 'location', 'number_of_books', 'created_at'];


  public function search($keyword) {
    return $this->table('collections')->like('name', $keyword)->orLike('location', $keyword)->orderBy('name', 'asc');
  }


  public function getCollection($id = false) {
    if ($id == false) {
      return $this->orderBy('name', 'asc')->findAll();
    }
    return $this->where(['collection_id' => $id])->first();
  }


  public function getAllCollections() {
    return $this->orderBy('name', 'asc')->findAll();
  }
}
