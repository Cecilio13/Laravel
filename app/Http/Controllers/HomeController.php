<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserCostCenterAccess;
use App\UserAccess;
use App\HR_Company_reference_tax_table_deduction;
use App\HR_Company_reference_tax_tax_table;
use App\HR_Company_reference_hr_ot_table;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        
        $UserAccess=UserAccess::where('user_id',Auth::user()->id)->first();
        if(!empty($UserAccess)){
            if($UserAccess->hr_system==1 || $UserAccess->payroll_system==1){
                $AccessTrue=1;
            }else{
                $AccessTrue=0;
            }
        }else{
            $AccessTrue=0;
        }

        if($AccessTrue==1){
            if(Auth::user()->access_bulletin=='1'){
                return redirect('/bulletin');
            }
            if(Auth::user()->access_ceo=='1'){
                return redirect('/ceo');
            }
            if(Auth::user()->access_hr=='1'){
                return redirect('/hr');
            }
            if(Auth::user()->access_payroll=='1'){
                return redirect('/payroll');
            }
            if(Auth::user()->access_asset_namagement=='1'){
                return redirect('/asset_management');
            }
            if(Auth::user()->access_company_setup=='1'){
                return redirect('/setup_company');
            }else{
                return redirect('/access_denied');
            }
            
        }else{
            return redirect('/access_denied');
        }
    }
    public function router(Request $request){
        
        
    }
}
