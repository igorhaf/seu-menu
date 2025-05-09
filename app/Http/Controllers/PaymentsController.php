<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments['credit'] = Payment::orderBy('position', 'ASC')->where('type','credit' )->get();
        $payments['debit'] = Payment::orderBy('position', 'ASC')->where('type','debit' )->get();
        $payments['voucher'] = Payment::orderBy('position', 'ASC')->where('type','voucher' )->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function store(Request $request){
        $this->validate($request,
            [
                'name_'.$request->get('type') => 'required',
            ],
            [
                'name_'.$request->get('type').'.required' => 'É preciso definir um nome para o tipo de pagamento',
            ]
        );
        $latest = Payment::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $payment = new Payment();
        $payment->name = $request->get('name_'.$request->get('type'));
        $payment->type = $request->get('type');
        $payment->position = $latest_id;
        $payment->save();
        return redirect(route('admin-payments'));
    }

    public function creditReposition(){
        if(Request::has('item'))
        {
            $i = 0;
            foreach(Request::get('item') as $id)
            {
                $i++;
                $item = \App\Payment::find($id);
                $item->position = $i;
                $item->save();
            }
            return Response::json(array('success' => true));
        }
        else
        {
            return Response::json(array('success' => false));
        }
    }

    public function debitReposition(){
        if(Request::has('item'))
        {
            $i = 0;
            foreach(Request::get('item') as $id)
            {
                $i++;
                $payment = \App\Payment::find($id);
                $payment->position = $i;
                $payment->save();
            }
            return Response::json(array('success' => true));
        }
        else
        {
            return Response::json(array('success' => false));
        }
    }

    public function voucherReposition(){
        if(Request::has('item'))
        {
            $i = 0;
            foreach(Request::get('item') as $id)
            {
                $i++;
                $payment = \App\Payment::find($id);
                $payment->position = $i;
                $payment->save();
            }
            return Response::json(array('success' => true));
        }
        else
        {
            return Response::json(array('success' => false));
        }
    }

    public function changeVisibility($id){
        $payment = Payment::find($id);
        if($payment->visible == true){
            $payment->visible = false;
        }else{
            $payment->visible = true;
        }
        $payment->save();
        return redirect(route('admin-payments'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $payment = Payment::find($request->get('id'));
        $payment->name = $request->get('name');
        $payment->type = $request->get('type');
        if ($request->hasFile('flag')) {
            $file = $request->file('flag');
            $name = time() . $file->getClientOriginalName();
            $filePath = '/payment_flags/' . $name;
            Storage::disk(config('filesystems.default'))->put($filePath, file_get_contents($file));
            $url = minio_url(Storage::disk(config('filesystems.default'))->url($filePath));
            $payment->flag = $url;
        }
        $payment->save();
        return redirect(route('admin-payments'));
    }

    public function updateAcceptMoney(Request $request){
        if($request->get('payment_method_money') == 'on'){
            Setting::setConfig('payment_method_money', 'true');
        }else{
            Setting::setConfig('payment_method_money', 'false');
        }
    }

    public function delete($id = null){
        $payment = Payment::where('id', $id)->first();
        $payment->delete();
        return redirect(route('admin-payments'));
    }
}
