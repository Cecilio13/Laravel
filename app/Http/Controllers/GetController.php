<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\UserCostCenterAccess;
use App\UserAccess;
use App\HR_Company_Basic_Info;
use App\HR_Company_Bank;
use App\HR_Company_Cost_Center;
use App\HR_Company_Department;
use App\HR_Company_Work_Policy;
use App\HR_Company_Tax_Computation;
use App\HR_Company_Govt_SSS;
use App\HR_Company_Govt_PhilHealth;
use App\HR_Company_payroll_computation;
use App\HR_Company_payroll_computation_thirteen;
use App\HR_Company_payroll_computation_rest_day;
use App\HR_Company_payroll_computation_ot_rate;
use App\HR_Company_payroll_computation_ot_comp_option;
use App\HR_Company_payroll_computation_new_hire;
use App\HR_Company_payroll_computation_late;
use App\HR_Company_payroll_computation_final_computation;
use App\HR_Company_payroll_computation_absent;
use App\HR_Company_reference_sss_table;
use App\HR_Company_reference_tax_table_deduction;
use App\HR_Company_reference_tax_tax_table;
use App\HR_Company_reference_hr_payroll_adjustment_template;
use App\HR_Company_reference_hr_payroll_company_adjustment;
use App\HR_Company_reference_hr_reference_govt_or_record;
use App\HR_Company_reference_hr_ot_table;
use App\HR_hr_employee_info;
use App\HR_hr_employee_email;
use App\HR_hr_employee_alt_contact;
use App\HR_hr_employee_emergency_contact;
use App\HR_hr_employee_education;
use App\HR_hr_employee_seminar;
use App\HR_hr_employee_trainer;
use App\HR_hr_employee_salary_detail;
use App\HR_hr_employee_job_detail;
use App\HR_hr_employee_leavemanagement;
use App\HR_hr_employee_schedule_detail;
use Illuminate\Support\Facades\DB;
use App\HR_hr_memo;
use App\HR_hr_form_template;
use App\HR_hr_cash_advances;
use App\HR_cash_advance_loan_type;
use App\HR_payroll;
use App\HR_hr_employee_adjustment;
use App\HR_hr_employee_attendance;
use App\HR_hr_cash_advances_payment;
use App\HR_hr_notification;

use App\HR_hr_Asset;
use App\HR_hr_Asset_setup;
use App\HR_hr_a_digit;
use App\HR_hr_asset_photo;
use App\HR_hr_asset_request;
class GetController extends Controller
{
    //
    public function get_asset_setup_site(Request $request){
        $value=$request->value;
        $Site=$request->Site;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','=',$value],
            ['asset_setup_site','like','%'.$Site.'%'],
            ['asset_setup_tag','=','Site And Location'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_site')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_site.'</option>';
        }
        return $rr;
    }
    public function check_site(Request $request){
        $value=$request->value;
        $site=$request->site;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','=',$value],
            ['asset_setup_site','=',$site],
            ['asset_setup_tag','=','Site And Location']
        ])->first();
        $result="0";
        if(!empty($data)){
            $result='1';
        }
        return $result;
    }
    public function get_asset_setup_location(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_location','like','%'.$value.'%'],
            ['asset_setup_tag','=','Site And Location'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_location')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_location.'</option>';
        }
        return $rr;
    }
    public function get_asset_desc(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','like','%'.$value.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_description')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_description.'</option>';
        }
        return $rr;
    }
    public function get_asset_category(Request $request){
        $value=$request->value;
        $cat=$request->category;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_category','like','%'.$cat.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_category')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_category.'</option>';
        }
        return $rr;
    }
    public function get_asset_sub_cat(Request $request){
        $value=$request->value;
        $cat=$request->CN;
        $sub=$request->SC;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_category','=',$cat],
            ['asset_setup_sub_cat','like','%'.$sub.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_sub_cat')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_sub_cat.'</option>';
        }
        return $rr;
    }
    
    public function get_asset_desc_code_list(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_ad','like','%'.$value.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_ad')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_ad.'</option>';
        }
        return $rr;
    }
    public function get_asset_category_code_list(Request $request){
        $value=$request->value;
        $cat_code=$request->category;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_ac','like','%'.$cat_code.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_ac')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_ac.'</option>';
        }
        return $rr;
    }
    public function get_asset_sub_cat_code_list(Request $request){
        $value=$request->value;
        $cat=$request->CN;
        $cat_sub_code=$request->SC;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_category','=',$cat],
            ['asset_setup_sc','like','%'.$cat_sub_code.'%'],
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_sc')->get();
        $rr="";
        foreach($data as $ss){
            $rr.='<option>'.$ss->asset_setup_sc.'</option>';
        }
        return $rr;
    }
    public function get_asset_desc_code(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_description','=',$value],
            ['asset_setup_status','=','1']
        ])->first();
        $result="";
        if(!empty($data)){
            $result=$data->asset_setup_ad;
        }
        return $result;
    }
    public function get_asset_cat_code(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_category','=',$value],
            ['asset_setup_status','=','1']
        ])->first();
        $result="";
        if(!empty($data)){
            $result=$data->asset_setup_ac;
        }
        return $result;
    }
    public function get_asset_sub_cat_code(Request $request){
        $value=$request->value;
        $data=HR_hr_Asset_setup::where([
            ['asset_setup_sub_cat','=',$value],
            ['asset_setup_status','=','1']
        ])->first();
        $result="";
        if(!empty($data)){
            $result=$data->asset_setup_sc;
        }
        return $result;
    }
    public function check_asset_setup_asset_tag_combination(Request $request){
        $desc=$request->desc;
        $CN=$request->CN;
        $SC=$request->SC;
        $descrip="";
        $CNNN="";
        $SCCC="";
        if($desc!=""){
            $descrip="asset_setup_description='$desc' ";
        }
        if($CN!=""){
            $CNNN="AND asset_setup_category='$CN' ";
        }
        if($SC!=""){
            $SCCC="AND asset_setup_sub_cat='$SC'";
        }
        $get_adjustment = DB::connection('mysql')->select("SELECT * FROM hr_asset_setup WHERE $descrip $CNNN $SCCC");
        if(count($get_adjustment)>0){
            return 1;
        }else{
            return 0;
        }
    }
}
