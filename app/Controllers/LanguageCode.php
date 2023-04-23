<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LanguageCodeModel;

class LanguageCode extends BaseController {

  protected $languageCodeModel;

  public function __construct() {
    $this->languageCodeModel = new LanguageCodeModel();
  }

  /**
   * Show all language codes
   */
  public function index() {

    $currentPage = $this->request->getVar('page_codes') ? $this->request->getVar('page_codes') : 1;

    // Search
    if ($this->request->getVar('keyword')) {
      $codes = $this->languageCodeModel->search($this->request->getVar('keyword'));
    } else {
      $codes = $this->languageCodeModel;
    }

    $data = [
      'tab' => 'codes',
      'currentPage' => $currentPage,
      'codes' => $codes->orderBy('language', 'asc')->paginate(20, 'codes'),
      'pager' => $codes->pager,
      'validation' => \Config\Services::validation()
    ];

    // Return view
    return view('/languagecodes/index', $data);
  }
}
