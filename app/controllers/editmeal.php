<?php

class Editmeal extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('editmeal/index');
  }
}