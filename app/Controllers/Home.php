<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\CheckoutModel;
use App\Models\BookModel;
use App\Models\CollectionModel;
use App\Models\MemberModel;

class Home extends BaseController {

  protected $checkoutModel;
  protected $bookModel;
  protected $collectionModel;
  protected $memberModel;
  protected $admin;

  public function __construct() {
    $this->checkoutModel = new CheckoutModel();
    $this->bookModel = new BookModel();
    $this->collectionModel = new CollectionModel();
    $this->memberModel = new MemberModel();
  }

  public function index() {
    $counts = array();
    $counts['books'] = $this->bookModel->countAllResults();
    $counts['members'] = $this->memberModel->countAllResults();
    $counts['checkouts'] = $this->checkoutModel->countAllResults();

    $data = [
      'counts' => $counts,
      'tab' => 'home'
    ];
    return view('index', $data);
  }

  public function admin() {
    return redirect("login");
  }
}
