<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

class AddPaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $latest = App\Models\Payment::latest()->first();
        if($latest !== null){
            $latest_id = $latest->id+1;
        }else{
            $latest_id = 1;
        }
        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/american-express.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'American Express';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/banricompras.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Banricompras';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/credishop.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Credishop';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/diners.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Diners';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/elo.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Elo';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/good-card.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Goodcard';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/hipercard.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Hipercard';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/mastercard.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Mastercard';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/sorocred.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Sorocred';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/verdecard.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Verdecard';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/visa.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'credit';
        $payment->name = 'Visa';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/banricompras.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'debit';
        $payment->name = 'Banricompras';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/elo.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'debit';
        $payment->name = 'Elo';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/mastercard.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'debit';
        $payment->name = 'Mastercard';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/visa.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'debit';
        $payment->name = 'Visa';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/alelo.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Alelo Alimentação';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/alelo.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Alelo Refeição';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/american-express.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Cooper Card';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/credi_refeicao.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Credi Refeição';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/greencard.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Green Card';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/planvale.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Planvale';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/refeisul.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Refeisul';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/sodexo.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Sodexo';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/sodexo.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Sodexo Alimentação';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/ticket.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Ticket Restaurante';
        $payment->visible = true;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/up.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Up Brasil';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/valecard.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Vale Card';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/verocard.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Verocard';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/verocheque.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $latest_id = $latest_id+1;
        $payment->type = 'voucher';
        $payment->name = 'Verocheque';
        $payment->visible = false;

        $payment->save();

        $payment = new App\Models\Payment();
        $flag = __DIR__.'/../../resources/images/payment_flags/vr.png';
        $filePath = 'tenants/'.config('tenant.name') .'/payment_flags/'. basename($flag);
        Storage::disk('local')->put($filePath, file_get_contents($flag));
        $payment->flag = '/img/'.$filePath;
        $payment->position = $latest_id;
        $payment->type = 'voucher';
        $payment->name = 'Vr Smart';
        $payment->visible = false;

        $payment->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
