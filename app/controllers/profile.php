<?php

class Profile extends Controller {
  public function index() {
    $this->view('navbar/index');
    $this->view('profile/index');
  }
}