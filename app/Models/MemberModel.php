<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model {

  protected $table      = 'members';
  protected $primaryKey = 'member_id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $useSoftDeletes = false;


  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;

  protected $allowedFields = ['member_id', 'status', 'name', 'email', 'phone', 'address', 'current_checkouts', 'img', 'created_at'];


  public function search($keyword) {
    return $this->table('members')->like('name', $keyword)->orLike('member_id', $keyword)->orderBy('name', 'asc');
  }


  public function getAllMembers() {
    return $this->orderBy('name', 'asc')->findAll();
  }


  public function getMember($id = false) {
    if ($id == false) {
      return $this->orderBy('name', 'asc')->findAll();
    }
    return $this->where(['member_id' => $id])->first();
  }


  public function getMemberName($id) {
    $member = $this->where(['member_id' => $id])->first();
    return $member["name"];
  }
}
