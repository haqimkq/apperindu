<?php

namespace App\Controllers;

class Template_rekomendasi extends BaseController
{
    private $page = 'Template Rekomendasi';
    private $url = 'template_rekomendasi';

    public function index()
    {
        $data['title'] = 'Data ' . $this->page;
        $data['page'] = $this->page;
        $data['url'] = $this->url;

        return view($this->url . '/view', $data);
    }
}