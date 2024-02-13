<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAtachment;
use App\Models\Invoice;
use Illuminate\Http\Request;
use File;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = Invoice::where('id',$id)->first();
        $details  = InvoiceDetails::where('id_Invoice',$id)->get();
        $attachments  = InvoiceAtachment::where('invoice_id',$id)->get();
        return view ('invoices.invoicesdetails',compact('invoices','details','attachments'));
    }

    public function open_file($invoice_number,$file_name)
    {
        $url = url('Attachments').'/'.$invoice_number .'/'. $file_name ;
        return redirect($url);
    }


    public function get_file($invoice_number,$file_name)
    {
        $contents = url('Attachments').'/'.$invoice_number .'/'. $file_name ;
        return response()->download(public_path('Attachments'.'/'.$invoice_number.'/'.$file_name));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceDetails $invoiceDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoices = InvoiceAtachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
}
