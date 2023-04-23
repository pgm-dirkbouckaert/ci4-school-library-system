<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\CollectionModel;
use App\Models\PivotBookCollection;

class Collection extends BaseController {

  protected $collectionModel;
  protected $bookModel;
  protected $pivotBookCollection;

  public function __construct() {
    $this->collectionModel = new CollectionModel();
    $this->bookModel = new BookModel();
    $this->pivotBookCollection = new PivotBookCollection();
  }

  /**
   * Show all collections
   */
  public function index() {

    $currentPage = $this->request->getVar('page_collection') ? $this->request->getVar('page_collection') : 1;

    if ($this->request->getVar('keyword')) {
      $collection = $this->collectionModel->search($this->request->getVar('keyword'));
    } else {
      $collection = $this->collectionModel;
    }

    $collections = $collection->orderBy('name', 'asc')->paginate(10, 'collections');

    $data = [
      'collections' => $collections,
      'pager' => $collection->pager,
      'currentPage' => $currentPage,
      'tab' => 'collections',
      "baseUrl" => base_url(),
    ];

    return view('collections/index', $data);
  }


  /**
   * Show the details of a collection
   */
  public function showDetail($id) {

    // Get books in the collection
    $entries = $this->pivotBookCollection->where("collection_id", $id)->findAll();
    $books = [];
    foreach ($entries as $e) {
      array_push($books, $this->bookModel->getBook($e["book_id"]));
    }
    // Set data
    $data = [
      'tab' => 'collections',
      'collection' => $this->collectionModel->getCollection($id),
      'books' => $books,
      "baseUrl" => base_url(),
    ];
    // Show view
    return view('collections/detail', $data);
  }


  /**
   * Show the form to add a collection
   */
  public function showAdd() {
    $data = [
      'tab' => 'collections',
      'validation' => \Config\Services::validation(),
    ];
    return view('/collections/add', $data);
  }


  /**
   * Add a new collection
   */
  public function add() {

    // Validate input
    $validated = $this->validate([
      'name' => [
        'rules' => 'required|is_unique[collections.name]',
        'errors' => [
          'required' => lang("bib.nameIsRequired"),
          'is_unique' => lang("bib.nameisUnique"),
        ]
      ],
      'location' => [
        'rules' => 'required',
        'errors' => [
          'required' => lang("bib.isRequired"),
        ]
      ]
    ]);
    if (!$validated) {
      // return redirect()->to('/collections/add/')->withInput();
      $data = [
        'tab' => 'collections',
        'validation' => $this->validator,
        "input" => $this->request->getPost(),
      ];
      return view('/collections/add', $data);
    }

    // Save collection
    $this->collectionModel->save([
      'name' => trim($this->request->getVar('name')),
      'location' => trim($this->request->getVar('location')),
    ]);

    session()->setFlashdata(['msg' => 'Gegevens succesvol toegevoegd.', "type" => "success"]);
    // return redirect()->to('/collections');
    return redirect()->to('/collections/detail/' . $this->collectionModel->getInsertID());
  }


  /**
   * Show the form to edit name and location of a collection
   */
  public function showEdit($id) {
    $data = [
      'tab' => 'collections',
      'collection' => $this->collectionModel->getCollection($id),
      'validation' => \Config\Services::validation()
    ];
    return view('/collections/edit', $data);
  }


  /**
   * Save edited collection
   */
  public function edit($id) {

    // Validate input
    $validated = $this->validate([
      'name' => [
        'rules' => 'required|is_unique[collections.name]',
        'errors' => [
          'required' => lang("bib.nameIsRequired"),
          'is_unique' => lang("bib.nameisUnique"),
        ]
      ],
      'location' => [
        'rules' => 'required',
        'errors' => [
          'required' => lang("bib.isRequired"),
        ]
      ],
    ]);

    if (!$validated) {
      // return redirect()->back()->withInput()->with("validation", $this->validator);
      $data = [
        'tab' => 'collections',
        'collection' => $this->collectionModel->getCollection($id),
        'validation' => $this->validator
      ];
      return view('/collections/edit', $data);
    }

    // Save collection
    $this->collectionModel->update($id, [
      'name' => trim($this->request->getVar('name')),
      'location' => trim($this->request->getVar('location')),
    ]);

    session()->setFlashdata(['msg' => 'Gegevens succesvol toegevoegd.', "type" => "success"]);
    // return redirect()->to('/collections');
    return redirect()->to('/collections/detail/' . $id);
  }


  /**
   * Delete a collection
   */
  public function delete($id) {

    // Delete entries from pivot table
    $entries = $this->pivotBookCollection->where("collection_id", $id)->findAll();
    foreach ($entries as $e) {
      $this->pivotBookCollection->where(["book_id" => $e["book_id"], "collection_id" => $e["collection_id"]])->delete();
    }

    // Delete collection
    $this->collectionModel->delete($id);
    return redirect()->to('/collections');
  }


  /**
   * Show the form to add books to a collection
   */
  public function showAddBooks($id) {

    // Get the books that are currently part of the collection
    $entries = $this->pivotBookCollection->where("collection_id", $id)->findAll();
    $currentBookIds = [];
    foreach ($entries as $e) {
      array_push($currentBookIds, $e["book_id"]);
    }

    $data = [
      'tab' => 'collections',
      'collection' => $this->collectionModel->getCollection($id),
      'books' => $this->bookModel->getAllBooks(),
      'currentBookIds' => $currentBookIds,
      'validation' => \Config\Services::validation()
    ];
    return view('/collections/add-books', $data);
  }


  /**
   * Add/delete books to a collection
   */
  public function addBooks($collectionId) {

    // Get book ids from post
    if ($this->request->getVar("bookIds") === "") {
      $bookIds = [];
    } else {
      $bookIds = explode(",", $this->request->getVar("bookIds"));
    }

    // Set number of books that are in collection
    $this->collectionModel->update($collectionId, ["number_of_books" => count($bookIds)]);

    // Delete old entries
    $entries = $this->pivotBookCollection->where("collection_id", $collectionId)->findAll();
    foreach ($entries as $e) {
      $this->pivotBookCollection->where(["book_id" => $e["book_id"], "collection_id" => $e["collection_id"]])->delete();
    }

    // Add the books to the collection
    foreach ($bookIds as $book_id) {
      $this->pivotBookCollection->save([
        'book_id' => $book_id,
        'collection_id' => $collectionId,
      ]);
    }

    session()->setFlashdata(['msg' => 'Gegevens succesvol toegevoegd.', "type" => "success"]);
    return redirect()->to('/collections/detail/' . $collectionId);
  }
}
