<?php

namespace App\Controllers;

use Spatie\Image\Image;
use App\Models\BookModel;
use App\Models\CheckoutModel;
use App\Models\CollectionModel;
use App\Models\PivotBookCollection;

class Book extends BaseController {

  protected $bookModel;
  protected $checkoutModel;
  protected $collectionModel;
  protected $pivotBookCollection;

  public function __construct() {
    $this->bookModel = new BookModel();
    $this->checkoutModel = new CheckoutModel();
    $this->collectionModel = new CollectionModel();
    $this->pivotBookCollection = new PivotBookCollection();
  }

  /**
   * Show all books
   */
  public function index() {

    $currentPage = $this->request->getVar('page_book') ? $this->request->getVar('page_book') : 1;

    // Search
    if ($this->request->getVar('keyword')) {
      $book = $this->bookModel->search($this->request->getVar('keyword'));
    } else {
      $book = $this->bookModel;
    }

    // Set show available only
    $showAvailableOnly = false;
    if ($this->request->getVar("showAvailable") === "available-only") {
      $showAvailableOnly = true;
    }

    // Set data
    $data = [
      'books' => $book->orderBy('title', 'asc')->paginate(10, 'books'),
      'showAvailableOnly' => $showAvailableOnly,
      'pager' => $book->pager,
      'currentPage' => $currentPage,
      'tab' => 'books'
    ];
    return view('books/index', $data);
  }

  /**
   * Show the details of a book
   */
  public function showDetail($id) {
    // Get collections
    $entries = $this->pivotBookCollection->where("book_id", $id)->findAll();
    $collections = [];
    foreach ($entries as $e) {
      $coll = $this->collectionModel->getCollection($e["collection_id"]);
      array_push($collections, $coll);
    }
    // Set data
    $data = [
      'tab' => 'books',
      'book' => $this->bookModel->getBook($id),
      "collections" => $collections,
    ];
    // Return view
    return view('books/detail', $data);
  }


  /**
   * Show the form to add a book
   */
  public function showAdd() {
    $data = [
      'tab' => 'books',
      'validation' => \Config\Services::validation(),
    ];
    return view('books/add', $data);
  }


  /**
   * Add a new book
   */
  public function add() {

    // Validate input
    $validated = $this->validate([
      'title' => [
        'rules' => 'required',
      ],
      'authors' => [
        'rules' => 'required',
      ],
      'isbn' => [
        'rules' => 'required',
      ],
      'language-code' => [
        'rules' => 'required',
      ],
      'img' => [
        'rules' => 'max_size[img, 1024]|is_image[img]|mime_in[img,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => lang("bib.imgSizeTooBig"),
          'is_image' => lang("bib.isNotImage"),
          'mime_in' => lang("bib.isNotImage"),
        ]
      ],
    ]);
    if (!$validated) {
      // return redirect()->to('/books/add')->withInput();
      $data = [
        'tab' => 'books',
        'validation' => $this->validator,
        "input" => $this->request->getPost(),
      ];
      return view('books/add', $data);
    }

    // Get image
    $imgUpload = $this->request->getFile('img');
    if ($imgUpload->getError() == 4) {
      // Get default img if no image was provided
      $imgFilename = 'default_book.png';
    } else {
      // Generate random name
      $imgFilename =  $imgUpload->getRandomName();
      // Move file to img folder
      $imgUpload->move('public/images/books/', $imgFilename);
      // Optimize and resize image
      Image::load('public/images/books/' . $imgFilename)
        ->optimize()
        ->width(175)
        ->save();
    }

    // Save the book
    $this->bookModel->save([
      'title' => trim($this->request->getVar('title')),
      'authors' => trim($this->request->getVar('authors')),
      'isbn' => trim($this->request->getVar('isbn')),
      'language_code' => trim($this->request->getVar('language-code')),
      'difficulty_level' => trim($this->request->getVar('difficulty-level')),
      'publication_year' => trim($this->request->getVar('publication-year')),
      'publisher' => trim($this->request->getVar('publisher')),
      'img' => $imgFilename
    ]);
    session()->setFlashdata(['msg' => lang("bib.addedDataSuccesfully"), "type" => "success"]);
    // return redirect()->to('/books');
    return redirect()->to('/books/detail/' . $this->bookModel->getInsertID());
  }


  /**
   * Show the form to edit a book
   */
  public function showEdit($id) {
    $data = [
      'tab' => 'books',
      'book' => $this->bookModel->getBook($id),
      'validation' => \Config\Services::validation(),
    ];
    return view('books/edit', $data);
  }


  /**
   * Save the edited book
   */
  public function edit($id) {

    // Validate input
    if (!$this->validate([
      'title' => [
        'rules' => 'required',
      ],
      'authors' => [
        'rules' => 'required',
      ],
      'isbn' => [
        'rules' => 'required',
      ],
      'language-code' => [
        'rules' => 'required',
      ],
      'img' => [
        'rules' => 'max_size[img, 1024]|is_image[img]|mime_in[img,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => lang("bib.imgSizeTooBig"),
          'is_image' => lang("bib.isNotImage"),
          'mime_in' => lang("bib.isNotImage"),
        ]
      ],
    ])) {
      // return redirect()->to('/books/edit/' . $id)->withInput();
      $data = [
        'tab' => 'books',
        'book' => $this->bookModel->getBook($id),
        "input" => $this->request->getPost(),
        'validation' => $this->validator,
      ];
      return view('books/edit', $data);
    }

    $data = [
      'title' => trim($this->request->getVar('title')),
      'authors' => trim($this->request->getVar('authors')),
      'isbn' => trim($this->request->getVar('isbn')),
      'language_code' => trim($this->request->getVar('language-code')),
      'difficulty_level' => trim($this->request->getVar('difficulty-level')),
      'publication_year' => trim($this->request->getVar('publication-year')),
      'publisher' => trim($this->request->getVar('publisher')),
    ];

    // Get image
    $imgUpload = $this->request->getFile('img');
    if (!$imgUpload->getError() == 4) {
      // Delete old image file
      $oldFilePath = $this->bookModel->getBook($id)["img"];
      if ($oldFilePath !== "" && $oldFilePath !== "default_book.png") unlink("public/images/books/" . $oldFilePath);
      // Generate random name
      $imgFilename =  $imgUpload->getRandomName();
      // Move file to img folder
      $imgUpload->move('public/images/books/', $imgFilename);
      // Optimize and resize image
      Image::load('public/images/books/' . $imgFilename)
        ->optimize()
        ->width(175)
        ->save();
      // Add img to data array
      $data["img"] = $imgFilename;
    }

    // Save the book
    $this->bookModel->update($id, $data);
    session()->setFlashdata(['msg' => lang("bib.addedDataSuccesfully"), "type" => "success"]);
    // return redirect()->to('/books');
    return redirect()->to('/books/detail/' . $id);
  }


  /**
   * Show the confirmation page to delete a book
   */
  public function showDelete($id) {
    // Get collections
    $entries = $this->pivotBookCollection->where("book_id", $id)->findAll();
    $collections = [];
    foreach ($entries as $e) {
      $coll = $this->collectionModel->getCollection($e["collection_id"]);
      array_push($collections, $coll);
    }
    // Set data
    $data = [
      'tab' => 'books',
      'book' => $this->bookModel->getBook($id),
      "collections" => $collections,
    ];
    return view('books/delete', $data);
  }

  /**
   * Delete a book
   */
  public function delete($id) {

    // Delete entries from pivotBookCollection table (= remove book from collections)
    $entries = $this->pivotBookCollection->where("book_id", $id)->findAll();
    foreach ($entries as $e) {
      $this->pivotBookCollection->where(["book_id" => $e["book_id"], "collection_id" => $e["collection_id"]])->delete();
    }

    // Delete checkouts
    $entries = $this->checkoutModel->where("book_id", $id)->findAll();
    foreach ($entries as $e) {
      $this->checkoutModel->where(["book_id" => $e["book_id"]])->delete();
    }

    // Delete image file
    $book = $this->bookModel->getBook($id);
    if ($book && $book["img"] !== "default_book.png" && $book["img"] !== "") unlink('public/images/books/' . $book["img"]);

    // Delete book  
    $this->bookModel->delete($id);
    return redirect()->to('/books');
  }

  /**
   * Show the form to add a book to collections
   */
  public function showAddToCollections($bookId) {

    // Get the collections the book is currently part of
    $entries = $this->pivotBookCollection->where("book_id", $bookId)->findAll();
    $currentCollectionIds = [];
    foreach ($entries as $e) {
      array_push($currentCollectionIds, $e["collection_id"]);
    }

    $data = [
      'tab' => 'books',
      'book' => $this->bookModel->getBook($bookId),
      'collections' => $this->collectionModel->getAllCollections(),
      'currentCollectionIds' => $currentCollectionIds,
      'validation' => \Config\Services::validation()
    ];
    return view('/books/add-to-collections', $data);
  }


  /**
   * Add (or delete) a book to (from) collections
   */
  public function addToCollections($bookId) {

    // Get collection ids from post
    if ($this->request->getVar("collectionIds") === "") {
      $collectionIds = [];
    } else {
      $collectionIds = explode(",", $this->request->getVar("collectionIds"));
    }

    // Delete old entries
    $entries = $this->pivotBookCollection->where("book_id", $bookId)->findAll();
    foreach ($entries as $e) {
      $this->pivotBookCollection->where(["book_id" => $e["book_id"], "collection_id" => $e["collection_id"]])->delete();
    }

    // Add book to collections
    foreach ($collectionIds as $cid) {
      $this->pivotBookCollection->save([
        'book_id' => $bookId,
        'collection_id' => $cid,
      ]);
    }

    // Set number of books for each collection
    $allCollectionIds  = $this->collectionModel->findColumn("collection_id");
    foreach ($allCollectionIds as $cid) {
      $booksInCollection = $this->pivotBookCollection->where(['collection_id' => $cid])->findAll();
      $this->collectionModel->update($cid, ["number_of_books" => count($booksInCollection)]);
    }

    // Redirect
    session()->setFlashdata(['msg' => 'Gegevens succesvol toegevoegd.', "type" => "success"]);
    return redirect()->to('/books/detail/' . $bookId);
  }
}
