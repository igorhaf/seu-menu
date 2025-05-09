<?php

namespace App\Http\Controllers;

use App\Models\DeliveryPoint;
use App\Models\ItemVariable;
use App\Models\OrderDelivery;
use App\Models\OrderProduct;
use App\Models\OrderProductAdditional;
use App\Models\OrderProductCombo;
use App\Models\OrderProductVariable;
use App\Models\OrderProductVariableOption;
use App\Models\Setting;
use PagSeguro;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use App\Models\Customer;
use App\Models\ImagesTemp;
use App\Models\ItemAdditional;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\VariableOption;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MenuWebController extends Controller
{
    public function index(Request $request)
    {
        $days_of_week = [
            1 =>
                [
                    0 => 'Segunda',
                    1 => Schedule::where('week_day', 1)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 1)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 1)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            2 =>
                [
                    0 => 'Terça',
                    1 => Schedule::where('week_day', 2)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 2)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 2)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            3 =>
                [
                    0 => 'Quarta',
                    1 => Schedule::where('week_day', 3)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 3)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 3)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            4 =>
                [
                    0 => 'Quinta',
                    1 => Schedule::where('week_day', 4)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 4)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 4)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            5 =>
                [
                    0 => 'Sexta',
                    1 => Schedule::where('week_day', 5)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 5)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 5)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            6 =>
                [
                    0 => 'Sábado',
                    1 => Schedule::where('week_day', 6)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 6)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 6)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            7 =>
                [
                    0 => 'Domingo',
                    1 => Schedule::where('week_day', 0)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 0)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 0)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ]
        ];
        $now_status = array();
        $now_status[0] = false;
        $now = date('H:m:i');

        foreach ($days_of_week[date('N')][3] as $schedule_day) {
            if (($now >= $schedule_day->start_time) && ($now <= $schedule_day->end_time)) {
                $now_status[0] = true;
                $now_status[1]['start_time'] = $schedule_day->start_time;
                $now_status[1]['end_time'] = $schedule_day->end_time;
            }

        }


        /*if(!empty($request->input('editor')) &&
            empty($request->input('logoStyle')) &&
            empty($request->input('transparencyBackground')) &&
            empty($request->input('transparencyHeaderImage')) &&
            empty($request->input('backgroundColorSearchBar')) &&
            empty($request->input('textColorSearchBar')) &&
            empty($request->input('headerColor')) &&
            empty($request->input('headerColorText')) &&
            empty($request->input('topColor')) &&
            empty($request->input('topColorText')) &&
            empty($request->input('backgroundColor')) &&
            empty($request->input('titleColorText')) &&
            empty($request->input('contentColorText')) &&
            empty($request->input('priceColorText')) &&
            empty($request->input('logoBorderColor')) &&
            empty($request->input('logoBackgroundColor')) &&
            empty($request->input('footerBackgroundColor')) &&
            empty($request->input('paymentBackgroundColor')) &&
            empty($request->input('paymentTextColor')) &&
            empty($request->input('scheduleBackgroundColor')) &&
            empty($request->input('scheduleTextColor')) &&
            empty($request->input('logoImage')) &&
            empty($request->input('backgroundImage')) &&
            empty($request->input('headerImage')) &&
            empty($request->input('preview'))
        ){
            $request->session()->forget('logoStyle');
            $request->session()->forget('transparencyBackground');
            $request->session()->forget('transparencyHeaderImage');
            $request->session()->forget('backgroundColorSearchBar');
            $request->session()->forget('textColorSearchBar');
            $request->session()->forget('headerColor');
            $request->session()->forget('headerColorText');
            $request->session()->forget('topColor');
            $request->session()->forget('topColorText');
            $request->session()->forget('backgroundColor');
            $request->session()->forget('titleColorText');
            $request->session()->forget('contentColorText');
            $request->session()->forget('priceColorText');
            $request->session()->forget('logoBorderColor');
            $request->session()->forget('logoBackgroundColor');
            $request->session()->forget('footerBackgroundColor');
            $request->session()->forget('paymentBackgroundColor');
            $request->session()->forget('paymentTextColor');
            $request->session()->forget('scheduleBackgroundColor');
            $request->session()->forget('scheduleTextColor');
            $request->session()->forget('logoImage');
            $request->session()->forget('backgroundImage');
            $request->session()->forget('headerImage');
            $imageTemp = ImagesTemp::where('type', 'background')->first();
            if(!empty($imageTemp)){
                $imageTemp->delete();
            }
            $imageTemp = ImagesTemp::where('type', 'logo')->first();
            if(!empty($imageTemp)){
                $imageTemp->delete();
            }
            $imageTemp = ImagesTemp::where('type', 'header')->first();
            if(!empty($imageTemp)){
                $imageTemp->delete();
            }
        }*/
        /*$editor = $request->input('editor');
        if (!empty($editor)) {
            $logoStyle = $request->input('logoStyle');
            if (!empty($logoStyle)) {
                $request->session()->put('logoStyle', $logoStyle);
            }
            if ($request->session()->exists('logoStyle')) {
                $tenant->logo_style = $request->session()->get('logoStyle');
            }

            $transparencyBackground = $request->input('transparencyBackground');
            if (!empty($transparencyBackground)) {
                $request->session()->put('transparencyBackground', $transparencyBackground);
            }
            if ($request->session()->exists('transparencyBackground')) {
                $tenant->background_image_transparency = $request->session()->get('transparencyBackground');
            }

            $backgroundColorSearchBar = $request->input('backgroundColorSearchBar');

            if (!empty($backgroundColorSearchBar)) {
                $request->session()->put('backgroundColorSearchBar', $backgroundColorSearchBar);
            }

            if ($request->session()->exists('backgroundColorSearchBar')) {
                $tenant->search_bar_background_color = $request->session()->get('backgroundColorSearchBar');
            }

            $textColorSearchBar = $request->input('textColorSearchBar');

            if (!empty($textColorSearchBar)) {
                $request->session()->put('textColorSearchBar', $textColorSearchBar);
            }

            if ($request->session()->exists('textColorSearchBar')) {
                $tenant->search_bar_text_color = $request->session()->get('textColorSearchBar');
            }

            $transparencyHeaderImage = $request->input('transparencyHeaderImage');

            if (!empty($transparencyHeaderImage)) {
                $request->session()->put('transparencyHeaderImage', $transparencyHeaderImage);
            }

            if ($request->session()->exists('transparencyHeaderImage')) {
                $tenant->header_image_transparency = $request->session()->get('transparencyHeaderImage');
            }

            $headerColor = $request->input('headerColor');
            if (!empty($headerColor)) {
                $request->session()->put('headerColor', $headerColor);
            }
            if ($request->session()->exists('headerColor')) {
                $tenant->header_color = $request->session()->get('headerColor');
            }

            $headerColorText = $request->input('headerColorText');
            if (!empty($headerColorText)) {
                $request->session()->put('headerColorText', $headerColorText);
            }
            if ($request->session()->exists('headerColorText')) {
                $tenant->header_text_color = $request->session()->get('headerColorText');
            }

            $topColor = $request->input('topColor');
            if (!empty($topColor)) {
                $request->session()->put('topColor', $topColor);
            }
            if ($request->session()->exists('topColor')) {
                $tenant->top_color = $request->session()->get('topColor');
            }

            $topColorText = $request->input('topColorText');
            if (!empty($topColorText)) {
                $request->session()->put('topColorText', $topColorText);
            }
            if ($request->session()->exists('topColorText')) {
                $tenant->top_text_color = $request->session()->get('topColorText');
            }

            $backgroundColor = $request->input('backgroundColor');
            if (!empty($backgroundColor)) {
                $request->session()->put('backgroundColor', $backgroundColor);
            }
            if ($request->session()->exists('backgroundColor')) {
                $tenant->background_color = $request->session()->get('backgroundColor');
            }

            $titleColorText = $request->input('titleColorText');
            if (!empty($titleColorText)) {
                $request->session()->put('titleColorText', $titleColorText);
            }
            if ($request->session()->exists('titleColorText')) {
                $tenant->titles_text_color = $request->session()->get('titleColorText');
            }

            $contentColorText = $request->input('contentColorText');
            if (!empty($contentColorText)) {
                $request->session()->put('contentColorText', $contentColorText);
            }
            if ($request->session()->exists('contentColorText')) {
                $tenant->content_text_color = $request->session()->get('contentColorText');
            }

            $priceColorText = $request->input('priceColorText');
            if (!empty($priceColorText)) {
                $request->session()->put('priceColorText', $priceColorText);
            }
            if ($request->session()->exists('priceColorText')) {
                $tenant->prices_text_color = $request->session()->get('priceColorText');
            }

            $logoBorderColor = $request->input('logoBorderColor');
            if (!empty($logoBorderColor)) {
                $request->session()->put('logoBorderColor', $logoBorderColor);
            }
            if ($request->session()->exists('logoBorderColor')) {
                $tenant->logo_border_color = $request->session()->get('logoBorderColor');
            }

            $logoBackgroundColor = $request->input('logoBackgroundColor');
            if (!empty($logoBackgroundColor)) {
                $request->session()->put('logoBackgroundColor', $logoBackgroundColor);
            }
            if ($request->session()->exists('logoBackgroundColor')) {
                $tenant->logo_background_color = $request->session()->get('logoBackgroundColor');
            }

            $footerBackgroundColor = $request->input('footerBackgroundColor');
            if (!empty($footerBackgroundColor)) {
                $request->session()->put('footerBackgroundColor', $footerBackgroundColor);
            }
            if ($request->session()->exists('footerBackgroundColor')) {
                $tenant->footer_background_color = $request->session()->get('footerBackgroundColor');
            }

            $paymentBackgroundColor = $request->input('paymentBackgroundColor');
            if (!empty($paymentBackgroundColor)) {
                $request->session()->put('paymentBackgroundColor', $paymentBackgroundColor);
            }
            if ($request->session()->exists('paymentBackgroundColor')) {
                $tenant->payment_background_color = $request->session()->get('paymentBackgroundColor');
            }

            $paymentTextColor = $request->input('paymentTextColor');

            if (!empty($paymentTextColor)) {
                $request->session()->put('paymentTextColor', $paymentTextColor);
            }
            if ($request->session()->exists('paymentTextColor')) {
                $tenant->payment_text_color = $request->session()->get('paymentTextColor');
            }

            //

            $scheduleBackgroundColor = $request->input('scheduleBackgroundColor');
            if (!empty($scheduleBackgroundColor)) {
                $request->session()->put('scheduleBackgroundColor', $scheduleBackgroundColor);
            }
            if ($request->session()->exists('scheduleBackgroundColor')) {
                $tenant->schedule_background_color = $request->session()->get('scheduleBackgroundColor');
            }

            $scheduleTextColor = $request->input('scheduleTextColor');
            if (!empty($scheduleTextColor)) {
                $request->session()->put('scheduleTextColor', $scheduleTextColor);
            }
            if ($request->session()->exists('scheduleTextColor')) {
                $tenant->schedule_text_color = $request->session()->get('scheduleTextColor');
            }

            $logoImage = $request->input('logoImage');
            if (!empty($logoImage)) {
                $request->session()->put('logoImage', $logoImage);
            }
            $imageTemp = ImagesTemp::where('type', 'logo')->first();

            if ($request->session()->exists('logoImage')) {
                $tenant->logo = $imageTemp->image;
            }else{
                if (!empty($imageTemp)) {
                    $imageTemp->delete();
                }
            }

            $backgroundImage = $request->input('backgroundImage');
            if (!empty($backgroundImage)) {
                $request->session()->put('backgroundImage', $backgroundImage);
            }

            if($request->get('backgroundImage') == 'false'){
                $request->session()->forget('backgroundImage');
                $tenant->background_image = null;
            }

            $imageTemp = ImagesTemp::where('type', 'background')->first();

            if ($request->session()->exists('backgroundImage')) {
                $tenant->background_image = $imageTemp->image;
            }else{
                if (!empty($imageTemp)) {
                    $imageTemp->delete();
                }
            }

            $headerImage = $request->input('headerImage');
            if (!empty($headerImage)) {
                $request->session()->put('headerImage', $headerImage);
            }

            if($request->get('headerImage') == 'false'){
                $request->session()->forget('headerImage');
                $tenant->header = null;
            }

            $imageTemp = ImagesTemp::where('type', 'header')->first();

            if ($request->session()->exists('headerImage')) {
                $tenant->header = $imageTemp->image;
            }else{
                if (!empty($imageTemp)) {
                    $imageTemp->delete();
                }
            }
        }*/


        /*if(!empty($_SERVER["HTTP_REFERER"])){
            $social = ['instagram', 'whatsapp', 'facebook'];
            if($this->strposa($_SERVER["HTTP_REFERER"], $social)){
                $settings->referral_social = $settings->referral_social + 1;
            }else{
                $settings->referral_referral = $settings->referral_referral + 1;
            }
        }else{
            $settings->referral_direct = (isset($settings->referral_direct))?$settings->referral_direct + 1:0;
        }*/
        //$editor = $request->input('editor');

        $categories = MenuCategory::where('visible', true)->get();
        $itens = MenuItem::where('visible', true)->get();
        $payments['credit'] = Payment::where('visible', true)->orderBy('position', 'ASC')->where('type', 'credit')->get();
        $payments['debit'] = Payment::where('visible', true)->orderBy('position', 'ASC')->where('type', 'debit')->get();
        $payments['voucher'] = Payment::where('visible', true)->orderBy('position', 'ASC')->where('type', 'voucher')->get();
        return view('menu-web.index', compact('itens', 'categories', 'payments', 'days_of_week', 'now_status'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        $customer_exists = Customer::where('email', $request->email)->first();
        if(!empty($customer_exists)){
            return redirect(route('web-home'))->with('error', 'Email já cadastrado.');
        }
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->cpf = $request->cpf;
        $customer->birthday = Carbon::createFromFormat('d/m/Y', $request->get('birthday'))->toDateString();
        $customer->cellphone = $request->get('cellphone');
        $customer->save();
        if (Auth::guard('customers')->attempt([
            'email' => $request->email,
            'password' => $request->password])
        ) {
            return redirect(route('web-home'))->with('info', 'Usuário registrado com sucesso.');
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('customers')->attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')])
        ) {
            return redirect(route('web-home'))->with('info', 'Login efetuado com sucesso.');
        }
        return redirect(route('web-home'))->with('error', 'Usuário ou senha não encontrado.');
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        return redirect(route('web-home'))->with('info', 'Logout efetuado com sucesso.');
    }

    public function resetRequest(Request $request)
    {
        $customer = Customer::where('email', $request->get('email'))->first();
        $token = Str::random(60);
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $customer->sendPasswordResetNotification($token);
        return redirect(route('web-home'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

        Customer::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        if (Auth::guard('customers')->attempt([
            'email' => $request->email,
            'password' => $request->password])
        ) {
            return redirect(route('web-home'));
        }
    }

    private function strposa($haystack, $needles = array(), $offset = 0)
    {
        $chr = array();
        foreach ($needles as $needle) {
            $res = strpos($haystack, $needle, $offset);
            if ($res !== false) $chr[$needle] = $res;
        }
        if (empty($chr)) return false;
        return min($chr);
    }

    public function product(Request $request, $id)
    {

        $days_of_week = [
            0 =>
                [
                    0 => 'Domingo',
                    1 => Schedule::where('week_day', 0)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 0)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 0)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            1 =>
                [
                    0 => 'Segunda',
                    1 => Schedule::where('week_day', 1)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 1)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 1)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            2 =>
                [
                    0 => 'Terça',
                    1 => Schedule::where('week_day', 2)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 2)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 2)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            3 =>
                [
                    0 => 'Quarta',
                    1 => Schedule::where('week_day', 3)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 3)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 3)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            4 =>
                [
                    0 => 'Quinta',
                    1 => Schedule::where('week_day', 4)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 4)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 4)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            5 =>
                [
                    0 => 'Sexta',
                    1 => Schedule::where('week_day', 5)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 5)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 5)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ],
            6 =>
                [
                    0 => 'Sábado',
                    1 => Schedule::where('week_day', 6)->where('status', true)->exists(),
                    2 => Schedule::where('week_day', 6)->where('status', true)->get(),
                    3 => Schedule::where('week_day', 6)->orderBy('start_time', 'ASC')->where('status', true)->get(),
                ]
        ];
        $now_status = array();
        $now_status[0] = false;
        $now = date('H:m:i');


        foreach ($days_of_week[date('N')][3] as $schedule_day) {
            if (($now >= $schedule_day->start_time) && ($now <= $schedule_day->end_time)) {
                $now_status[0] = true;
                $now_status[1]['start_time'] = $schedule_day->start_time;
                $now_status[1]['end_time'] = $schedule_day->end_time;
            }

        }


        /*if(!empty($_SERVER["HTTP_REFERER"])){
            $social = ['instagram', 'whatsapp', 'facebook'];
            if($this->strposa($_SERVER["HTTP_REFERER"], $social)){
                $tenant->referral_social = $tenant->referral_social + 1;
            }else{
                $tenant->referral_referral = $tenant->referral_referral + 1;
            }
        }else{
            $settings->referral_direct = $settings->referral_direct + 1;
        }
        $editor = $request->input('editor');
        if(empty($editor)) {
            $tenant->save();
        }*/
        $categories = MenuCategory::where('visible', true)->get();
        $payments['credit'] = Payment::where('visible', true)->orderBy('position', 'ASC')->where('type', 'credit')->get();
        $payments['debit'] = Payment::where('visible', true)->orderBy('position', 'ASC')->where('type', 'debit')->get();
        $payments['voucher'] = Payment::where('visible', true)->orderBy('position', 'ASC')->where('type', 'voucher')->get();
        return view('menu-web.product', ['categories' => $categories, 'payments' => $payments, 'days_of_week' => $days_of_week, 'now_status' => $now_status]);
    }

    public function addCart(Request $request)
    {
        //$userID = request()->session()->getId();
        if(!isset(Auth::guard('customers')->user()->id)){
            return redirect(route('web-home'))->with('warning', 'É necessário fazer o login primeiro.');
        }
        $userID = Auth::guard('customers')->user()->id;
        $product_data = array();
        $product_data['menu_item']['data'] = MenuItem::find($request->menu_item_id);
        $combo = array();
        if(!empty($request->combo_menu_item)){
            foreach($request->combo_menu_item as $key => $combo_menu_item){
                $menu_item = MenuItem::find($combo_menu_item);
                $combo[$key]['item_name'] = $menu_item->name;
                $combo[$key]['item_qtt'] = (int)$request->combo_qtt[$key];
                $combo[$key]['item_id'] = (int)$request->combo_menu_item[$key];
            }
        }

        \Cart::session($userID)->add(array(
            'id' => abs(crc32(uniqid())),
            'name' => $product_data['menu_item']['data']->name,
            'price' => $product_data['menu_item']['data']->price,
            'quantity' => $request->product_order_qtt,
            'attributes' => $combo,
            'associatedModel' => $product_data['menu_item']['data']
        ));
        if (!empty($request->variable)) {
            foreach ($request->variable as $key => $variable) {
                $product_data['menu_item']['variables'][$key]['data'] = ItemVariable::find($variable);
                $product_data['menu_item']['variables'][$key]['option']['data'] = VariableOption::where('item_variable_id', '=', $variable)->where('id', '=', $request->option[$key])->first();
            }
            foreach ($product_data['menu_item']['variables'] as $option) {
                \Cart::session($userID)->add(array(
                    'id' => abs(crc32(uniqid())),
                    'name' => $option['data']->variable . ' - ' . $option['option']['data']->option,
                    'price' => (!empty($option['option']['data']->increase_value)) ? $option['option']['data']->increase_value : ((!empty($option['option']['data']->decrease_value)) ? $option['option']['data']->decrease_value : 0.00),
                    'quantity' => 1*$request->product_order_qtt,
                    'attributes' => array(),
                    'associatedModel' => $option['option']['data']
                ));
            }
        }
        if (!empty($request->additional_item)) {

            foreach ($request->additional_item as $key => $additional_item) {
                if((int)$request->additional[$key] != 0) {
                    $additional = ItemAdditional::find($additional_item);
                    \Cart::session($userID)->add(array(
                        'id' => abs(crc32(uniqid())),
                        'name' => $additional->name,
                        'price' => (!empty($additional->increase_value)) ? $additional->increase_value : ((!empty($additional->decrease_value)) ? $additional->decrease_value : 0.00),
                        'quantity' => (int)$request->additional[$key]*$request->product_order_qtt,
                        'attributes' => array(),
                        'associatedModel' => $additional
                    ));
                }
            }
        }

        return redirect(route('web-home'))->with('info', 'Item adicionado com sucesso.');
    }

    public function cart()
    {
        if(!empty(\Cart::session(auth()->guard('customers')->user()->id)->getTotal())){
            $userID = Auth::guard('customers')->user()->id;
            $delivery_districts = DeliveryPoint::where('visible', true)->get();
            $payments = Payment::where('visible', true)->orderBy('position', 'ASC')->get();
            $itens = \Cart::session($userID)->getContent();
            return view('menu-web.cart', compact('itens', 'delivery_districts', 'payments'));
        }else{
            return redirect(route('web-home'));
        }

    }

    public function removeCart($id)
    {
        $userID = Auth::guard('customers')->user()->id;

        $items = \Cart::session($userID)->getContent();
        $var_to_delete = array();
        $add_to_delete = array();

        foreach($items as $row) {
            if($row->associatedModel->getTable() == 'menu_itens' && (int)$row->id == (int)$id){

                $variables = ItemVariable::where('menu_item_id', $row->associatedModel->id)->get();

                foreach($variables as $variable){
                    $var_to_delete[] = $variable->id;
                }

                $additionals = ItemAdditional::where('menu_item_id', $row->associatedModel->id)->get();

                foreach($additionals as $additional){
                    $add_to_delete[] = $additional->menu_item_id;
                }
                \Cart::session($userID)->remove($row->id);

            }
            if($row->associatedModel->getTable() == 'variable_options'){
                if((int)$row->id == (int)$id){
                    \Cart::session($userID)->remove($row->id);
                }
                if(!empty($var_to_delete)){
                    if(in_array($row->associatedModel->item_variable_id, $var_to_delete)){
                        \Cart::session($userID)->remove($row->id);
                    }
                }
            }

            if($row->associatedModel->getTable() == 'item_additionals'){
                if((int)$row->id == (int)$id){
                    \Cart::session($userID)->remove($row->id);
                }
                if(!empty($add_to_delete)){
                    if(in_array($row->associatedModel->menu_item_id, $add_to_delete)){
                        \Cart::session($userID)->remove($row->id);
                    }
                }
            }
        }
        return redirect(route('web-cart'));
    }

    private function getCart($user)
    {

        return \Cart::session($user->id)->getContent();
    }

    private function addToPagseguro($request, $user)
    {
        $itens = array();
        $i = 0;
        $itens_price = 0;



        foreach ($this->getCart($user) as $item_cart) {
            if($item_cart->price != 0.00) {
                $itens[$i]['itemId'] = $item_cart->id;
                $itens[$i]['itemDescription'] = $item_cart->name;
                $itens[$i]['itemAmount'] = $item_cart->price;
                $itens[$i]['itemQuantity'] = (int)$item_cart->quantity;
                $i = $i + 1;
                $itens_price = $itens_price+($item_cart->price * (int)$item_cart->quantity);
            }
        }
        $last_i = $i+1;
        $itens[$last_i]['itemId'] = abs(crc32(uniqid()));
        $itens[$last_i]['itemDescription'] = 'Taxa de entrega';
        $itens[$last_i]['itemAmount'] = $request->delivery_tax;
        $itens[$last_i]['itemQuantity'] = 1;
        $itens_price = $itens_price+$request->delivery_tax;

        $reference = abs(crc32(uniqid()));
        $pagseguro = PagSeguro::setReference($reference)
            ->setSenderInfo([
                'senderName' => $request->name,
                'senderPhone' => $request->cellphone,
                'senderEmail' => $user->email,
                'senderHash' => $request->senderHash,
                'senderCPF' => $user->cpf,
            ])
            ->setCreditCardHolder([
                'creditCardHolderName' => $request->creditCardHolderName,
                'creditCardHolderPhone' => $request->cellphone,
                'creditCardHolderCPF' => $user->cpf,
                'creditCardHolderBirthDate' => Carbon::createFromFormat('Y-m-d', $user->birthday)->format('d/m/Y'),
            ])
            ->setShippingAddress([
                'shippingAddressStreet' => $request->address,
                'shippingAddressNumber' => $request->number,
                'shippingAddressDistrict' => $request->district,
                'shippingAddressPostalCode' => $request->zip_code,
                'shippingAddressCity' => $request->city,
                'shippingAddressState' => $request->state,
            ])
            ->setItems($itens);
        $pagseguro->send([
            'paymentMethod' => 'creditCard',
            'creditCardToken' => $request->creditCardToken,
            'installmentQuantity' => '1',
            'installmentValue' => $itens_price,
        ]);

        return $reference;
    }

    private function storeOrder($request, $user)
    {
        $user = Customer::find($user);
        $order = new OrderDelivery();
        if($request->pagamento == 'pagseguro') {
            $reference = $this->addToPagseguro($request, $user);
            $order->reference = $reference;
        }else{
            $order->reference = null;
        }
        $order->name = $request->name;
        $order->cellphone = $request->cellphone;
        $order->payment_type = $request->pagamento;
        if($request->pagamento == 'money'){
            if($request->no_change != 'off') {
                if(!empty($request->change)){
                    $order->money_change = str_replace(',', '.', $request->change);
                }
            }
        }
        if($request->pagamento == 'pagseguro') {
            $order->credit_card_flag = $request->brand;
        }
        if($request->pagamento == 'card_machine') {
            $order->credit_card_flag = $request->card_type;
        }
        $order->pickup = 0;
        $order->postal_code = $request->zip_code;
        $order->address = $request->address;
        $order->number = $request->number;
        $order->complement = $request->complement;
        $order->district = $request->district;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->reference_point = $request->reference;
        $order->delivery_tax = str_replace(',', '.',  $request->delivery_tax);
        $order->customer_id = $user->id;
        $order->status_id = 0;
        $order->save();
        return $order;
    }

    private function storeProduct($request, $order, $item_cart)
    {

        if($item_cart->associatedModel->getTable() == 'menu_itens'){
            $product_model = $item_cart->associatedModel;
            $order_product = new OrderProduct();
            $order_product->price = str_replace(',', '.', $item_cart->price);
            $order_product->quantity = $item_cart->quantity;
            $order_product->menu_item_id = $product_model->id;
            $order_product->orders_delivery_id = $order->id;
            $order_product->save();
            foreach($item_cart->attributes as $key => $combo_item){
                $this->storeCombo($order_product, $combo_item);
            }
            $items = \Cart::session($order->customer_id)->getContent();

            foreach($items as $row) {
                if($row->associatedModel->getTable() == 'item_additionals'){
                    $this->storeAdditional($order_product, $row);
                }
                if($row->associatedModel->getTable() == 'variable_options'){
                    $variable = $this->storeVariable($order_product, $row);
                    $this->storeVariableOption($variable, $row);
                }
            }
            return $order_product;
        }
    }
    private function storeCombo($order_product, $combo_item)
    {
        $order_combo = new OrderProductCombo();
        $order_combo->orders_products_id = $order_product->id;
        $order_combo->combo_menu_item_id = $combo_item['item_id'];
        $order_combo->quantity = $combo_item['item_qtt'];
        $order_combo->save();
        return $order_combo;
    }
    private function storeAdditional($order_product, $item_cart_add)
    {
        $product_add_model = $item_cart_add->associatedModel;
        $order_additional = new OrderProductAdditional();
        if(!empty($product_add_model->increase_value)){
            $order_additional->increase_value = $product_add_model->increase_value;
        }
        if(!empty($product_add_model->decrease_value)){
            $order_additional->decrease_value = $product_add_model->decrease_value;
        }
        $order_additional->quantity = $item_cart_add->quantity;
        $order_additional->item_additional_id = $product_add_model->id;
        $order_additional->orders_products_id = $order_product->id;
        $order_additional->save();
        return $order_additional;
    }



    private function storeVariable($order_product,$row)
    {
        $order_variable = new OrderProductVariable();
        $order_variable->item_variable_id = $row->associatedModel->item_variable_id;
        $order_variable->orders_products_id = $order_product->id;
        $order_variable->save();
        return $order_variable;
    }

    private function storeVariableOption($variable, $row)
    {
        $order_var_option_model = $row->associatedModel;
        $order_variable_option = new OrderProductVariableOption();
        if(!empty($order_var_option_model->increase_value)){
            $order_variable_option->increase_value = $order_var_option_model->increase_value;
        }
        if(!empty($order_var_option_model->decrease_value)){
            $order_variable_option->decrease_value = $order_var_option_model->decrease_value;
        }
        $order_variable_option->variable_option_id = $order_var_option_model->id;
        $order_variable_option->orders_products_variable_id = $variable->id;
        $order_variable_option->save();
        return $order_variable_option;
    }


    public function send(Request $request)
    {
        $userId = Auth::guard('customers')->user()->id;
        $order = $this->storeOrder($request, $userId);
        $items = \Cart::session($userId)->getContent();

        foreach($items as $row) {
            $this->storeProduct($request, $order, $row);
            \Cart::session($userId)->remove($row->id);
        }

        return redirect(route('web-order', $order->id));
    }
    public function order($id)
    {
        $order = OrderDelivery::find($id);
        if( $order->status_id != 2
            && $order->status_id != 7
            && $order->status_id != 6
            && $order->status_id != 3
            && $order->status_id != 4
            && $order->status_id != 5
        ){
            if($order->payment_type != "pagseguro"){
                $options = array(
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'encrypted' => true
                );
                $pusher = new \Pusher\Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );
                $pusher->trigger('new-order', 'new-order', array('order_date' => $order->created_at, 'customer_name' => $order->name, 'customer_street' => $order->address, 'order_id' => $order->id, 'customer_cellphone' => $order->cellphone));
                $pusher->trigger('new-order', "order-$order->id", array('order_status' => 2));
                $order->update(['status_id' => 2]);
            }
        }
        $prevision_setting = Setting::where('key', 'delivery_prevision')->first();
        $prevision_setting_array = explode(':', $prevision_setting->value);
        $prevision = strtotime("+{$prevision_setting_array[1]} minutes", strtotime($order->created_at));
        $prevision = strtotime("+{$prevision_setting_array[0]} hours", $prevision);
        $prevision = date('Y/m/d H:i:s', $prevision);
        return view('menu-web.order', compact('order', 'prevision'));
    }
    public function postbackPagseguro(Request $request)
    {
        $postback = PagSeguro::notification($request->notificationCode, $request->notificationType);
        $order = OrderDelivery::where('reference', '=', $postback->reference);
        $order_collection = $order->first();
        if($postback->status == 3){
            $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            );
            $pusher = new \Pusher\Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $pusher->trigger('new-order', 'new-order', array('order_date' => $order_collection->created_at, 'customer_name' => $order_collection->name, 'customer_street' => $order_collection->address, 'order_id' => $order_collection->id, 'customer_cellphone' => $order_collection->cellphone));
            $pusher->trigger('new-order', "order-$order_collection->id", array('order_status' => 2));
            $order->update(['status_id' => 2]);
        }else{
            $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            );
            $pusher = new \Pusher\Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $pusher->trigger('new-order', 'new-order', array('order_date' => $order_collection->created_at, 'customer_name' => $order_collection->name));
            $pusher->trigger('new-order', "order-$order_collection->id", array('order_status' => 7));
            $order->update(['status_id' => 7]);
        }


        //status 3 eh o pago
    }

    public function getCep()
    {
        $getQueryString=url()->full();

        $url_components = parse_url($getQueryString);

        // Use parse_str() function to parse the
        // string passed via URL
        parse_str($url_components['query'], $params);

        // Display result
        $final_url = 'http://cep.republicavirtual.com.br/web_cep.php?formato='.$params['formato'].'&cep='.$params['cep'];
        echo file_get_contents($final_url);
    }
}
