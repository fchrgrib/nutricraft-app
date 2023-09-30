<?php

class Meals extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('meals/index');
  }
}