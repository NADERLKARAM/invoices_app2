<?php

namespace App\Http\Controllers;

use App\Models\invoices_details;
use Illuminate\Http\Request;

use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Storage;

use App\Models\invoices;

class InvoicesDetailsController extends Controller
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
    public function show($id)
    {
        $invoices = Invoices::where('id', $id)->first();
        $details =  invoices_details::where('id_Invoice', $id)->get();
        $attachments  = invoice_attachments::where('invoice_id', $id)->get();


        return view('invoices.show', compact('invoices','details','attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function get_file($invoice_number, $file_name)
    {
        $filePath = $invoice_number . '/' . $file_name;

        if (Storage::disk('public_uploads')->exists($filePath)) {
            $fileContents = Storage::disk('public_uploads')->get($filePath);
            return response()->download(storage_path('app/public_uploads/' . $filePath), $file_name);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }



    public function open_file($invoice_number,$file_name)

    {
        $filePath = $invoice_number . '/' . $file_name;

    if (Storage::disk('public_uploads')->exists($filePath)) {
        $fileContents = Storage::disk('public_uploads')->get($filePath);
        return response()->file(Storage::disk('public_uploads')->path($filePath));
    } else {
        return response()->json(['error' => 'File not found'], 404);
    }
    }
}