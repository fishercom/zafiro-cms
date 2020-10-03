<?php
namespace App\Util;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BladeExport implements FromView
{

    private $data;
    private $view;
    private $iso;

    public function __construct($data, $view, $iso='es')
    {
        $this->data = $data;
        $this->view = $view;
        $this->iso = $iso;
    }

    public function view(): View
    {
        return view($this->view, [
            'data' => $this->data,
            'iso' => $this->iso
        ]);
    }
}