<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio_Contact;
use Illuminate\Http\Request;

class PortfolioContactController extends Controller
{
    public function index(Request $request)
    {
        $template = 'admin.formPortfolio.index';
        $query = Portfolio_Contact::query();

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    $information = $query
    ->latest()
    ->paginate(10)
    ->withQueryString();
        return view('admin.dashboard.layout', compact('template','information'));

    }

    public function show(Portfolio_Contact $formPortfolio)
    {
        if ($formPortfolio->status == 0) {
            $formPortfolio->update([
                'status' => 1
            ]);
        }
        $template = 'admin.formPortfolio.show';
        return view('admin.dashboard.layout',
            compact('template') + ['information' => $formPortfolio]
        );
    }
    
    public function destroy(Portfolio_Contact $formPortfolio)
    {
        $formPortfolio->delete();
        return redirect()->route('admin.formPortfolio.index')
                        ->with('success', 'Thông tin đã được xóa thành công.');
    }

    public function done(Portfolio_Contact $formPortfolio)
{
    $formPortfolio->update([
        'status' => 2 
    ]);

    return back()->with('success', 'Đã đánh dấu là đã xử lý');
}

//     public function updateStatus(ContactAdvice $form)
// {
//     $form->status = !$form->status;
//     $form->save();
//     return back()->with('success', 'Cập nhật trạng thái thành công!');
// }

}
