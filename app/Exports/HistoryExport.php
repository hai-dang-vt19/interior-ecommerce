<?php

namespace App\Exports;

use App\Models\history;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Facades\Excel;

class HistoryExport implements FromCollection,ShouldAutoSize,WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID',
            'Hình thức',
            'Người dùng',
            'Nội dung',
            'Thời gian'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'italic' => true, 'size' => 13]],
            // Styling a specific cell by coordinate.
            'A' => ['font' => ['italic' => true]],
            // 'D' => ['font'=> ['bold' => true]],
        ];
    }
    public function collection()
    {
        return history::select(
            'id',
            'name_his',
            'user_his',
            'description_his',
            'created_at'
        )->get();
    }
    public function export_excel_history()
    {
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        return Excel::download(new HistoryExport(), 'History_'.$time->day.'_'.$time->month.'_'.$time->year.'.xlsx');
    }
}
