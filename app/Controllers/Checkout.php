<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use App\Models\BookModel;
use App\Models\CollectionModel;
use App\Models\MemberModel;

class Checkout extends BaseController {

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
    $auth = service('authentication');
    $this->admin = $auth->user();
  }

  /**
   * Show all checkouts
   */
  public function index() {

    $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

    if ($this->request->getVar('keyword')) {
      $checkout = $this->checkoutModel->search($this->request->getVar('keyword'));
    } else {
      $checkout = $this->checkoutModel;
    }

    // dd($checkout);

    $checkouts = $checkout->paginate(10, 'checkouts');

    $data = [
      'checkouts' => $checkouts,
      'pager' => $checkout->pager,
      'currentPage' => $currentPage,
      'tab' => 'checkouts'
    ];
    return view('checkouts/index', $data);
  }
}
