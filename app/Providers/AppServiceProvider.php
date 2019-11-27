<?php

namespace App\Providers;

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
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if(count(HR_Company_reference_tax_tax_table::all())==0){
            $a= new HR_Company_reference_tax_tax_table;
            $a->tax_table_table_id="1";
            $a->one="0.00";
            $a->two="685.00";
            $a->three="1096.00";
            $a->four="2192.00";
            $a->five="5479.00";
            $a->six="21918.00";
            $a->save();
            $a= new HR_Company_reference_tax_tax_table;
            $a->tax_table_table_id="2";
            $a->one="0.00";
            $a->two="4808.00";
            $a->three="7692.00";
            $a->four="15385.00";
            $a->five="38385.00";
            $a->six="153846.00";
            $a->save();
            $a= new HR_Company_reference_tax_tax_table;
            $a->tax_table_table_id="3";
            $a->one="0.00";
            $a->two="10417.00";
            $a->three="16667.00";
            $a->four="33333.00";
            $a->five="83333.00";
            $a->six="333333.00";
            $a->save();
            $a= new HR_Company_reference_tax_tax_table;
            $a->tax_table_table_id="4";
            $a->one="0.00";
            $a->two="20833.00";
            $a->three="33333.00";
            $a->four="66667.00";
            $a->five="166667.00";
            $a->six="666667.00";
            $a->save();
            $a= new HR_Company_reference_tax_tax_table;
            $a->tax_table_table_id="5";
            $a->one="0.00";
            $a->two="9616.00";
            $a->three="15384.00";
            $a->four="30770.00";
            $a->five="76924.00";
            $a->six="307692.00";
            $a->save();
            
        }
        if(count(HR_Company_reference_tax_table_deduction::all())==0){
            $a= new HR_Company_reference_tax_table_deduction;
            $a->tax_table_deduction_id="1";
            $a->one="0.00<br>+0% Over";
            $a->two="0.00<br>+20% Over";
            $a->three="82.19<br>+25% Over";
            $a->four="356.16<br>+30% Over";
            $a->five="1342.47<br>+32% Over";
            $a->six="6602.74<br>+35% Over";
            $a->save();
            $a= new HR_Company_reference_tax_table_deduction;
            $a->tax_table_deduction_id="2";
            $a->one="0.00<br>+0% Over";
            $a->two="0.00<br>+20% Over";
            $a->three="576.92<br>+25% Over";
            $a->four="2500.00<br>+30% Over";
            $a->five="9423.08<br>+32% Over";
            $a->six="46346.15<br>+35% Over";
            $a->save();
            $a= new HR_Company_reference_tax_table_deduction;
            $a->tax_table_deduction_id="3";
            $a->one="0.00<br>+0% Over";
            $a->two="0.00<br>+20% Over";
            $a->three="1250.00<br>+25% Over";
            $a->four="5416.67<br>+30% Over";
            $a->five="20416.67<br>+32% Over";
            $a->six="100416.67<br>+35% Over";
            $a->save();
            $a= new HR_Company_reference_tax_table_deduction;
            $a->tax_table_deduction_id="4";
            $a->one="0.00<br>+0% Over";
            $a->two="0.00<br>+20% Over";
            $a->three="2500.00<br>+25% Over";
            $a->four="10833.33<br>+30% Over";
            $a->five="40833.33<br>+32% Over";
            $a->six="200833.33<br>+35% Over";
            $a->save();
            $a= new HR_Company_reference_tax_table_deduction;
            $a->tax_table_deduction_id="5";
            $a->one="0.00<br>+0% Over";
            $a->two="0.00<br>+20% Over";
            $a->three="1153.84<br>+25% Over";
            $a->four="5000.00<br>+30% Over";
            $a->five="18846.16<br>+32% Over";
            $a->six="92692.30<br>+35% Over";
            $a->save();
        }
        if(empty(HR_Company_reference_hr_ot_table::find('Default OT Table'))){
            $a= new HR_Company_reference_hr_ot_table;
            $a->dh_id="Default OT Table";
            $a->save();
        }else{
            $a = HR_Company_reference_hr_ot_table::find('Default OT Table');
            if($a->data_status=="0"){
                $a->data_status= NULL;
                $a->save();
            }
        }
        if(count(HR_cash_advance_loan_type::all())==0){
            $a=new HR_cash_advance_loan_type;
            $a->laon_type="Canteen";
            $a->save();
            $a=new HR_cash_advance_loan_type;
            $a->laon_type="Cooperative";
            $a->save();
            $a=new HR_cash_advance_loan_type;
            $a->laon_type="Colleague";
            $a->save();
            $a=new HR_cash_advance_loan_type;
            $a->laon_type="Cooperative Contribution";
            $a->save();
            $a=new HR_cash_advance_loan_type;
            $a->laon_type="Cellphone";
            $a->save();
            $a=new HR_cash_advance_loan_type;
            $a->laon_type="SSS";
            $a->save();
        }
        
        
        
        view()->share('asset_description_grouped', HR_hr_Asset_setup::where([
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->groupBy('asset_setup_description')->get());
        view()->share('asset_list',HR_hr_Asset::where([
            ['asset_approval','=','1'],
            ['asset_transaction_status','!=','3'],
            ['asset_transaction_status','!=','4']
        ])->get());
        view()->share('for_checkout_asset_list',HR_hr_Asset::where([
            ['asset_approval','=','1'],
            ['asset_transaction_status','=','1']
        ])->get());
        view()->share('checked_out_asset_list',HR_hr_Asset::where([
            ['asset_approval','=','1'],
            ['asset_transaction_status','=','2']
        ])->get());

        view()->share('asset_list_for_move',HR_hr_Asset::where([
            ['asset_approval','=','1'],
            ['asset_transaction_status','!=','3'],
            ['asset_transaction_status','!=','4'],
            ['asset_transaction_status','!=','-1'],
            ['asset_transaction_status','!=','-1.7'],
            ['asset_transaction_status','!=','-1.5'],
            ['asset_transaction_status','!=','-1.8']
        ])->get());
        view()->share('disposed_asset_list',HR_hr_Asset::where([
            ['asset_transaction_status','=','3']
        ])->orWhere([
            ['asset_transaction_status','=','-1']
        ])->get());
        view()->share('maintenance_asset_list',HR_hr_Asset::where([
            ['asset_transaction_status','=','4']
            
        ])->orWhere([
            ['asset_transaction_status','=','-1.7']
        ])->get());
        view()->share('recover_asset_list',HR_hr_Asset::where([
            ['asset_transaction_status','=','4']
        ])->orWhere([
            ['asset_transaction_status','=','3']
        ])->get());

        
        $asset_list_all = DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_IIDS FROM hr_assets 
        JOIN 
        hr_asset_setup ON hr_asset_setup.asset_setup_ad=hr_assets.asset_description
        ");
        view()->share('asset_list_all',$asset_list_all);
        view()->share('employee_attendance_list', HR_hr_employee_attendance::all());
        view()->share('payroll_year_list', HR_payroll::select('payroll_year')->groupBy('payroll_year')->orderBy('payroll_year', 'DESC')->get());
        view()->share('unprocessed_payroll_list', HR_payroll::where([
            ['process_status','=','0']
        ])->get());
        
        $employee_salary_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_salary JOIN hr_payroll ON hr_payroll.payroll_id=hr_employee_salary.payroll_id");
        view()->share('employee_salary_list', $employee_salary_list);
        $employee_adjustment_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_adjustment 
        JOIN 
        hr_employee_info ON hr_employee_info.employee_id=hr_employee_adjustment.employee_adjustment_emp_id
        JOIN
        hr_employee_job_detail ON hr_employee_job_detail.emp_id=hr_employee_info.employee_id
        WHERE
        employee_adjustment_active='1'");
        view()->share('employee_adjustment_list', $employee_adjustment_list);
        $employee_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_info 
        JOIN
                hr_employee_job_detail ON hr_employee_info.employee_id=hr_employee_job_detail.emp_id
                JOIN
                hr_employee_salary_detail ON hr_employee_info.employee_id=hr_employee_salary_detail.emp_id
                JOIN
                hr_company_department ON hr_company_department.department_id=hr_employee_job_detail.department
                JOIN 
                hr_company_cost_center ON hr_company_cost_center.cost_center_id=hr_employee_job_detail.cost_center
        UNION 
        SELECT * FROM hr_employee_info 
                JOIN
                hr_employee_job_detail ON hr_employee_info.employee_id=hr_employee_job_detail.emp_id
                JOIN
                hr_employee_salary_detail ON hr_employee_info.employee_id=hr_employee_salary_detail.emp_id
                LEFT JOIN 
                hr_company_department ON hr_company_department.department_id=hr_employee_job_detail.department
                LEFT JOIN 
                hr_company_cost_center ON hr_company_cost_center.cost_center_id=hr_employee_job_detail.cost_center");
        view()->share('employee_list', $employee_list);
        view()->share('employee_email_list', HR_hr_employee_email::all());
        view()->share('emp_memo', HR_hr_memo::where([['data_status','=',NULL]])->get());
        view()->share('form_templates', HR_hr_form_template::all());
        view()->share('loan_type', HR_cash_advance_loan_type::all());

        $cash_advance_list = DB::connection('mysql')->select("SELECT * FROM hr_cash_advances 
            JOIN 
            hr_employee_info ON hr_employee_info.employee_id=hr_cash_advances.emp_id");
        view()->share('cash_advances', $cash_advance_list);
        
        view()->share('HR_hr_employee_info', HR_hr_employee_info::all());
        view()->share('ot_rate_table', HR_Company_reference_hr_ot_table::where([['data_status','=',NULL]])->get());
        view()->share('company_adjustment', HR_Company_reference_hr_payroll_company_adjustment::where([['adjustment_status','=',NULL]])->get());
        
        view()->share('adjustment_template', HR_Company_reference_hr_payroll_adjustment_template::all());
        view()->share('HR_Company_reference_tax_table_deduction1', HR_Company_reference_tax_table_deduction::where([['tax_table_deduction_id','=','1']])->first());
        view()->share('HR_Company_reference_tax_table_deduction2', HR_Company_reference_tax_table_deduction::where([['tax_table_deduction_id','=','2']])->first());
        view()->share('HR_Company_reference_tax_table_deduction3', HR_Company_reference_tax_table_deduction::where([['tax_table_deduction_id','=','3']])->first());
        view()->share('HR_Company_reference_tax_table_deduction4', HR_Company_reference_tax_table_deduction::where([['tax_table_deduction_id','=','4']])->first());
        view()->share('HR_Company_reference_tax_table_deduction5', HR_Company_reference_tax_table_deduction::where([['tax_table_deduction_id','=','5']])->first());
        
        view()->share('HR_Company_reference_tax_tax_table1', HR_Company_reference_tax_tax_table::where([['tax_table_table_id','=','1']])->first());
        view()->share('HR_Company_reference_tax_tax_table2', HR_Company_reference_tax_tax_table::where([['tax_table_table_id','=','2']])->first());
        view()->share('HR_Company_reference_tax_tax_table3', HR_Company_reference_tax_tax_table::where([['tax_table_table_id','=','3']])->first());
        view()->share('HR_Company_reference_tax_tax_table4', HR_Company_reference_tax_tax_table::where([['tax_table_table_id','=','4']])->first());
        view()->share('HR_Company_reference_tax_tax_table5', HR_Company_reference_tax_tax_table::where([['tax_table_table_id','=','5']])->first());
        view()->share('HR_Company_reference_tax_tax_all()', HR_Company_reference_tax_tax_table::all());
        
        view()->share('reference_sss_table1', HR_Company_reference_sss_table::where([['sss_table_id','=','1']])->first());
        view()->share('reference_sss_table2', HR_Company_reference_sss_table::where([['sss_table_id','=','2']])->first());
        view()->share('reference_sss_table3', HR_Company_reference_sss_table::where([['sss_table_id','=','3']])->first());
        view()->share('reference_sss_table4', HR_Company_reference_sss_table::where([['sss_table_id','=','4']])->first());
        view()->share('reference_sss_table5', HR_Company_reference_sss_table::where([['sss_table_id','=','5']])->first());
        view()->share('reference_sss_table6', HR_Company_reference_sss_table::where([['sss_table_id','=','6']])->first());
        view()->share('reference_sss_table7', HR_Company_reference_sss_table::where([['sss_table_id','=','7']])->first());
        view()->share('reference_sss_table8', HR_Company_reference_sss_table::where([['sss_table_id','=','8']])->first());
        view()->share('reference_sss_table9', HR_Company_reference_sss_table::where([['sss_table_id','=','9']])->first());
        view()->share('reference_sss_table10', HR_Company_reference_sss_table::where([['sss_table_id','=','10']])->first());
        view()->share('reference_sss_table11', HR_Company_reference_sss_table::where([['sss_table_id','=','11']])->first());
        view()->share('reference_sss_table12', HR_Company_reference_sss_table::where([['sss_table_id','=','12']])->first());
        view()->share('reference_sss_table13', HR_Company_reference_sss_table::where([['sss_table_id','=','13']])->first());
        view()->share('reference_sss_table14', HR_Company_reference_sss_table::where([['sss_table_id','=','14']])->first());
        view()->share('reference_sss_table15', HR_Company_reference_sss_table::where([['sss_table_id','=','15']])->first());
        view()->share('reference_sss_table16', HR_Company_reference_sss_table::where([['sss_table_id','=','16']])->first());
        view()->share('reference_sss_table17', HR_Company_reference_sss_table::where([['sss_table_id','=','17']])->first());
        view()->share('reference_sss_table18', HR_Company_reference_sss_table::where([['sss_table_id','=','18']])->first());
        view()->share('reference_sss_table19', HR_Company_reference_sss_table::where([['sss_table_id','=','19']])->first());
        view()->share('reference_sss_table20', HR_Company_reference_sss_table::where([['sss_table_id','=','20']])->first());
        view()->share('reference_sss_table21', HR_Company_reference_sss_table::where([['sss_table_id','=','21']])->first());
        view()->share('reference_sss_table22', HR_Company_reference_sss_table::where([['sss_table_id','=','22']])->first());
        view()->share('reference_sss_table23', HR_Company_reference_sss_table::where([['sss_table_id','=','23']])->first());
        view()->share('reference_sss_table24', HR_Company_reference_sss_table::where([['sss_table_id','=','24']])->first());
        view()->share('reference_sss_table25', HR_Company_reference_sss_table::where([['sss_table_id','=','25']])->first());
        view()->share('reference_sss_table26', HR_Company_reference_sss_table::where([['sss_table_id','=','26']])->first());
        view()->share('reference_sss_table27', HR_Company_reference_sss_table::where([['sss_table_id','=','27']])->first());
        view()->share('reference_sss_table28', HR_Company_reference_sss_table::where([['sss_table_id','=','28']])->first());
        view()->share('reference_sss_table29', HR_Company_reference_sss_table::where([['sss_table_id','=','29']])->first());
        view()->share('reference_sss_table30', HR_Company_reference_sss_table::where([['sss_table_id','=','30']])->first());
        view()->share('reference_sss_table31', HR_Company_reference_sss_table::where([['sss_table_id','=','31']])->first());
        view()->share('reference_sss_all', HR_Company_reference_sss_table::all());
        
        view()->share('payroll_computation', HR_Company_payroll_computation::first());
        view()->share('payroll_computation_thirteen', HR_Company_payroll_computation_thirteen::first());
        view()->share('payroll_computation_rest_day', HR_Company_payroll_computation_rest_day::first());
        view()->share('payroll_computation_ot_rate', HR_Company_payroll_computation_ot_rate::first());
        view()->share('payroll_computation_ot_comp_option', HR_Company_payroll_computation_ot_comp_option::first());
        view()->share('payroll_computation_new_hire', HR_Company_payroll_computation_new_hire::first());
        view()->share('payroll_computation_late', HR_Company_payroll_computation_late::first());
        view()->share('payroll_computation_final_computation', HR_Company_payroll_computation_final_computation::first());
        view()->share('payroll_computation_absent', HR_Company_payroll_computation_absent::first());

        view()->share('company_govt_cont_sss', HR_Company_Govt_SSS::first());
        view()->share('company_govt_cont_philhealth', HR_Company_Govt_PhilHealth::first());
        view()->share('company_tax_computation', HR_Company_Tax_Computation::first());
        view()->share('company_info', HR_Company_Basic_Info::first());
        view()->share('company_work_policy', HR_Company_Work_Policy::first());
        view()->share('company_bank', HR_Company_Bank::all());
        view()->share('company_cost_center', HR_Company_Cost_Center::all());
        view()->share('company_department', HR_Company_Department::all());
        view()->share('company_department_active', HR_Company_Department::where([
            ['data_status','=','1']
        ])->get());
        
        
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                $view->with('user_position', Auth::user());
                $view->with('UserAccessList', UserAccess::where('user_id',Auth::user()->id)->get());
                $view->with('UserAccessCostCenterList', UserCostCenterAccess::where('use_id',Auth::user()->id)->get());
                $view->with('notif_count', count(HR_hr_notification::where([
                    ['notif_target','=',Auth::user()->id],
                    ['notif_status','=','1']
                ])->get()));
                
            }else {
                $view->with('user_position', null);
            }
        });
    }
}
