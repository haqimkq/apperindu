<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    private $page = 'Dashboard';
    private $url = 'dashboard';
    private $path = 'Master/dashboard';

    public function __construct()
    {
    }

    public function index()
    {

        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;
        $data['path'] = $this->path;
        return view($this->path . '/view', $data);
    }
}