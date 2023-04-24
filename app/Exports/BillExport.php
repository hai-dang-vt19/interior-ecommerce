<?php

namespace App\Exports;

use App\Models\bill;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Facades\Excel;

class BillExport implements FromCollection,ShouldAutoSize,WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Mã đơn',
            'Mã sản phẩm',
            'Tên sản phẩm',
            'Số lượng',
            'Giá tiền',
            'Tên khách',
            'Email',
            'Số điện thoại',
            'Hình thức thanh toán',
            'Phí dịch vụ',
            'Ngày tạo',
            'Ngân hàng',
            'Bank Code',
            'VNPAY Code',
            'Địa chỉ',
            'Tổng tiền',
            'Trạng thái'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'italic' => true, 'size' => 16]],
            // Styling a specific cell by coordinate.
            'A' => ['font' => ['italic' => true]],
            // 'D' => ['font'=> ['bold' => true]],
        ];
    }
    public function collection()
    {
        return bill::select(
            'id_bill',
            'id_product',
            'name_product',
            'amount',
            'price',
            'username',
            'email',
            'phone',
            'method',
            'price_service',
            'date_create',
            'bank',
            'code_bank',
            'code_vnpay',
            'address',
            'total',
            'status_product_bill'
        )->get();
    }
    public function export_excel_bill()
    {
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        return Excel::download(new BillExport(), 'Don_hang_'.$time->day.'_'.$time->month.'_'.$time->year.'.xlsx');
    }
}
