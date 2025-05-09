<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [
        'key',
        'value'
    ];

    protected $acceptable = [
        'name',
        'company_name',
        'pickup',
        'delivery',
        'payment_method_money',
        'cep',
        'address',
        'address_number',
        'address_complement',
        'district',
        'phone',
        'whatsapp_number',
        'google_map',
        'instagram',
        'facebook',
        'city',
        'state',
        'status',

        'logo',
        'logo_style',
        'header',

        'search_bar_background_color',
        'search_bar_text_color',
        'header_image_transparency',
        'background_image',
        'background_image_transparency',
        'header_color',
        'header_text_color',
        'top_color',
        'top_text_color',
        'background_color',
        'titles_text_color',
        'content_text_color',
        'prices_text_color',
        'logo_border_color',
        'logo_background_color',
        'footer_background_color',
        'payment_background_color',
        'payment_text_color',
        'schedule_background_color',
        'schedule_text_color',

        //seo
        'referral_referral',
        'referral_social',
        'referral_direct',
    ];

    static function setConfig($key, $value)
    {
        $param = self::where('key',$key)->first();
        if($value === true){
            $value = 'true';
        }elseif ($value === false){
            $value = 'false';
        }

        if(!$param){
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = (string)$value;
            $setting->save();
        }else{
            $param->update(['key' => $key, 'value' => (string)$value]);
        }
    }

    public function getCreatedAtAttribute($date = null)
    {
        if (!empty($date)) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
        }
    }
}
