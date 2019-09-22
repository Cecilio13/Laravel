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
            return redirect('/test_page');
        }else{
            return redirect('/access_denied');
        }
    }
    public function router(Request $request){
        
        
    }
}
