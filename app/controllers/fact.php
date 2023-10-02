<?php

class Fact extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('fact/index');
  }
}