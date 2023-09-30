<?php

class Home extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('home/index');
  }
}