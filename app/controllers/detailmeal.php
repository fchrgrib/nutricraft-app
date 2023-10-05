<?php

class Detailmeal extends Controller {
  public function index() {
      // Get the 'id' parameter from the URL
      if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Now, you can use the $id variable in your controller logic
        // For example, you can use it to fetch data for a specific meal

        // Load views and perform other actions based on the $id value
        $this->view('navbar/index');
        $this->view('detailmeal/index', ['id' => $id]);
    } else {
        // Handle the case where 'id' is not provided in the URL
        // You might want to display an error or redirect to a default page
    }
  }
}
