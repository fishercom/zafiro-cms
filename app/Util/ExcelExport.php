<?php
namespace App\Util;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelExport implements FromView
{

    private $data;
    private $view;

    public function __construct($data, $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    public function view(): View
    {
        return view($this->view, [
            'data' => $this->data,
        ]);
    }
}
