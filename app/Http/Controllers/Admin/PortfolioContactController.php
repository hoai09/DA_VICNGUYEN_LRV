<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio_Contact;
use Illuminate\Http\Request;

class PortfolioContactController extends Controller
{
    //hiển thị ds và lọc theo trạng thái
    public function index(Request $request)
    {
        $template = 'admin.formPortfolio.index';
        $query = Portfolio_Contact::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $information = $query->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard.layout', compact('template', 'information'));
    }

    //hiển thị chi tiết
    public function show(Portfolio_Contact $formPortfolio)
    {
        if ($formPortfolio->status == 0) {
            $formPortfolio->update(['status' => 1]);
        }

        $template = 'admin.formPortfolio.show';
        $information = $formPortfolio;

        return view('admin.dashboard.layout', compact('template', 'information'));
    }

    //xoá
    public function destroy(Portfolio_Contact $formPortfolio)
    {
        $formPortfolio->delete();

        return redirect()
            ->route('admin.formPortfolio.index')
            ->with('success', 'Thông tin đã được xóa thành công.');
    }

    
    //Đánh dấu đã xử lý.
    
    public function done(Portfolio_Contact $formPortfolio)
    {
        $formPortfolio->update(['status' => 2]);

        return back()->with('success', 'Đã đánh dấu là đã xử lý');
    }
}
