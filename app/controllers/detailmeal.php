<?php

class Detailmeal extends Controller {
  public function index() {
      // Get the 'id' parameter from the URL
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $this->view('navbar/index');
        $this->view('detailmeal/index', ['id' => $id]);
    } else {
       $this->view('navbar/index');
       $this->view('home/index');
    }
  }
}
