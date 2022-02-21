<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FileExport;
use App\Http\Requests\BatchImportRequest;
use App\Http\Requests\ImportFileRequest;
use App\Imports\BatchImport;
use App\Imports\DemotableImport;
use App\Models\batch;
use App\Models\demotable;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function Logout()
    {
        Auth::logout();
        return Redirect()->route('cover');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImportExport()
    {
        return view('dashboard');
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(ImportFileRequest $request)
    {
        Excel::import(new DemotableImport, $request->file('file')->store('temp'));

        $notifications = array(
            'message' => "File Imported Successfully",
            'alert-type' => "success"
        );
        return redirect()->route('wallet-list-import')->with($notifications);
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport($batch, $process)
    {
        // dd($process);
        $ext = '.xlsx';
        $rename_to = 'Sheet' . $batch . $ext;
        // dd($rename_to);
        return Excel::download(new FileExport, $rename_to);
    }

    public function fileImportBatch()
    {
        $count = demotable::groupBy('batch')->select('batch')->get();
        // dd($count);
        // $notifications = array(
        //     'message' => "File Imported Successfully",
        //     'alert-type' => "success"
        // );
        return view('batch', compact('count'));
    }

    public function wallet_list(BatchImportRequest $request)
    {
        // dd($request);
        Excel::import(new BatchImport($request->sheet), $request->file('file')->store('temp'));


        $notifications = array(
            'message' => "File Imported Successfully",
            'alert-type' => "success"
        );

        return redirect()->route('view-list')->with($notifications);
    }

    // for testing puposes only - delete in production
    public function view_list()
    {
        $obj = new demotable;
        $dataArr = $obj->getBatchCount();

        return view('demo', compact('dataArr'));
    }

    public function process_one($batch)
    {
        $data = batch::where('batch', '=', $batch)->get();
        $address_csv = [];
        foreach ($data as $value) {
            $temp = $value->address;
            // echo "'";
            // echo $temp;
            // echo "',";
            array_push($address_csv, $temp);
        }
       
        $data = demotable::whereIn('From_Address', $address_csv)->whereIn('To_Address', $address_csv);
        $data->whereNull('Status')->update(['Status' => 'Transfer']);
        if($data->get()->count()>0){
            demotable::where('batch', $batch)->update(['process_flag' => 1]);
            $notifications = array(
                'message' => "Process Completed Successfully",
                'alert-type' => "success"
            );
        }
        else{
            $notifications = array(
                'message' => "No Wallet Address Matches the Individual Wallet Addresses List",
                'alert-type' => "warning"
            );
        }

        return redirect()->route('view-list')->with($notifications);
    }

    public function process_two($batch)
    {
        $obj = new demotable;
        $dataArr = $obj->getUniqueAddress($batch);
        // dd($dataArr);
        demotable::where('batch', $batch)->update(['process_flag' => 2]);

        if ($dataArr->count() > 0) {
            $obj->markUniqueAddress($dataArr, $batch);
            $obj->markSwapAddress($batch);

            $notifications = array(
                'message' => "Process Completed Successfully",
                'alert-type' => "success"
            );
            return redirect()->route('view-list')->with($notifications);
        } else {
            $notifications = array(
                'message' => "No Match Found",
                'alert-type' => "warning"
            );
            return redirect()->route('view-list')->with($notifications);
        }
    }


    public function view_individual($batch)
    {
        $data = demotable::where('batch', '=', $batch)->get();
        // dd($data);
        return view('view-individual', compact('data'));
    }

    public function export_individual()
    {
    }


    public function layout()
    {
        dd();
    }
}