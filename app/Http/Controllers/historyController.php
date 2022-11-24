<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\history;

class historyController extends Controller
{
    public function destroy_all_history()
    {
        history::truncate();
        session()->flash('history_ds_all', 'Làm mới thành công');
        return back();
    }
}
