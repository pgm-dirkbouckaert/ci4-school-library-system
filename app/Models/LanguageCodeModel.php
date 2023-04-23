<?php

namespace App\Models;

use CodeIgniter\Model;

class LanguageCodeModel extends Model {
  // protected $DBGroup          = 'default';
  protected $table            = 'language_codes';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  // protected $insertID         = 0;
  protected $returnType       = 'array';
  // protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['id', 'language', 'code_639_1', 'code_639_3', 'created_at'];

  // Dates
  // protected $useTimestamps = false;
  // protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';
  // protected $deletedField  = 'deleted_at';

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = [];
  protected $afterInsert    = [];
  protected $beforeUpdate   = [];
  protected $afterUpdate    = [];
  protected $beforeFind     = [];
  protected $afterFind      = [];
  protected $beforeDelete   = [];
  protected $afterDelete    = [];


  public function search($keyword) {
    return $this->table('language_codes')->like('language', $keyword)->orLike('code_639_1', $keyword)->orLike('code_639_3', $keyword)->orderBy('language', 'asc');
  }

  public function getAllCodes() {
    return $this->orderBy('language', 'asc')->findAll();
  }
}
