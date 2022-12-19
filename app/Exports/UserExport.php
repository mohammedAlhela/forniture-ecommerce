<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Http\Resources\UsersExportResource;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    protected $finalArray;

    public function __construct()
    {

    }

    public function collection()
    {
        return collect(UsersExportResource::collection(User::orderBy('created_at', 'DESC')->with(['permissions'])->get()));
    }

    public function headings(): array
    {
        return [
            'Admission',
            'Username',
            'Email',
            'Status',
            'Permissions',
            'Create time',
        ];
    }

    // ...

    /**
     * @return array
     */
    public function registerEvents(): array

    {

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont('arial')->setSize(16);
            },

        ];
    }
}
