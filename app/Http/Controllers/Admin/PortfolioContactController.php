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
        $information = Portfolio_Contact::latest()->paginate(10);
        return view('admin.dashboard.layout', compact('template','information'));

    }

    public function show(Portfolio_Contact $formPortfolio)
    {
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

//     public function updateStatus(ContactAdvice $form)
// {
//     $form->status = !$form->status;
//     $form->save();
//     return back()->with('success', 'Cập nhật trạng thái thành công!');
// }

}
