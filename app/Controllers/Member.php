<?php

namespace App\Controllers;

use Spatie\Image\Image;
use App\Models\MemberModel;
use App\Models\BookModel;
use App\Models\CollectionModel;
use App\Models\CheckoutModel;

class Member extends BaseController {

  protected $memberModel;
  protected $bookModel;
  protected $collectionModel;
  protected $checkoutModel;
  protected $admin;

  public function __construct() {
    $this->memberModel = new MemberModel();
    $this->bookModel = new BookModel();
    $this->collectionModel = new CollectionModel();
    $this->checkoutModel = new CheckoutModel();
    $auth = service('authentication');
    $this->admin = $auth->user();
  }

  /**
   * Show all members
   */
  public function index() {

    $currentPage = $this->request->getVar('page_member') ? $this->request->getVar('page_member') : 1;

    // Search
    if ($this->request->getVar('keyword')) {
      $member = $this->memberModel->search($this->request->getVar('keyword'));
    } else {
      $member = $this->memberModel;
    }

    // Set which status to show
    $showStatus = false;
    if ($this->request->getVar("showStatus")) {
      $showStatus = $this->request->getVar("showStatus");
    }

    // Set data
    $data = [
      'tab' => 'members',
      'members' => $member->orderBy('name', 'asc')->paginate(10, 'members'),
      'showStatus' => $showStatus,
      'pager' => $member->pager,
      'currentPage' => $currentPage,
      'baseUrl' => base_url(),
    ];

    return view('members/index', $data);
  }


  /**
   * Show the details of a member
   */
  public function showDetail($id) {

    $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

    // Get member
    $member = $this->memberModel->getMember($id);

    // Get current checkouts
    $checkouts = $this->checkoutModel->where("member_id", $id)->findAll();

    // Set data
    $data = [
      'tab' => 'members',
      'member' => $member,
      'checkouts' => $checkouts,
      'admin' => $this->admin,
      'currentPage' => $currentPage,
      'pager' => $this->memberModel->pager,
      'baseUrl' => base_url(),
    ];
    return view('members/detail', $data);
  }


  /**
   * Show the form to add a member
   */
  public function showAdd() {
    $data = [
      'tab' => 'members',
      'validation' => \Config\Services::validation()
    ];
    return view('members/add', $data);
  }


  /**
   * Add a new member
   */
  public function add() {
    // Validate input
    $validated = $this->validate([
      'name' => [
        'rules' => 'required',
      ],
      'email' => [
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
      // return redirect()->to('/member/add')->withInput();
      $data = [
        'tab' => 'members',
        'validation' => $this->validator,
        "input" => $this->request->getPost(),
      ];
      return view('members/add', $data);
    }

    // Get avatar
    $imgUpload = $this->request->getFile('img');
    if ($imgUpload->getError() == 4) {
      // Get default img if no image was provided
      $imgFilename = 'default_avatar.png';
    } else {
      // Generate random name
      $imgFilename =  $imgUpload->getRandomName();
      // Move file to img folder
      $imgUpload->move('public/images/avatars/', $imgFilename);
      // Optimize and resize image
      Image::load('public/images/avatars/' . $imgFilename)
        ->optimize()
        ->width(175)
        ->save();
    }

    // Save member
    $this->memberModel->save([
      'name' => $this->request->getVar('name'),
      'email' => $this->request->getVar('email'),
      'phone' => $this->request->getVar('phone'),
      'address' => $this->request->getVar('address'),
      'img' => $imgFilename,
    ]);
    session()->setFlashdata(['msg' => lang("bib.addedDataSuccesfully"), "type" => "success"]);
    // return redirect()->to('/members');
    return redirect()->to('/members/detail/' . $this->memberModel->getInsertID());
  }

  /**
   * Show the form to edit a member
   */
  public function showEdit($id) {
    $data = [
      'tab' => 'members',
      'member' => $this->memberModel->getMember($id),
      'validation' => \Config\Services::validation()
    ];
    return view('members/edit', $data);
  }


  /**
   * Edit member
   */
  public function edit($id) {
    // Validate input
    $validated = $this->validate([
      'name' => [
        'rules' => 'required',
        'errors' => [
          'required' => lang("bib.nameIsRequired")
        ]
      ],
      'status' => [
        'rules' => 'required',
        'errors' => [
          'required' => lang("bib.statusIsRequired")
        ]
      ],
      'email' => [
        'rules' => 'required',
        'errors' => [
          'required' => lang("bib.emailIsRequired")
        ]
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
      // return redirect()->to('/member/edit')->withInput();
      $data = [
        'tab' => 'members',
        'member' => $this->memberModel->getMember($id),
        'input' => $this->request->getPost(),
        'validation' => $this->validator,
      ];
      // dd($data);
      return view('members/edit', $data);
    }

    // Get data
    $data = [
      'name' => trim($this->request->getVar('name')),
      'status' => trim($this->request->getVar('status')),
      'email' => trim($this->request->getVar('email')),
      'phone' => trim($this->request->getVar('phone')),
      'address' => trim($this->request->getVar('address')),
    ];

    // Get avatar
    $imgUpload = $this->request->getFile('img');
    if (!$imgUpload->getError() == 4) {
      // Delete old image file
      $oldFilePath = $this->memberModel->getMember($id)["img"];
      if ($oldFilePath !== "default_avatar.png" && $oldFilePath !== "") unlink("public/images/avatars/" . $oldFilePath);
      // Generate random name
      $imgFilename =  $imgUpload->getRandomName();
      // Move file to img folder
      $imgUpload->move('public/images/avatars/', $imgFilename);
      // Optimize and resize image
      Image::load('public/images/avatars/' . $imgFilename)
        ->optimize()
        ->width(175)
        ->save();
      // Add img to data array
      $data["img"] = $imgFilename;
    }

    // Save member
    $this->memberModel->update($id, $data);
    session()->setFlashdata(['msg' => lang("bib.addedDataSuccesfully"), "type" => "success"]);
    return redirect()->to('/members/detail/' .  $id);
  }


  /**
   * Delete a member
   */
  public function delete($id) {
    // Delete avatar image file
    $member = $this->memberModel->getMember($id);
    if ($member && $member["img"] !== "default_avatar.png" && $member["img"] !== "") unlink('public/images/avatars/' . $member["img"]);
    // Delete all checkouts for member
    $this->checkoutModel->where("member_id", $id)->delete();
    // Delete member
    $this->memberModel->delete($id);
    return redirect()->to('/members');
  }


  /**
   * Show the page to manage checkouts 
   */
  public function showManageCheckouts($memberId) {

    // Get member
    $member = $this->memberModel->getMember($memberId);

    // Get current checkouts
    // $checkouts = $this->checkoutModel->where("member_id", $id)->findAll();
    $checkouts = $this->checkoutModel->getCheckoutsByMemberId($memberId);
    $checkedOutBookIds = [];
    foreach ($checkouts as $c) {
      array_push($checkedOutBookIds, $c["book_id"]);
    }

    // Set data
    $data = [
      'tab' => 'members',
      'books' => $this->bookModel->getAllBooks(),
      'member' => $member,
      'checkouts' => $checkouts,
      'checkedOutBookIds' => $checkedOutBookIds,
      // 'checkedOutBooks' => $checkedOutBooks,
      'validation' => \Config\Services::validation()
    ];

    return view('members/manage-checkouts', $data);
  }


  /**
   * Manage checkouts 
   */
  public function manageCheckouts($memberId) {

    // Get book ids from post
    if ($this->request->getVar("bookIds") === "") {
      $bookIds = [];
    } else {
      $bookIds = explode(",", $this->request->getVar("bookIds"));
    }

    // Set number of current checkouts for member
    $this->memberModel->update($memberId, ["current_checkouts" => count($bookIds)]);

    // Delete old checkouts
    $entries = $this->checkoutModel->where("member_id", $memberId)->findAll();
    foreach ($entries as $e) {
      $this->checkoutModel->where(["book_id" => $e["book_id"], "member_id" => $e["member_id"]])->delete();
      $this->bookModel->update($e["book_id"], ["available" => 1]);
    }

    // Add new checkouts
    if (count($bookIds) > 0) {
      foreach ($bookIds as $book_id) {
        $this->checkoutModel->save([
          'book_id' => $book_id,
          'book_title' => $this->bookModel->getBookTitle($book_id),
          'member_id' => $memberId,
          'member_name' => $this->memberModel->getMemberName($memberId),
        ]);
        $this->bookModel->update($book_id, ["available" => 0]);
      }
    }

    session()->setFlashdata(['msg' => 'Gegevens succesvol toegevoegd.', "type" => "success"]);
    return redirect()->to('/members/detail/' . $memberId);
  }
}
