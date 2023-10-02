<?php

class Detailmeal extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('detailmeal/index');
  }
}