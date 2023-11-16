<?php

class Content extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('content/index');
  }
}