<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model {

  protected $table      = 'checkouts';
  protected $primaryKey = 'checkout_id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $useSoftDeletes = false;

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;

  protected $allowedFields = ['book_id', 'book_title', 'member_id', 'member_name', 'created_at'];

  public function search($keyword) {
    return $this->table('checkouts')->like('book_title', $keyword)->orLike('member_name', $keyword);
  }

  public function getAllCheckouts() {
    return $this->orderBy('title', 'asc')->findAll();
  }

  public function getCheckoutsByBookId($bookId) {
    return $this->where(['book_id' => $bookId])->findAll();
  }

  public function getCheckoutsByMemberId($memberId) {
    return $this->where(['member_id' => $memberId])->findAll();
  }
}
