<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model {

  protected $table      = 'books';
  protected $primaryKey = 'book_id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $useSoftDeletes = false;

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;

  protected $allowedFields = ['book_id', 'title', 'authors', 'isbn', 'language_code', 'difficulty_level', 'publication_year', 'publisher', 'available', 'img', 'created_at'];


  public function search($keyword) {
    return $this->table('books')->like('title', $keyword)->orLike('authors', $keyword)->orLike('publisher', $keyword)->orLike('isbn', $keyword)->orderBy('title', 'asc');
  }


  public function getBook($id = false) {
    if ($id == false) {
      return $this->orderBy('title', 'asc')->findAll();
    }
    return $this->where(['book_id' => $id])->first();
  }


  public function getAllBooks() {
    return $this->orderBy('title', 'asc')->findAll();
  }


  public function getBookTitle($id) {
    $book = $this->where(['book_id' => $id])->first();
    return $book["title"];
  }
}
