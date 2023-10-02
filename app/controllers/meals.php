<?php

class Meals extends Controller {
  public function index() {
    $data = $this->model('Meal')->FindAll();
    $this->view('navbar/index');
    $this->view('meals/index', $data);
  }
}