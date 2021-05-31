<?php

class Pages extends Controller
{

    public $data = [];

    public function index()
    {
        $arr = array();
        $this->view('index');
    }

}
