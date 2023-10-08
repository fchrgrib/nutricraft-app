<?php

class Editfact extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('editfact/index');
  }
}