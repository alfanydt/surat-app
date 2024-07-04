<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Letter;
use App\Models\Sender;
// use App\Traits\PDF;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{
    // use PDF;

    public function index()
    {
        // $letters = Letter::all();
        // $departments = Department::all();
        // $senders = Sender::all();

        // return view('letters.index', compact('letters', 'departments', 'senders'));
    }
    public function lembur()
    {
        // masih belum bisa
        return view('pages.admin.letter.lembur');
    }
    public function create()
    {
        $departments = Department::all();
        $senders = Sender::all();

        return view('pages.admin.letter.create',[
            'departments' => $departments,
            'senders' => $senders,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_date' => 'required',
            'date_received' => 'required',
            'regarding' => 'required',
            'department_id' => 'required',
            'sender_id' => 'required',
            'letter_file' => 'required|mimes:pdf|file',
            'letter_type' => 'required',
        ]);

        if($request->file('letter_file')){
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }

        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        Letter::create($validatedData);

        return redirect()
                    ->route($redirect)
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
        
        // $validated = $request->validate([
        //     'letter_date' => 'required|date',
        //     'to' => 'required|string|max:255',
        //     'sender_name' => 'required|string|max:255',
        //     'sender_position' => 'required|string|max:255',
        //     'letter_body' => 'required|string',
        //     'approval' => 'required|string|max:255',
        //     'approval_position' => 'required|string|max:255',
        //     'file' => 'nullable|file|mimes:pdf|max:2048',
        // ]);
    
        // $filePath = null;
        // if ($request->hasFile('file')) {
        //     $filePath = $request->file('file')->store('letters');
        // }
    
        // $letter = Letter::create([
        //     'letter_date' => $validated['letter_date'],
        //     'to' => $validated['to'],
        //     'sender_name' => $validated['sender_name'],
        //     'sender_position' => $validated['sender_position'],
        //     'letter_body' => $validated['letter_body'],
        //     'approval' => $validated['approval'],
        //     'approval_position' => $validated['approval_position'],
        //     'file' => $filePath,
        // ]);
    
        // return redirect()->route('letter.preview', $letter->id);
        
    }

    public function incoming_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department','sender'])->where('letter_type', 'Surat Masuk')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        return view('pages.admin.letter.incoming');
    }

    //tambahan sementara
    // public function preview($id)
    // {
    //     $letter = Letter::findOrFail($id);
    //     return view('letter.preview', compact('letter'));
    // }

    // public function edit($id)
    // {
    //     $letter = Letter::findOrFail($id);
    //     return view('letter.edit', compact('letter'));
    // }

    public function outgoing_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department','sender'])->where('letter_type', 'Surat Keluar')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        return view('pages.admin.letter.outgoing');
    }

    public function show($id)
    {
        $item = Letter::with(['department','sender'])->findOrFail($id);

        return view('pages.admin.letter.show',[
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $item = Letter::findOrFail($id);
        $departments = Department::all();
        $senders = Sender::all();

        return view('pages.admin.letter.edit',[
            'departments' => $departments,
            'senders' => $senders,
            'item' => $item,
        ]);
    }

    public function download_letter($id)
    {
        $item = Letter::findOrFail($id);

        return Storage::download($item->letter_file);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_date' => 'required',
            'date_received' => 'required',
            'regarding' => 'required',
            'department_id' => 'required',
            'sender_id' => 'required',
            'disposisi' => 'required',
            'letter_file' => 'mimes:pdf|file',
            'letter_type' => 'required',
        ]);

        $item = Letter::findOrFail($id);

        if($request->file('letter_file')){
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }

        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        $item->update($validatedData);

        return redirect()
                    ->route($redirect)
                    ->with('success', 'Sukses! 1 Data Berhasil Diubah');
        
        
    //     $letter = Letter::findOrFail($id);

    // $validated = $request->validate([
    //     'letter_date' => 'required|date',
    //     'to' => 'required|string|max:255',
    //     'sender_name' => 'required|string|max:255',
    //     'sender_position' => 'required|string|max:255',
    //     'letter_body' => 'required|string',
    //     'approval' => 'required|string|max:255',
    //     'approval_position' => 'required|string|max:255',
    //     'file' => 'nullable|file|mimes:pdf|max:2048',
    // ]);

    // $filePath = $letter->file;
    // if ($request->hasFile('file')) {
    //     if ($filePath) {
    //         Storage::delete($filePath);
    //     }
    //     $filePath = $request->file('file')->store('letters');
    // }

    // $letter->update([
    //     'letter_date' => $validated['letter_date'],
    //     'to' => $validated['to'],
    //     'sender_name' => $validated['sender_name'],
    //     'sender_position' => $validated['sender_position'],
    //     'letter_body' => $validated['letter_body'],
    //     'approval' => $validated['approval'],
    //     'approval_position' => $validated['approval_position'],
    //     'file' => $filePath,
    // ]);

    // return redirect()->route('letter.preview', $letter->id);
    }

    public function destroy($id)
    {
        $item = Letter::findorFail($id);

        if ($item->letter_type == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        Storage::delete($item->letter_file);

        $item->delete();

        return redirect()
                    ->route($redirect)
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
    // use PDF;

    // public function download($id)
    // {
    //     $letter = Letter::findOrFail($id);
    //     $pdf = PDF::loadView('letter.pdf', compact('letter'));
    //     return $pdf->download('Surat_Permohonan_Upah_Lembur.pdf');
    // }

}

//     public function lembur()
//     {
//         if (request()->ajax()) {
//             $query = Letter::with(['department', 'sender'])->where('letter_type', 'Permohonan Upah Lembur')->latest()->get();

//             return DataTables::of($query)
//                 ->addColumn('action', function ($item) {
//                     return '
//                         <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
//                             <i class="fa fa-search-plus"></i> &nbsp; Detail
//                         </a>
//                         <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
//                             <i class="fas fa-edit"></i> &nbsp; Ubah
//                         </a>
//                         <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
//                             ' . method_field('delete') . csrf_field() . '
//                             <button class="btn btn-danger btn-xs">
//                                 <i class="far fa-trash-alt"></i> &nbsp; Hapus
//                             </button>
//                         </form>
//                     ';
//                 })
//                 ->editColumn('post_status', function ($item) {
//                     return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>' : '<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
//                 })
//                 ->addIndexColumn()
//                 ->removeColumn('id')
//                 ->rawColumns(['action', 'post_status'])
//                 ->make();
//         }

//         return view('pages.admin.letter.lembur');
//     }
// }



// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Department;
// use App\Models\Letter;
// use App\Models\Sender;
// use Yajra\DataTables\Facades\DataTables;
// use Illuminate\Support\Facades\Storage;
// use Barryvdh\DomPDF\Facade as PDF;

// class LetterController extends Controller
// {
//     public function index()
//     {
//         //
//     }

//     public function create()
//     {
//         $departments = Department::all();
//         $senders = Sender::all();

//         return view('pages.admin.letter.create', [
//             'departments' => $departments,
//             'senders' => $senders,
//         ]);
//     }

//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'letter_no' => 'required',
//             'letter_date' => 'required',
//             'date_received' => 'required',
//             'regarding' => 'required',
//             'department_id' => 'required',
//             'sender_id' => 'required',
//             'letter_file' => 'required|mimes:pdf|file',
//             'letter_type' => 'required',
//         ]);

//         if ($request->file('letter_file')) {
//             $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
//         }

//         $letter = Letter::create($validatedData);

//         return redirect()
//             ->route($letter->letter_type == 'Surat Masuk' ? 'surat-masuk' : 'surat-keluar')
//             ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
//     }

//     public function incoming_mail()
//     {
//         if (request()->ajax()) {
//             $query = Letter::with(['department', 'sender'])->where('letter_type', 'Surat Masuk')->latest()->get();

//             return Datatables::of($query)
//                 ->addColumn('action', function ($item) {
//                     return '
//                         <a href="' . route('letter.download', $item->id) . '" class="btn btn-primary btn-sm">Download</a>
//                     ';
//                 })
//                 ->rawColumns(['action'])
//                 ->make(true);
//         }

//         return view('pages.admin.letter.incoming');
//     }

//     public function outgoing_mail()
//     {
//         if (request()->ajax()) {
//             $query = Letter::with(['department','sender'])->where('letter_type', 'Surat Keluar')->latest()->get();

//             return Datatables::of($query)
//                 ->addColumn('action', function ($item) {
//                     return '
//                         <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
//                             <i class="fa fa-search-plus"></i> &nbsp; Detail
//                         </a>
//                         <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
//                             <i class="fas fa-edit"></i> &nbsp; Ubah
//                         </a>
//                         <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
//                             ' . method_field('delete') . csrf_field() . '
//                             <button class="btn btn-danger btn-xs">
//                                 <i class="far fa-trash-alt"></i> &nbsp; Hapus
//                             </button>
//                         </form>
//                     ';
//                 })
//                 ->editColumn('post_status', function ($item) {
//                    return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
//                 })
//                 ->addIndexColumn()
//                 ->removeColumn('id')
//                 ->rawColumns(['action','post_status'])
//                 ->make();
//         }

//         return view('pages.admin.letter.outgoing');
//     }

//     public function edit($id)
//     {
//         $item = Letter::findOrFail($id);
//         $departments = Department::all();
//         $senders = Sender::all();

//         return view('pages.admin.letter.edit', [
//             'departments' => $departments,
//             'senders' => $senders,
//             'item' => $item,
//         ]);
//     }

//     public function download_letter($id)
//     {
//         $letter = Letter::findOrFail($id);
//         $pdf = PDF::loadView('letters.pdf', compact('letter'));
//         return $pdf->download('surat-' . $letter->letter_no . '.pdf');
//     }

//     public function update(Request $request, $id)
//     {
//         $validatedData = $request->validate([
//             'letter_no' => 'required',
//             'letter_date' => 'required',
//             'date_received' => 'required',
//             'regarding' => 'required',
//             'department_id' => 'required',
//             'sender_id' => 'required',
//             'letter_file' => 'mimes:pdf|file',
//             'letter_type' => 'required',
//         ]);

//         $item = Letter::findOrFail($id);

//         if ($request->file('letter_file')) {
//             $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
//         }

//         $item->update($validatedData);

//         return redirect()
//             ->route($item->letter_type == 'Surat Masuk' ? 'surat-masuk' : 'surat-keluar')
//             ->with('success', 'Sukses! 1 Data Berhasil Diubah');
//     }

//     public function destroy($id)
//     {
//         $item = Letter::findorFail($id);

//         Storage::delete($item->letter_file);
//         $item->delete();

//         return redirect()
//             ->route($item->letter_type == 'Surat Masuk' ? 'surat-masuk' : 'surat-keluar')
//             ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
//     }
// }

