<?php

class Addmeal extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('addmeal/index');
  }
}