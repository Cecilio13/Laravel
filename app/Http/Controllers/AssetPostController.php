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
class AssetPostController extends Controller
{
    //
    
    public function add_asset_setup_request(Request $request){
        //return $this->generate_id();
        $gen=$this->generate_id();
        $setup_require_serial="0";
        $RequirePlateNumber="0";
        if ($request->has('RequireSerial')) {
            $setup_require_serial="1";
        }else{
            $setup_require_serial="0";
        }
        if ($request->has('RequirePlateNumber')) {
            $RequirePlateNumber="1";
        }else{
            $RequirePlateNumber="0";
        }
        $data= new HR_hr_Asset_setup;
        $data->asset_setup_tag=$request->asset_setup_type;
        if($request->asset_setup_type=="Asset Tag"){
            $data->asset_setup_description=$request->AssetDescriptionSetup;
            $data->asset_setup_category=$request->CategoryNameSetup;
            $data->asset_setup_sub_cat=$request->SubCategorySetup;
            $data->asset_setup_ad=$request->AD_COde;
            $data->asset_setup_ac=$request->CN_COde;
            $data->asset_setup_sc=$request->SC_COde;
            //plate number required
            $data->asset_setup_sku=$RequirePlateNumber;
            //serial number
            $data->uom=$setup_require_serial;
            
            
        }else{
            $data->asset_setup_site=$request->SiteSetup2;
            $data->asset_setup_location=$request->LocationSetup2;
        }
        $data->ticket_no=$gen;
        $data->requested_by=Auth::user()->id;
        if($data->save()){
            $this->generate_transaction_log($gen,$request->asset_setup_type,'Asset Setup','Queued on AM',$data->id,'');
        }
    }
}
