<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
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
use Illuminate\Support\Facades\Storage;
use App\HR_Company_reference_hr_ot_table;
use App\HR_hr_employee_info;
use Illuminate\Support\Facades\Hash;
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
use App\HR_hr_memo;
use App\HR_hr_form_template;
use App\HR_hr_cash_advances;
use App\HR_cash_advance_loan_type;
use App\HR_payroll;
use App\HR_hr_employee_salary;
use App\HR_hr_a_asset_request; //not yet implemented
use App\HR_hr_employee_adjustment;
class FormController extends Controller
{
    public function update_company_setup_data(Request $request){
        $company = HR_Company_Basic_Info::first();
        if(!empty($company)){


        }else{
            $company = new HR_Company_Basic_Info;
            
        }
            $company->companybasicid = '1';
            $company->companyname = $request->Company_Name;
            $company->natureofbusiness = $request->NatureOfBusiness;
            $company->address1 = $request->Address1;
            $company->address2 = $request->Address2;
            $company->zipcode = $request->ZIP;
            $company->rdo = $request->RDO;
            $company->email = $request->Email;
            $company->phone = $request->Phone;
            $company->fax = $request->FAX;
            $company->tin_number = $request->TIN;
            $company->sss_number = $request->SSS;
            $company->philhealth_number = $request->PhilHealth;
            $company->hdmf = $request->HDMF;
            $company->admin_signatory_name = $request->AdminSignatory;
            $company->admin_signatory_position = $request->AdminPosition;
            $company->hr_signatory_name = $request->HRSignatory;
            $company->hr_signatory_position = $request->HRPosition;
            $company->finance_signatory_name = $request->FinanceSignatory;
            $company->finance_signatory_position = $request->FinancePosition;
            //companylogofilename
            //esignatoryfilename
            if ($request->hasFile('company_logo')) {
                $request->company_logo->storeAs('logo', $request->company_logo->getClientOriginalName());
                $company->companylogofilename = $request->company_logo->getClientOriginalName();
            }
            if ($request->hasFile('ESIG')) {
                $request->ESIG->storeAs('e_sig', $request->ESIG->getClientOriginalName());
                $company->esignatoryfilename = $request->ESIG->getClientOriginalName();
            }
            $company->save();
        return redirect('setup_company?page=1');
    }
    public function update_company_bank_data(Request $request){
        $bank = new HR_Company_Bank;
        $bank->bank_name=$request->BankBankName;
        $bank->company_code=$request->BankCompanyCode;
        $bank->bank_code=$request->BankBankCode;
        $bank->presenting_office=$request->BankPresentingOffice;
        $bank->account_number=$request->BankAccountNumber;
        $bank->bank_remarks=$request->BankRemarks;
        $bank->save();
    }
    public function update_company_cost_center_data(Request $request){
        $costcenter= new HR_Company_Cost_Center;
        $costcenter->cost_center_name=$request->CostCenterName;
        $costcenter->cost_center_code=$request->CostCenterCode;
        $costcenter->cost_center_remarks=$request->CostCenterRemarks;
        $costcenter->save();
    }
    public function update_company_department_data(Request $request){
        $department= new HR_Company_Department;
        $department->department_name=$request->DepartmentName;
        $department->department_code=$request->DepartmentCode;
        $department->department_remarks=$request->DepartmentRemarks;
        $department->save();
    }
    public function delete_bank_data(Request $request){
        $bank = HR_Company_Bank::find($request->id);
        $bank->data_status='0';
        $bank->save();
    }
    public function delete_cost_center_data(Request $request){
        $bank = HR_Company_Cost_Center::find($request->id);
        $bank->data_status='0';
        $bank->save();
    }
    public function delete_department_data(Request $request){
        $bank = HR_Company_Department::find($request->id);
        $bank->data_status='0';
        $bank->save();
    }
    public function get_bank_data(Request $request){
        return HR_Company_Bank::find($request->id);
    }
    public function get_costcenter_data(Request $request){
        return HR_Company_Cost_Center::find($request->id);
    }
    public function update_company_bank_data_edit(Request $request){
        $bank = HR_Company_Bank::find($request->editbankid);
        $bank->bank_name=$request->editbankname;
        $bank->company_code=$request->editbankcompanycode;
        $bank->bank_code=$request->editbankcode;
        $bank->presenting_office=$request->editbankpresentingoffice;
        $bank->account_number=$request->editbankaccountnumber;
        $bank->bank_remarks=$request->editbank_remark;
        $bank->save();
    }
    function update_company_costcenter_data_edit(Request $request){
        $costcenter= HR_Company_Cost_Center::find($request->editcostcenterid);
        $costcenter->cost_center_name=$request->editcostcentername;
        $costcenter->cost_center_code=$request->editcostcentercode;
        $costcenter->cost_center_remarks=$request->editcostcenter_remark;
        $costcenter->save();
    }
    function update_company_department_data_edit(Request $request){
        $department= HR_Company_Department::find($request->editdepartmentid);
        $department->department_name=$request->editdepartmentname;
        $department->department_code=$request->editdepartmentcode;
        $department->department_remarks=$request->editdepartment_remark;
        $department->save();
    }
    function get_department_data(Request $request){
        return HR_Company_Department::find($request->id);
    }
    function update_work_policy(Request $request){
        $work = HR_Company_Work_Policy::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_Work_Policy; 
        }
        $work->companybasicid='1';
        $work->work_day_per_year=$request->DayPerYear;
        $work->work_hour_per_day=$request->workhourperday;
        $work->workhourstart=$request->workhourstart;
        $work->workhourend=$request->workhourend;
        $work->breakhour=$request->breakhour;
        $work->save();
    }
    function update_tax_computation(Request $request){
        $work = HR_Company_Tax_Computation::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_Tax_Computation; 
        }
        $work->tax_computation_id='1';
        $work->use_annual_tax_table=$request->useannualtaxtable;
        $work->non_tax_exemption_ceiling=$request->exemptionceiling;
        $work->start_of_annualization=$request->startofanualization;
        $work->save();
    }
    function update_govt_contribution(Request $request){
        $work = HR_Company_Govt_SSS::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_Govt_SSS; 
        }
        $work->govt_sss_id='1';
        $work->basic_salary=$request->BasicSSS;
        $work->bonus=$request->BonusesSSS;
        $work->absent_late=$request->AbsentSSS;
        $work->overtime=$request->OvertimeSSS;
        $work->salary_adjustment=$request->SalaryAdjustmentSSS;
        $work->deminimis=$request->DeminimisSSS;
        $work->allowance=$request->AllowanceSSS;
        $work->commission=$request->CommisionSSS;
        $work->reimbursable_allowance=$request->ReimbursableSSS;
        $work->ecola=$request->ECOLASSS;
        $work->deduction_period=$request->deductionperiodsss;
        $work->save();
        $work = HR_Company_Govt_PhilHealth::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_Govt_PhilHealth; 
        }
        $work->govt_ph_id='1';
        $work->basic_salary=$request->BasicPhilHealth;
        $work->bonus=$request->BonusesPhilHealth;
        $work->absent_late=$request->AbsentPhilHealth;
        $work->overtime=$request->OvertimePhilHealth;
        $work->salary_adjustment=$request->SalaryAdjustmentPhilHealth;
        $work->deminimis=$request->DeminimisPhilHealth;
        $work->allowance=$request->AllowancePhilHealth;
        $work->commission=$request->CommisionPhilHealth;
        $work->reimbursable_allowance=$request->ReimbursablePhilHealth;
        $work->ecola=$request->ECOLAPhilHealth;
        $work->deduction_period=$request->deductionperiodphilhealth;
        $work->save();
        $work = HR_Company_Basic_Info::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_Basic_Info; 
        }
        $work->hdmf_equ_empr_share=$request->equivalentemployer;
        $work->deduction_period=$request->deductionperiodHDMF;
        $work->save();
        
        
    }
    public function update_payroll_computation(Request $request){
        $work = HR_Company_payroll_computation::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation; 
        }
        $work->companybasicid='1';
        $work->periodpermonth=$request->periodspermonth;
        $work->stationaryperiodschedule=$request->statutoryperiodschedule;
        $work->newhireprorated_type=$request->NewHireCompType;
        $work->deductabsent=$request->NEWHIREDEDUCTABSENT;
        $work->deductlate=$request->NEWHIREDEDUCTLATE;
        $work->finalcomputation_deductabsent=$request->NEWHIREDEDUCTABSENTfinal;
        $work->finalcomputation_deductlate=$request->NEWHIREDEDUCTLATEfinal;
        $work->work_day_per_month=$request->WorkDayPerMonth;
        $work->save();
        $work = HR_Company_payroll_computation_absent::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_absent; 
        }
        $work->absentdeduct_id='1';
        $work->basic_salary=$request->BasicAbsentPayroll;
        $work->deminimis=$request->DeminimisAbsentPayroll;
        $work->allowance=$request->AllowanceAbsentPayroll;
        $work->reimbursable_allowance=$request->ReimbursableAbsentPayroll;
        $work->ecola=$request->ECOLAAbsentPayroll;
        $work->save();
        $work = HR_Company_payroll_computation_late::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_late; 
        }
        $work->latededuct_id='1';
        $work->basic_salary=$request->BasicLatePayroll;
        $work->deminimis=$request->DeminimisLatePayroll;
        $work->allowance=$request->AllowanceLatePayroll;
        $work->reimbursable_allowance=$request->ReimbursableLatePayroll;
        $work->ecola=$request->ECOLALatePayroll;
        $work->save();
        $work = HR_Company_payroll_computation_ot_comp_option::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_ot_comp_option; 
        }
        $work->ot_comp_option_id='1';
        $work->basic_salary=$request->BasicOvertime;
        $work->deminimis=$request->DeminimisOvertime;
        $work->allowance=$request->AllowanceOvertime;
        $work->reimbursable_allowance=$request->ReimbursableOvertime;
        $work->ecola=$request->ECOLAOvertime;
        $work->save();

        $work = HR_Company_payroll_computation_ot_rate::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_ot_rate; 
        }
        $work->ot_rate_id='1';
        $work->ord_ot=$request->ORDOT;
        $work->ord_nd_ot=$request->ORDNDOT;
        $work->rd_ot=$request->RDOT;
        $work->rd_nd_ot=$request->RDNDOT;
        $work->sh_ot=$request->SHOT;
        $work->dh_nd_ot=$request->DHNDOT;
        $work->lh=$request->LH;
        $work->lh_nd=$request->LHND;
        $work->sh_rd=$request->SHRD;
        $work->sh_rd_nd=$request->SHRDND;
        $work->lh_rd=$request->LHRD;
        $work->lh_rd_nd=$request->LHRDND;
        $work->dh=$request->DH;
        $work->dh_nd=$request->DHND;
        $work->ord_nd=$request->ORDND;
        $work->rd=$request->RD;
        $work->rd_nd=$request->RDND;
        $work->sh=$request->SH;
        $work->sh_nd=$request->SHND;
        $work->sh_nd_ot=$request->SHNDOT;
        $work->lh_ot=$request->LHOT;
        $work->lh_nd_ot=$request->LHNDOT;
        $work->sh_rd_ot=$request->SHRDOT;
        $work->sh_rd_nd_ot=$request->SHRDNDOT;
        $work->lh_rd_ot=$request->LHRDOT;
        $work->lh_rd_nd_ot=$request->LHRDNDOT;
        $work->dh_ot=$request->DHOT;
        $work->dh_rd=$request->DHRD;
        $work->dh_rd_ot=$request->DHRDOT;
        $work->dh_rd_nd=$request->DHRDND;
        $work->dh_rd_nd_ot=$request->DHRDNDOT;
        $work->save();

        $work = HR_Company_payroll_computation_rest_day::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_rest_day; 
        }
        $work->restday_id='1';
        $work->sunday=$request->Sunday;
        $work->monday=$request->Monday;
        $work->tuesday=$request->Tuesday;
        $work->wednesday=$request->Wednesday;
        $work->thursday=$request->Thursday;
        $work->friday=$request->Friday;
        $work->saturday=$request->Saturday;
        $work->save();

        $work = HR_Company_payroll_computation_final_computation::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_final_computation; 
        }
        $work->final_computation_id='1';
        $work->basic_salary=$request->BasicLatefinal;
        $work->deminimis=$request->DeminimisLatefinal;
        $work->allowance=$request->AllowanceLatefinal;
        $work->reimbursable_allowance=$request->ReimbursableLatefinal;
        $work->ecola=$request->ECOLALatefinal;
        $work->save();

        $work = HR_Company_payroll_computation_new_hire::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_new_hire; 
        }
        $work->new_hire_prorated_comp_id='1';
        $work->basic_salary=$request->BasicPayroll;
        $work->deminimis=$request->DeminimisPayroll;
        $work->allowance=$request->AllowancePayroll;
        $work->reimbursable_allowance=$request->ReimbursablePayroll;
        $work->ecola=$request->ECOLAPayroll;
        $work->save();

        $work = HR_Company_payroll_computation_thirteen::first();
        if(!empty($work)){
        }else{
            $work = new HR_Company_payroll_computation_thirteen; 
        }
        $work->thirteenth_month_id='1';
        $work->basic=$request->Basicthirteen;
        $work->overtime=$request->Overtimethirteen;
        $work->deminimis=$request->Deminimisthirteen;
        $work->bonus=$request->Bonusesthirteen;
        $work->ecola=$request->ECOLAthirteen;
        $work->allowance_reimbursable_allowance=$request->Reimbursablethirteen;
        $work->commission=$request->Commisionthirteen;
        $work->late_undertime=$request->Absentthirteen;
        $work->basic_adjustment=$request->SalaryAdjustmentthirteen;
        $work->other_taxable_income=$request->Allowancethirteen;
        $work->save();


    }
    public function update_sss_table(Request $request){
        for ($i=1; $i <=31 ; $i++) { 
            $id=$i;
            $work = HR_Company_reference_sss_table::find($id);
            if(!empty($work)){
            }else{
                $work = new HR_Company_reference_sss_table; 
            }
            $work->sss_table_id=$id;
            $work->min_range=$request->input('AAA'.$id);
            $work->max_range=$request->input('SSS'.$id);
            $work->monthly_salary_credit=$request->input('DDD'.$id);
            $work->ss_er=$request->input('FFF'.$id);
            $work->ss_ee=$request->input('GGG'.$id);
            $work->ss_total=$request->input('HHH'.$id);
            $work->ec_er=$request->input('JJJ'.$id);
            $work->total_contribution=$request->input('KKK'.$id);
            $work->seumofw_total_contribution=$request->input('LLL'.$id);
            $work->save();
        }
        
        
    }
    public function get_tax_tax_table_data(Request $request){
        return HR_Company_reference_tax_tax_table::find($request->id);
    }
    public function get_tax_table_deduction_data(Request $request){
        return HR_Company_reference_tax_table_deduction::find($request->id);
    }
    
    public function update_taxtta_table(Request $request){
        $a=HR_Company_reference_tax_tax_table::find($request->tabletableid);
        if(!empty($a)){
        }else{
            $a = new HR_Company_reference_tax_tax_table; 
        }
        $a->one=$request->tt1;
        $a->two=$request->tt2;
        $a->three=$request->tt3;
        $a->four=$request->tt4;
        $a->five=$request->tt5;
        $a->six=$request->tt6;
        $a->save();
    }
    public function update_tax_table_deduction_data(Request $request){
        $a=HR_Company_reference_tax_table_deduction::find($request->deducid);
        if(!empty($a)){
        }else{
            $a = new HR_Company_reference_tax_table_deduction; 
        }
        $a->one=$request->one1."<br>".$request->one2;
        $a->two=$request->two1."<br>".$request->two2;
        $a->three=$request->three1."<br>".$request->three2;
        $a->four=$request->four1."<br>".$request->four2;
        $a->five=$request->five1."<br>".$request->five2;
        $a->six=$request->six1."<br>".$request->six2;
        $a->save();
    }
    public function add_new_adjsutment_template(Request $request){
        $a = new HR_Company_reference_hr_payroll_adjustment_template; 
        $a->template_type=$request->AdjType;
        $a->template_name=$request->AdjName;
        $a->template_code=$request->AdjCode;
        $a->template_amount=$request->Amount;
        $a->applied_before=$request->ApplyBefore;
        $a->taxable=$request->Taxable;
        $a->template_max_amount=$request->MaxAmount;
        $a->divided_by_period=$request->Divided;
        $a->template_remarks=$request->AdjtempRemarks;
        $a->save();
    }
    public function get_adjustment_template_data(Request $request){
        return HR_Company_reference_hr_payroll_adjustment_template::find($request->id);
    }
    public function get_company_adjustment_data(Request $request){
        return HR_Company_reference_hr_payroll_company_adjustment::find($request->id);
    }
    public function update_adjustment_template_data(Request $request){
        $a = HR_Company_reference_hr_payroll_adjustment_template::find($request->templateid); 
        $a->template_type=$request->AdjType2;
        $a->template_name=$request->AdjName2;
        $a->template_code=$request->AdjCode2;
        $a->template_amount=$request->Amount2;
        $a->applied_before=$request->ApplyBefore2;
        $a->taxable=$request->Taxable2;
        $a->template_max_amount=$request->MaxAmount2;
        $a->divided_by_period=$request->Divided2;
        $a->template_remarks=$request->AdjtempRemarks2;
        $a->save();
    }
    public function add_company_adjustment_data(Request $request){
        $a = new HR_Company_reference_hr_payroll_company_adjustment; 
        $a->company_adjustment_type=$request->AdjTypecom;
        $a->company_adjustment_name=$request->AdjNamecom;
        $a->company_adjustment_code=$request->AdjCodecom;
        $a->company_adjustment_amount=$request->Amountcom;
        $a->company_adjustment_applied_before=$request->ApplyBeforecom;
        $a->company_adjustment_taxable=$request->Taxablecom;
        $a->company_adjustment_max_amount=$request->MaxAmountcom;
        $a->divided_by_period=$request->Dividedcom;
        $a->company_adjustment_remarks=$request->AdjtempRemarkscom;
        $a->save();
    }
    public function update_company_adjustment_data(Request $request){
        $a = HR_Company_reference_hr_payroll_company_adjustment::find($request->templateidcom); 
        $a->company_adjustment_type=$request->AdjType2com;
        $a->company_adjustment_name=$request->AdjName2com;
        $a->company_adjustment_code=$request->AdjCode2com;
        $a->company_adjustment_amount=$request->Amount2com;
        $a->company_adjustment_applied_before=$request->ApplyBefore2com;
        $a->company_adjustment_taxable=$request->Taxable2coms;
        $a->company_adjustment_max_amount=$request->MaxAmount2com;
        $a->divided_by_period=$request->Divided2com;
        $a->company_adjustment_remarks=$request->AdjtempRemarks2com;
        $a->save();
    }
    public function delete_company_adjustment_data(Request $request){
        $a = HR_Company_reference_hr_payroll_company_adjustment::find($request->id); 
        $a->adjustment_status='1';
        $a->save();
    }
    public function add_govt_or_record_data(Request $request){
        $a= new HR_Company_reference_hr_reference_govt_or_record;
        $a->month=$request->ORMonth;
        $a->year=$request->ORYear;
        $a->sss_or=$request->ORSSS1;
        $a->sss_date=$request->ORSSS2;
        $a->sss_loan_or=$request->ORSSSLoan1;
        $a->sss_loan_date=$request->ORSSSLoan2;
        $a->sss_cal_loan_or=$request->ORSSSCalamityLoan1;
        $a->sss_cal_loan_date=$request->ORSSSCalamityLoan2;
        $a->philhealth_or=$request->ORPhilHealth1;
        $a->philhealth_date=$request->ORPhilHealth2;
        $a->hdmf_or=$request->ORHDMF1;
        $a->hdmf_date=$request->ORHDMF2;
        $a->hdmf_loan_or=$request->ORHDMFLoan1;
        $a->hdmf_loan_date=$request->ORHDMFLoan2;
        $a->hdmf_cal_loan_or=$request->ORHDMFCalamityLoan1;
        $a->hdmf_cal_loan_date=$request->ORHDMFCalamityLoan2;

        
        $a->hdmf_cal_loan_date=$request->ORHDMFCalamityLoan2;
        $a->hdmf_cal_loan_date=$request->ORHDMFCalamityLoan2;
        $a->hdmf_cal_loan_date=$request->ORHDMFCalamityLoan2;
        $a->hdmf_cal_loan_date=$request->ORHDMFCalamityLoan2;
        $a->hdmf_cal_loan_date=$request->ORHDMFCalamityLoan2;
        $a->hdmf_cal_loan_date=$request->ORHDMFCalamityLoan2;
        
        if ($request->hasFile('ORSSS3')) {
            $request->ORSSS3->storeAs('public/govt_or/SSS/', $request->ORSSS1.".".$request->ORSSS3->getClientOriginalExtension());
            $a->sss_file=$request->ORSSS1.".".$request->ORSSS3->getClientOriginalExtension();
        }
        if ($request->hasFile('ORSSSLoan3')) {
            $request->ORSSSLoan3->storeAs('public/govt_or/SSS_Loan/', $request->ORSSSLoan1.".".$request->ORSSSLoan3->getClientOriginalExtension());
            $a->sss_loan_file=$request->ORSSSLoan1.".".$request->ORSSSLoan3->getClientOriginalExtension();
        }
        if ($request->hasFile('ORSSSCalamityLoan3')) {
            $request->ORSSSCalamityLoan3->storeAs('public/govt_or/SSS_Loan_Calamity/', $request->ORSSSCalamityLoan1.".".$request->ORSSSCalamityLoan3->getClientOriginalExtension());
            $a->sss_cal_loan=$request->ORSSSCalamityLoan1.".".$request->ORSSSCalamityLoan3->getClientOriginalExtension();
        }
        if ($request->hasFile('ORPhilHealth3')) {
            $request->ORPhilHealth3->storeAs('public/govt_or/PhilHealth/', $request->ORPhilHealth1.".".$request->ORPhilHealth3->getClientOriginalExtension());
            $a->philhealth_file=$request->ORPhilHealth1.".".$request->ORPhilHealth3->getClientOriginalExtension();
        }
        if ($request->hasFile('ORHDMF3')) {
            $request->ORHDMF3->storeAs('public/govt_or/HDMF/', $request->ORHDMF1.".".$request->ORHDMF3->getClientOriginalExtension());
            $a->hdmf_file=$request->ORHDMF1.".".$request->ORHDMF3->getClientOriginalExtension();
        }
        if ($request->hasFile('ORHDMFLoan3')) {
            $request->ORHDMFLoan3->storeAs('public/govt_or/HDMF_Loan/', $request->ORHDMFLoan1.".".$request->ORHDMFLoan3->getClientOriginalExtension());
            $a->hdmf_loan_file=$request->ORHDMFLoan1.".".$request->ORHDMFLoan3->getClientOriginalExtension();
        }
        if ($request->hasFile('ORHDMFCalamityLoan3')) {
            $request->ORHDMFCalamityLoan3->storeAs('public/govt_or/HDMF_Loan_Calamity/', $request->ORHDMFCalamityLoan1.".".$request->ORHDMFCalamityLoan3->getClientOriginalExtension());
            $a->hdmf_cal_loan=$request->ORHDMFCalamityLoan1.".".$request->ORHDMFCalamityLoan3->getClientOriginalExtension();
        }
        $a->save();
        return redirect('setup_references?page=8');
    }
    public function GetGovtOR(Request $request){
        $tablerow="";
        $tablerowdate="";
        $Path="";
        $filenamedb="";
        $value=$request->value;
        if($value=="SSS"){
            $tablerow="sss_or";
            $tablerowdate="sss_date";
            $Path="SSS";
            $filenamedb="sss_file";
        }
        else if($value=="SSS Loan"){
            $tablerow="sss_loan_or";
            $tablerowdate="sss_loan_date";
            $Path="SSS_Loan";
            $filenamedb="sss_loan_file";
        }
        else if($value=="SSS Calamity Loan"){
            
            $tablerow="sss_cal_loan_or";
            $tablerowdate="sss_cal_loan_date";
            $Path="SSS_Loan_Calamity";
            $filenamedb="sss_cal_loan";
        }
        else if($value=="PhilHealth"){
            
            $tablerow="philhealth_or";
            $tablerowdate="philhealth_date";
            $Path="PhilHealth";
            $filenamedb="philhealth_file";
        }
        else if($value=="HDMF"){
            
            $tablerow="hdmf_or";
            $tablerowdate="hdmf_date";
            $Path="HDMF";
            $filenamedb="hdmf_file";
        }
        else if($value=="HDMF Loan"){
            
            $tablerow="hdmf_loan_or";
            $tablerowdate="hdmf_loan_date";
            $Path="HDMF_Loan";
            $filenamedb="hdmf_loan_file";
        }
        else if($value=="HDMF Calamity Loan"){
            $tablerow="hdmf_cal_loan_or";
            $tablerowdate="hdmf_cal_loan_date";
            $Path="HDMF_Loan_Calamity";
            $filenamedb="hdmf_cal_loan";
        }
        $records=HR_Company_reference_hr_reference_govt_or_record::where([
                    [$tablerow,'!=','']
                ])
                ->get();
        $tablecontent='<tbody id="ORGovtTBody">';
        foreach($records as $data){
            $tablecontent.='<tr>';
            $tablecontent.='<td>'.$data->$tablerow.'</td>';
            $tablecontent.='<td>';
            if($data->$tablerowdate!='' && $data->$tablerowdate!='0000-00-00'){
                $tablecontent.=date('m-d-Y',strtotime($data->$tablerowdate)); 
            }else{
                $tablecontent.='Not Specified';
            }
            $tablecontent.='</td>';
            //$tablecontent.='<td><a href="download/'.$Path.'/'.$data->$filenamedb.'">'.$data->$filenamedb.'</a></td>';
            if($data->$filenamedb!=''){
                $tablecontent.='<td><a href="'.asset('storage/govt_or/'.$Path."/".$data->$filenamedb).'" download>'.$data->$filenamedb.'</a></td>';
            }else{
                $tablecontent.='<td>No File Attached</td>';
            }
            
            
            $tablecontent.='</tr>';
        }
        $tablecontent.='</tbody>';

        return $tablecontent;
    }
    public function delete_ot_rate_table_data(Request $request){
        
        $a=HR_Company_reference_hr_ot_table::find($request->id);
        $a->data_status="0";
        $a->save();
    }
    public function add_ot_rate_table_name(Request $request){
        $a=HR_Company_reference_hr_ot_table::find($request->id);
        if(empty($a)){
            $a = new HR_Company_reference_hr_ot_table;
            $a->dh_id=$request->id;
            $a->save();
            return '1';
        }else{
            return "0";
        }
    }
    public function get_ot_rate_table_data(Request $request){
        return HR_Company_reference_hr_ot_table::find($request->id);
    }
    public function update_ot_rate_table_data(Request $request){
        $a=HR_Company_reference_hr_ot_table::find($request->SelTale);
        $normal=$request->ot_type;
        $ot=$request->ot_type."_ot";
        $nd=$request->ot_type."_nd";
        $nd_ot=$request->ot_type."_nd_ot";
        $a->$normal=$request->S1;
        $a->$ot=$request->S2;
        $a->$nd=$request->S3;
        $a->$nd_ot=$request->S4;
        $a->save();
    }
    public function add_employee_data(Request $request){
        $a=new HR_hr_employee_info;
        $a->biometrics_id=$request->EmpBIOID;
        $a->company_id=$request->BiometricsID;
        $a->fname=$request->FName;
        $a->mname=$request->MName;
        $a->lname=$request->LName;
        $a->gender=$request->Gender;
        $a->civil_status=$request->CS;
        $a->date_of_birth=$request->DATE;
        $a->address=$request->EmpAddress;
        $a->username=$request->EmpUsername;
        $a->password=Hash::make($request->EmpPassword);
        $a->lock_user=$request->EmpLockUser;
        if ($request->hasFile('ImgUpp')) {
            $request->ImgUpp->storeAs('public/employee_photo/', $request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension());
            //$a->hdmf_cal_loan=$request->ORHDMFCalamityLoan1.".".$request->ImgUpp->getClientOriginalExtension();
            $a->photofilename=$request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension();
        }
        // use App\HR_hr_employee_email;
        // use App\HR_hr_employee_alt_contact;
        // use App\HR_hr_employee_emergency_contact;
        if($a->save()){
            //$a->id
            for ($i=1; $i <=2 ; $i++) { 
                $data= new HR_hr_employee_emergency_contact;
                $data->emp_id=$a->employee_id;
                $data->phone_number=$request->input('PhoneNumber'.$i);
                $data->contact_person=$request->input('ContactPerson'.$i);
                $data->relationship=$request->input('Relation'.$i);
                $data->address=$request->input('AddressContact'.$i);
                $data->save();
            }
            for ($i=1; $i <=2 ; $i++) { 
                $data= new HR_hr_employee_alt_contact;
                $data->emp_id=$a->employee_id;
                $data->phone_number=$request->input('AltPhoneContact'.$i);
                $data->contact_person=$request->input('AltPersonContact'.$i);
                $data->type=$request->input('AltTypeContact'.$i);
                $data->save();
            }
            for ($i=1; $i <=2 ; $i++) { 
                $data= new HR_hr_employee_email;
                $data->emp_id=$a->employee_id;
                $data->email=$request->input('Emailnumber'.$i);
                $data->type=$request->input('EmailType'.$i);
                $data->save();
            }
            for ($i=1; $i <=$request->SchoolFieldCount ; $i++) {
                if($request->input('SCHOOL'.$i)!=''){
                    $data= new HR_hr_employee_education;
                    $data->emp_id=$a->employee_id;
                    $data->type=$request->input('EDUCType'.$i);
                    $data->school_name=$request->input('SCHOOL'.$i);
                    $data->study_from=$request->input('FROM'.$i);
                    $data->study_to=$request->input('TO'.$i);
                    $data->degree=$request->input('DEGREE'.$i);
                    $data->save();
                }
                
            }
            for ($i=1; $i <=$request->TrainingFieldCount ; $i++) {
                if($request->input('TrainingName'.$i)!=''){
                    $data= new HR_hr_employee_trainer;
                    $data->emp_id=$a->employee_id;
                    $data->training_date=$request->input('TrainingDate'.$i);
                    $data->training_name=$request->input('TrainingName'.$i);
                    $data->instructor=$request->input('Instructor'.$i);
                    $data->training_nature=$request->input('Nature'.$i);
                    $data->training_cost=$request->input('TrainingCost'.$i);
                    $data->training_returningserviceperiod=$request->input('Returning'.$i);
                    $data->correspondingamount=$request->input('Corresponding'.$i);
                    $data->training_note=$request->input('Note'.$i);
                    $data->save();
                }
                
            }
            for ($i=1; $i <=$request->SeminarFieldCount ; $i++) {
                if($request->input('SName'.$i)!=''){
                    $data= new HR_hr_employee_seminar;
                    $data->emp_id=$a->employee_id;
                    $data->seminar_date=$request->input('SDate'.$i);
                    $data->seminar_name=$request->input('SName'.$i);
                    $data->instructor=$request->input('SIns'.$i);
                    $data->seminar_nature=$request->input('SNature'.$i);
                    $data->seminar_cost=$request->input('SCost'.$i);
                    $data->seminar_returningserviceperiod=$request->input('SReturning'.$i);
                    $data->correspondingamount=$request->input('SCorresponding'.$i);
                    $data->seminar_note=$request->input('SNote'.$i);
                    $data->save();
                }
                
            }
            
            $data= new HR_hr_employee_salary_detail;
            $data->emp_id=$a->employee_id;
            $data->workdayperyear=$request->WorkDaysPerYear;
            $data->ot_com_table=$request->OTComputationTable;
            $data->pagibigcont=$request->PagibigContribution;
            $data->minwage=$request->MinimumWage;
            $data->basic_salary=$request->BasicSalary;
            $data->sss_contribution=$request->SSSContribution;
            $data->add_pagibig_cont=$request->AdditionalPagibigContribution;
            $data->ecola=$request->ECOLAINPUT;
            $data->deminimis_total=$request->Deminimistotal;
            $data->philhealth_contribution=$request->PhilhealthContribution;
            $data->bank=$request->BankName;
            $data->bank_type=$request->BankType;
            $data->bank_acc_number=$request->BankAccNumber;
            $data->meal_allowance=$request->MealAllowance;
            $data->mobile_allowance=$request->MobileAllowance;
            $data->cash_allowance=$request->CashAllowance;
            $data->travel_allowance=$request->TravelAllowance;
            $data->save();

            $data= new HR_hr_employee_job_detail;
            $data->emp_id=$a->employee_id;
            $data->position=$request->EmpPosition;
            $data->department=$request->EmpDepartment;
            $data->cost_center=$request->EmpCostCenter;
            $data->start_date=$request->StartDate;
            $data->employment_status=$request->JobEmploymentStatus;
            $data->status_effectve_date=$request->JobStatusEffectivity;
            $data->daily_hour=$request->DailyHour;
            $data->employee_type=$request->EmployeeType;
            $data->rohq=$request->ROHQ;
            $data->consultant=$request->Consultant;
            $data->tin_number=$request->JobTIN;
            $data->philhealth_number=$request->HobPH;
            $data->sss_number=$request->JobSSS;
            $data->hdmf_number=$request->JobHDMF;
            $data->prc_license=$request->JobPRC;
            $data->passport=$request->JobPassport;
            $data->sl="";
            $data->vl="";
            $data->leave_credit="";
            $data->schedule_type=$request->ScheduleType;
            $data->no_of_hours_to_work  =$request->NoOfHoursWork;
            $data->report_to=$request->ReportTo;
            $data->atc_s=$request->ATC1600;
            $data->atc_se=$request->ATC1601E;
            $data->atc_sf=$request->ARC1601F;
            $data->atc_swat=$request->ATCSWAT;
            $data->atc_s_se=$request->ATC1604E_3;
            $data->atc_s_ss=$request->ATC1604E_4;
            $data->atc_s_cf_status_code=$request->Status_Code_1604CF;
            $data->atc_s_cf_V=$request->ATC1604CF_5;
            $data->atc_s_cf_VI=$request->ATC1604CF_6;
            $data->region=$request->Region_1604CF;
            $data->save();

            $data = new HR_hr_employee_leavemanagement;
            $data->emp_id=$a->employee_id;
            $data->pat_mat_credit=$request->MatPatLeave;
            $data->sick_credit=$request->SickLeave;
            $data->leave_credit=$request->JobLeaveCredit;
            $data->vacation_leave=$request->JobVL;
            
            $data->pat_mat_rem=$request->MatPatLeave;
            $data->sick_credit_rem=$request->SickLeave;
            $data->leave_credit_rem=$request->JobLeaveCredit;
            $data->vacation_credit_rem=$request->JobVL;
            $data->save();
            
            $data = new HR_hr_employee_schedule_detail;
            $data->emp_id=$a->employee_id;
            $data->day_id='1';
            $data->core_from=$request->SundayShiftFrom;
            $data->core_to=$request->SundayShiftto;
            $data->break_start=$request->SundayBreakStart;
            $data->break_end=$request->SundayBreakEnd;
            $data->is_rest_day=$request->SundayRestDay;
            $data->save();

            $data = new HR_hr_employee_schedule_detail;
            $data->emp_id=$a->employee_id;
            $data->day_id='2';
            $data->core_from=$request->MondayShiftFrom;
            $data->core_to=$request->MondayShiftto;
            $data->break_start=$request->MondayBreakStart;
            $data->break_end=$request->MondayBreakEnd;
            $data->is_rest_day=$request->MondayRestDay;
            $data->save();

            $data = new HR_hr_employee_schedule_detail;
            $data->emp_id=$a->employee_id;
            $data->day_id='3';
            $data->core_from=$request->TuesdayShiftFrom;
            $data->core_to=$request->TuesdayShiftto;
            $data->break_start=$request->TuesdayBreakStart;
            $data->break_end=$request->TuesdayBreakEnd;
            $data->is_rest_day=$request->TuesdayRestDay;
            $data->save();

            $data = new HR_hr_employee_schedule_detail;
            $data->emp_id=$a->employee_id;
            $data->day_id='4';
            $data->core_from=$request->WednesdayShiftFrom;
            $data->core_to=$request->WednesdayShiftto;
            $data->break_start=$request->WednesdayBreakStart;
            $data->break_end=$request->WednesdayBreakEnd;
            $data->is_rest_day=$request->WednesdayRestDay;
            $data->save();

            $data = new HR_hr_employee_schedule_detail;
            $data->emp_id=$a->employee_id;
            $data->day_id='5';
            $data->core_from=$request->ThursdayShiftFrom;
            $data->core_to=$request->ThursdayShiftto;
            $data->break_start=$request->ThursdayBreakStart;
            $data->break_end=$request->ThursdayBreakEnd;
            $data->is_rest_day=$request->ThursdayRestDay;
            $data->save();

            $data = new HR_hr_employee_schedule_detail;
            $data->emp_id=$a->employee_id;
            $data->day_id='6';
            $data->core_from=$request->FridayShiftFrom;
            $data->core_to=$request->FridayShiftto;
            $data->break_start=$request->FridayBreakStart;
            $data->break_end=$request->FridayBreakEnd;
            $data->is_rest_day=$request->FridayRestDay;
            $data->save();

            $data = new HR_hr_employee_schedule_detail;
            $data->emp_id=$a->employee_id;
            $data->day_id='7';
            $data->core_from=$request->SaturdayShiftFrom;
            $data->core_to=$request->SaturdayShiftto;
            $data->break_start=$request->SaturdayBreakStart;
            $data->break_end=$request->SaturdayBreakEnd;
            $data->is_rest_day=$request->SaturdayRestDay;
            $data->save();
            //asset_attachment
            if ($request->hasFile('asset_attachment')) {
                $path = public_path('storage/employee_file/'.$a->employee_id);
   
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                foreach($request->asset_attachment as $file){
                    $file->storeAs('public/employee_file/'.$a->employee_id, $file->getClientOriginalName());
                }
                // $request->ImgUpp->storeAs('public/employee_file/', $request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension());
                // //$a->hdmf_cal_loan=$request->ORHDMFCalamityLoan1.".".$request->ImgUpp->getClientOriginalExtension();
                // $a->photofilename=$request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension();
            }
            return redirect('add_employee')->with( ['result_data' => '1'] );
        }else{
            return redirect('add_employee')->with( ['result_data' => '0'] );
        }
        
    }
    public function update_employee_data(Request $request){
        
        $a=HR_hr_employee_info::find($request->EmpID);
        if(!empty($a)){
            $a->company_id=$request->EmpBIOID;
            $a->biometrics_id=$request->BiometricsID;
            $a->fname=$request->FName;
            $a->mname=$request->MName;
            $a->lname=$request->LName;
            $a->gender=$request->Gender;
            $a->civil_status=$request->CS;
            $a->date_of_birth=$request->DATE;
            $a->address=$request->EmpAddress;
            
            $a->lock_user=$request->EmpLockUser;
            if ($request->hasFile('ImgUpp')) {
                $request->ImgUpp->storeAs('public/employee_photo/', $request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension());
                //added comment
                $a->photofilename=$request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension();
                
            }
            if($a->save()){
                for ($i=1; $i <=2 ; $i++) { 
                    $data= HR_hr_employee_emergency_contact::find($request->input('emergency_contact_id'.$i));
                    $data->emp_id=$a->employee_id;
                    $data->phone_number=$request->input('PhoneNumber'.$i);
                    $data->contact_person=$request->input('ContactPerson'.$i);
                    $data->relationship=$request->input('Relation'.$i);
                    $data->address=$request->input('AddressContact'.$i);
                    $data->save();
                }
                for ($i=1; $i <=2 ; $i++) { 
                    $data=HR_hr_employee_alt_contact::find($request->input('alt_contact_id'.$i));
                    $data->emp_id=$a->employee_id;
                    $data->phone_number=$request->input('AltPhoneContact'.$i);
                    $data->contact_person=$request->input('AltPersonContact'.$i);
                    $data->type=$request->input('AltTypeContact'.$i);
                    $data->save();
                }
                for ($i=1; $i <=2 ; $i++) { 
                    $data=HR_hr_employee_email::find($request->input('EmailID'.$i));
                    $data->emp_id=$a->employee_id;
                    $data->email=$request->input('Emailnumber'.$i);
                    $data->type=$request->input('EmailType'.$i);
                    $data->save();
                }

                for ($i=1; $i <=$request->SchoolFieldCount ; $i++) {
                    $data=HR_hr_employee_education::find($request->input('EDUCHIDDEN'.$i));
                    if(empty($data)){
                        $data = new HR_hr_employee_education;
                        if($request->input('SCHOOL'.$i)!=''){
                            $data->emp_id=$a->employee_id;
                            $data->type=$request->input('EDUCType'.$i);
                            $data->school_name=$request->input('SCHOOL'.$i);
                            $data->study_from=$request->input('FROM'.$i);
                            $data->study_to=$request->input('TO'.$i);
                            $data->degree=$request->input('DEGREE'.$i);
                            $data->save();   
                        }
                    }else{
                        $data->emp_id=$a->employee_id;
                        $data->type=$request->input('EDUCType'.$i);
                        $data->school_name=$request->input('SCHOOL'.$i);
                        $data->study_from=$request->input('FROM'.$i);
                        $data->study_to=$request->input('TO'.$i);
                        $data->degree=$request->input('DEGREE'.$i);
                        $data->save();  
                    }
                    
                }
                for ($i=1; $i <=$request->TrainingFieldCount ; $i++) {
                    $data=HR_hr_employee_trainer::find($request->input('TrainingHidden'.$i));
                    if(empty($data)){
                        $data=new HR_hr_employee_trainer;
                        if($request->input('TrainingName'.$i)!=''){
                            $data->emp_id=$a->employee_id;
                            $data->training_date=$request->input('TrainingDate'.$i);
                            $data->training_name=$request->input('TrainingName'.$i);
                            $data->instructor=$request->input('Instructor'.$i);
                            $data->training_nature=$request->input('Nature'.$i);
                            $data->training_cost=$request->input('TrainingCost'.$i);
                            $data->training_returningserviceperiod=$request->input('Returning'.$i);
                            $data->correspondingamount=$request->input('Corresponding'.$i);
                            $data->training_note=$request->input('Note'.$i);
                            $data->save();
                        }
                    }else{
                        $data->emp_id=$a->employee_id;
                        $data->training_date=$request->input('TrainingDate'.$i);
                        $data->training_name=$request->input('TrainingName'.$i);
                        $data->instructor=$request->input('Instructor'.$i);
                        $data->training_nature=$request->input('Nature'.$i);
                        $data->training_cost=$request->input('TrainingCost'.$i);
                        $data->training_returningserviceperiod=$request->input('Returning'.$i);
                        $data->correspondingamount=$request->input('Corresponding'.$i);
                        $data->training_note=$request->input('Note'.$i);
                        $data->save();
                    }
                    
                    
                }
                for ($i=1; $i <=$request->SeminarFieldCount ; $i++) {
                    $data=HR_hr_employee_seminar::find($request->input('SEMINARHIDDEN'.$i));
                    if(empty($data)){
                        $data= new HR_hr_employee_seminar;
                        if($request->input('SName'.$i)!=''){
                            $data->emp_id=$a->employee_id;
                            $data->seminar_date=$request->input('SDate'.$i);
                            $data->seminar_name=$request->input('SName'.$i);
                            $data->instructor=$request->input('SIns'.$i);
                            $data->seminar_nature=$request->input('SNature'.$i);
                            $data->seminar_cost=$request->input('SCost'.$i);
                            $data->seminar_returningserviceperiod=$request->input('SReturning'.$i);
                            $data->correspondingamount=$request->input('SCorresponding'.$i);
                            $data->seminar_note=$request->input('SNote'.$i);
                            $data->save();
                        }
                    }else{
                        $data->emp_id=$a->employee_id;
                        $data->seminar_date=$request->input('SDate'.$i);
                        $data->seminar_name=$request->input('SName'.$i);
                        $data->instructor=$request->input('SIns'.$i);
                        $data->seminar_nature=$request->input('SNature'.$i);
                        $data->seminar_cost=$request->input('SCost'.$i);
                        $data->seminar_returningserviceperiod=$request->input('SReturning'.$i);
                        $data->correspondingamount=$request->input('SCorresponding'.$i);
                        $data->seminar_note=$request->input('SNote'.$i);
                        $data->save();
                    }
                    
                    
                }

                $data=HR_hr_employee_salary_detail::find($request->SalaryIDHidden);
                $data->emp_id=$a->employee_id;
                $data->workdayperyear=$request->WorkDaysPerYear;
                $data->ot_com_table=$request->OTComputationTable;
                $data->pagibigcont=$request->PagibigContribution;
                $data->minwage=$request->MinimumWage;
                $data->basic_salary=$request->BasicSalary;
                $data->sss_contribution=$request->SSSContribution;
                $data->add_pagibig_cont=$request->AdditionalPagibigContribution;
                $data->ecola=$request->ECOLAINPUT;
                $data->deminimis_total=$request->Deminimistotal;
                $data->philhealth_contribution=$request->PhilhealthContribution;
                $data->bank=$request->BankName;
                $data->bank_type=$request->BankType;
                $data->bank_acc_number=$request->BankAccNumber;
                $data->meal_allowance=$request->MealAllowance;
                $data->mobile_allowance=$request->MobileAllowance;
                $data->cash_allowance=$request->CashAllowance;
                $data->travel_allowance=$request->TravelAllowance;
                $data->save();

                $data=HR_hr_employee_job_detail::find($request->JobDetailHidden);
                $data->emp_id=$a->employee_id;
                $data->position=$request->EmpPosition;
                $data->department=$request->EmpDepartment;
                $data->cost_center=$request->EmpCostCenter;
                $data->start_date=$request->StartDate;
                $data->employment_status=$request->JobEmploymentStatus;
                $data->status_effectve_date=$request->JobStatusEffectivity;
                $data->daily_hour=$request->DailyHour;
                $data->employee_type=$request->EmployeeType;
                $data->rohq=$request->ROHQ;
                $data->consultant=$request->Consultant;
                $data->tin_number=$request->JobTIN;
                $data->philhealth_number=$request->HobPH;
                $data->sss_number=$request->JobSSS;
                $data->hdmf_number=$request->JobHDMF;
                $data->prc_license=$request->JobPRC;
                $data->passport=$request->JobPassport;
                $data->sl="";
                $data->vl="";
                $data->leave_credit="";
                $data->schedule_type=$request->ScheduleType;
                $data->no_of_hours_to_work  =$request->NoOfHoursWork;
                $data->report_to=$request->ReportTo;
                $data->atc_s=$request->ATC1600;
                $data->atc_se=$request->ATC1601E;
                $data->atc_sf=$request->ARC1601F;
                $data->atc_swat=$request->ATCSWAT;
                $data->atc_s_se=$request->ATC1604E_3;
                $data->atc_s_ss=$request->ATC1604E_4;
                $data->atc_s_cf_status_code=$request->Status_Code_1604CF;
                $data->atc_s_cf_V=$request->ATC1604CF_5;
                $data->atc_s_cf_VI=$request->ATC1604CF_6;
                $data->region=$request->Region_1604CF;
                $data->save();

                $data =HR_hr_employee_leavemanagement::find($request->LeaveManagementIDHidden);
                $data->emp_id=$a->employee_id;
                $data->pat_mat_rem=$request->MatPatLeave;
                $data->sick_credit_rem=$request->SickLeave;
                $data->leave_credit_rem=$request->JobLeaveCredit;
                $data->vacation_credit_rem=$request->JobVL;
                $data->save();

                $data =HR_hr_employee_schedule_detail::find($request->SundayScheduleIDHidden);
                $data->emp_id=$a->employee_id;
                $data->core_from=$request->SundayShiftFrom;
                $data->core_to=$request->SundayShiftto;
                $data->break_start=$request->SundayBreakStart;
                $data->break_end=$request->SundayBreakEnd;
                $data->is_rest_day=$request->SundayRestDay;
                $data->save();

                $data = HR_hr_employee_schedule_detail::find($request->MondayScheduleIDHidden);
                $data->emp_id=$a->employee_id;
                $data->core_from=$request->MondayShiftFrom;
                $data->core_to=$request->MondayShiftto;
                $data->break_start=$request->MondayBreakStart;
                $data->break_end=$request->MondayBreakEnd;
                $data->is_rest_day=$request->MondayRestDay;
                $data->save();

                $data =HR_hr_employee_schedule_detail::find($request->TuesdayScheduleIDHidden);
                $data->emp_id=$a->employee_id;
                $data->core_from=$request->TuesdayShiftFrom;
                $data->core_to=$request->TuesdayShiftto;
                $data->break_start=$request->TuesdayBreakStart;
                $data->break_end=$request->TuesdayBreakEnd;
                $data->is_rest_day=$request->TuesdayRestDay;
                $data->save();

                $data =HR_hr_employee_schedule_detail::find($request->WednesdayScheduleIDHidden);
                $data->emp_id=$a->employee_id;
                $data->core_from=$request->WednesdayShiftFrom;
                $data->core_to=$request->WednesdayShiftto;
                $data->break_start=$request->WednesdayBreakStart;
                $data->break_end=$request->WednesdayBreakEnd;
                $data->is_rest_day=$request->WednesdayRestDay;
                $data->save();

                $data = HR_hr_employee_schedule_detail::find($request->ThrusdayScheduleIDHidden);
                $data->emp_id=$a->employee_id;
                $data->core_from=$request->ThursdayShiftFrom;
                $data->core_to=$request->ThursdayShiftto;
                $data->break_start=$request->ThursdayBreakStart;
                $data->break_end=$request->ThursdayBreakEnd;
                $data->is_rest_day=$request->ThursdayRestDay;
                $data->save();

                $data =HR_hr_employee_schedule_detail::find($request->FridayScheduleIDHidden);
                $data->emp_id=$a->employee_id;
                $data->core_from=$request->FridayShiftFrom;
                $data->core_to=$request->FridayShiftto;
                $data->break_start=$request->FridayBreakStart;
                $data->break_end=$request->FridayBreakEnd;
                $data->is_rest_day=$request->FridayRestDay;
                $data->save();

                $data =HR_hr_employee_schedule_detail::find($request->SaturdayScheduleIDHidden);
                $data->emp_id=$a->employee_id;
                $data->core_from=$request->SaturdayShiftFrom;
                $data->core_to=$request->SaturdayShiftto;
                $data->break_start=$request->SaturdayBreakStart;
                $data->break_end=$request->SaturdayBreakEnd;
                $data->is_rest_day=$request->SaturdayRestDay;
                $data->save();
                if ($request->hasFile('asset_attachment')) {
                    $path = public_path('storage/employee_file/'.$a->employee_id);
       
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }

                    foreach($request->asset_attachment as $file){
                        $file->storeAs('public/employee_file/'.$a->employee_id, $file->getClientOriginalName());
                    }
                    // $request->ImgUpp->storeAs('public/employee_file/', $request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension());
                    // //$a->hdmf_cal_loan=$request->ORHDMFCalamityLoan1.".".$request->ImgUpp->getClientOriginalExtension();
                    // $a->photofilename=$request->EmpBIOID.".".$request->ImgUpp->getClientOriginalExtension();
                }
                return redirect('view_employee?id='.$request->EmpID)->with( ['result_data' => '1'] );
            }else{
                return redirect('view_employee?id='.$request->EmpID)->with( ['result_data' => '0'] );
            }
        }
        //return redirect('view_employee')->with( ['result_data' => '1'] );   
    }
    public function add_emp_memo(Request $request){
        //HR_hr_memo
        $a = new HR_hr_memo;
        $a->memo_title=$request->TitleMemo;
        $a->memo_employee=$request->EmployeeMemo;
        $a->memo_date_recieved=$request->DateReievedMemo;
        $a->memo_offense_level=$request->OffenseLevelMemo;
        $a->memo_da_type=$request->DATypeMemo;
        $a->memo_violation_category=$request->ViolationMemo;
        $a->memo_slide_date=$request->SlideDateMemo;
        $a->memo_note=$request->NoteMemo;
        $a->save();
    }
    public function upload_emp_memo(Request $request){
        if ($request->hasFile('MemoFile')) {
            $a = new HR_hr_memo;
            $a->memo_offense_level="Uploaded Memo File";

            $path = public_path('storage/emp_memo/');

            
            $a->save();
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $data =HR_hr_memo::find($a->memo_id);
            $request->MemoFile->storeAs('public/emp_memo/', $data->memo_id.".".$request->MemoFile->getClientOriginalExtension());
            $data->memo_violation_category=$data->memo_id.".".$request->MemoFile->getClientOriginalExtension();
            $data->save();
            return redirect('memo')->with( ['result_data' => '1'] );
        }
    }
    public function update_emp_memo(Request $request){
        $data =HR_hr_memo::find($request->id);
        $data->data_status="1";
        $data->save();
    }
    public function get_emp_memo_data(Request $request){
        return HR_hr_memo::find($request->id);
    }
    public function check_form_template_name(Request $request){
        $data=HR_hr_form_template::where([['form_template_name','=',$request->TemplateName]])->get();
        return count($data);
    }
    public function add_form_template(Request $request){
        $a=new HR_hr_form_template;
        $a->form_template_name=$request->TemplateFormName;
        $a->form_template_content=$request->Templatetextarea;
        $a->save();
    }
    public function get_required_field_form_generator(Request $request){
        $a=HR_hr_form_template::find($request->id);
        $content=$a->form_template_content;
        $company="";
        $department="";
        $reason="";
        $employee="";
        if (strpos($content, '{COMPANY}') !== false) {
            $company="1";
        }
        if (strpos($content, '{DEPARTMENT}') !== false) {
            $department="1";
        }
        if (strpos($content, '{EMPLOYEE}') !== false) {
            $employee="1";
        }
        if (strpos($content, '{REASON}') !== false) {
            $reason="1";
        }
        $required_fields=array($company,$department,$employee,$reason,$content);
        return $required_fields;
    }
    public function add_cash_advance(Request $request){
        // use App\HR_hr_cash_advances;
        // use App\HR_cash_advance_loan_type;
        $a=new HR_hr_cash_advances;
        $a->loan_type=$request->Loan_tpye;
        $a->emp_id=$request->employee_lending;
        $a->lender_id=$request->employee_lender;
        $a->date_of_request=$request->request_date;
        $a->start_of_deduction=$request->start_deduc;
        $a->end_of_deduction=$request->end_deduc;
        $a->total_amount=$request->amount_lend;
        $a->pay_period=$request->pay_period;
        $a->pay_amount_per_period=$request->pay_amount_per_pperios;
        $a->balance=$request->amount_lend;
        $a->save();

        $data=HR_cash_advance_loan_type::where([['laon_type','=',$request->Loan_tpye]])->get();
        if(count($data)==0){
            $a=new HR_cash_advance_loan_type;
            $a->laon_type=$request->Loan_tpye;
            $a->save();
        }
    }
    public function get_cash_advance_data(Request $request){

        return HR_hr_cash_advances::find($request->id);
    }
    public function get_attendance_today_by_department(Request $request){
        $employee_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_info 
        JOIN
        hr_employee_job_detail ON hr_employee_info.employee_id=hr_employee_job_detail.emp_id
        JOIN
        hr_employee_salary_detail ON hr_employee_info.employee_id=hr_employee_salary_detail.emp_id
        JOIN
        hr_company_department ON hr_company_department.department_id=hr_employee_job_detail.department
        JOIN 
        hr_company_cost_center ON hr_company_cost_center.cost_center_id=hr_employee_job_detail.cost_center");
        $tablecontent="";
        $tablecontent.="<tbody id='attendance_today_tbody'>";
        foreach($employee_list as $item){
            $tablecontent.="<tr>";
            $tablecontent.="<td>";
            $tablecontent.="";
            $tablecontent.="</td>";
            $tablecontent.="<td>";
            $tablecontent.=$item->fname." ".$item->lname;
            $tablecontent.="</td>";
            $tablecontent.="<td>";
            $tablecontent.="";
            $tablecontent.="</td>";
            $tablecontent.="<td>";
            $tablecontent.="";
            $tablecontent.="</td>";
            $tablecontent.="<td>";
            $tablecontent.="";
            $tablecontent.="</td>";
            $tablecontent.="</tr>";
        }
        $tablecontent.="</tbody>";
        return $tablecontent;
    }
    public function add_new_payroll(Request $request){
        // use App\HR_payroll;
        // use App\HR_hr_employee_salary;

        $data= HR_payroll::where([
            ['payroll_year','=',$request->PayrollYear],
            ['payroll_month','=',$request->PayrollMonth],
            ['period','=',$request->PayrollPeriod],
            ['employee_type','=',$request->EmployeeType],
            ['payroll_type','=',$request->PayrollType]
        ])->get();
        if(count($data)==0){
            $a=new HR_payroll;
            $a->payroll_year=$request->PayrollYear;
            $a->payroll_month=$request->PayrollMonth;
            $a->employee_type=$request->EmployeeType;
            $a->period=$request->PayrollPeriod;
            $a->description=$request->PayrollDescription;
            $a->payroll_type=$request->PayrollType;
            $a->transaction_date=$request->PayrollTransactionDate;
            $a->transaction_from=$request->PayrollFrom;
            $a->transaction_to=$request->PayrollTo;
            $a->com_phic=$request->ComputePHIC;
            $a->com_sss=$request->ComputeSSS;
            $a->com_pagibig=$request->ComputePagibig;
            $a->com_tax=$request->ComputeTax;
            $a->com_end_of_month=$request->ForceEnd;
            $a->use_annual_calculation=$request->UseAnnualCal;
            if($a->save()){
                
                if($request->EmployeeType=="Both"){
                    $data= HR_hr_employee_job_detail::all();
                }else{
                    $data= HR_hr_employee_job_detail::where([
                        ['employee_type','=',$request->EmployeeType]
                    ])->get();
                }
                
                foreach($data as $emp){
                    $cash = new HR_hr_employee_salary;
                    $cash->emp_id=$emp->emp_id;
                    $cash->payroll_id=$a->payroll_id;

                    
                    $exclude=1;
                    $result=DB::connection('mysql')->select("SELECT * FROM hr_a_asset_request WHERE emp_id='$emp->emp_id' AND (request_status='2' OR request_status='1.1')");
                    foreach($result as $re){
                        $date1=date_create($re->asset_due_date);
						$date2=date_create(date("Y-m-d"));
						$diff=date_diff($date1,$date2);
                        $result2=$diff->format("%R");
                        if($result2=="-"){
                            $exclude=1;
                        }else{
                            $exclude=0;
                            break;
                        }
                    }
                    $cash->salary_status=$exclude;
                    $cash->salary_initial_status=$exclude;
                    $cash->save();
                }
                return 1;
            }
        }else{
            return 0;
        }
        
    }
    public function get_payroll_employees(Request $request){
        $content='<div class="row" id="PayrollEmployeeListDiv">';
            $content.='<div class="col-md-6">';
                $content.='<table class="table table-bordered table-hover" style="background-color:white;margin-top:10px;">';
                $content.='<thead style="background-color:#124f62; color:white;">';
                $content.='<tr><th colspan="5" style="text-align:center;">Employee for this Payroll</th></tr>';
                $content.='<tr ><th  width="9%"></th>';
                $content.='<th width="9%" style="text-align:center;">ID</th><th width="40%" style="text-align:center;">Name</th><th width="10%" style="text-align:center;">Status</th>';
                $content.='</tr></thead>';
                $content.='<tbody >';
                $result= DB::connection('mysql')->select("SELECT * FROM hr_employee_salary
                        JOIN 
                        hr_employee_info ON hr_employee_info.employee_id=hr_employee_salary.emp_id
                        WHERE payroll_id='$request->id' AND salary_status='1'");
                foreach($result as $data){
                    $content.='<tr id="Employee'.$data->salary_id.'" onclick="ClickRow(\'Employee'.$data->salary_id.'\',\''.$data->salary_id.'\')">';
                        $content.='<td>';
                        $content.='<button class="btn btn-primary" onclick="SETAdjustmentEmployeee(\''.$data->salary_id.'\',\''.$data->emp_id.'\',\''.ucwords(strtolower($data->lname.", ".$data->fname." ".$data->mname)).'\')">Adjustment</button>';
                        $content.='</td>';
                        $content.='<td>';
                        $content.=$data->emp_id;
                        $content.='</td>';
                        $content.='<td>';
                        $content.=$data->lname.", ".$data->fname." ".$data->mname;
                        $content.='</td>';
                        $content.='<td>';
                        $result=DB::connection('mysql')->select("SELECT * FROM hr_a_asset_request WHERE emp_id='$data->emp_id' AND (request_status='2' OR request_status='1.1')");
                        foreach($result as $re){
                            $date1=date_create($re->asset_due_date);
                            $date2=date_create(date("Y-m-d"));
                            $diff=date_diff($date1,$date2);
                            $result2=$diff->format("%R");
                            if($result2=="-"){
                                
                            }else{
                                $content.='<button class="btn  btn-danger"><span class="glyphicon glyphicon-flag"></span></button>';
                                break;
                            }
                        }
                        
                        $content.='</td>';
                    $content.='</tr>';
                }
                $content.='</tbody></table>';
            $content.='</div>';
            $content.='<div class="col-md-1">';
                $content.='<table class="table borderless " >';
                $content.='<thead style="color:white;"><tr><th></th></tr><tr><th width="5%" style="text-align:center;"></th></tr></thead>';
                $content.='<tbody >';
                $content.='<tr><td style="vertical-align: middle;text-align:center;"><button class="btn btn-outline-dark" id="ForwardEmployee" disabled="" onclick="ForwardEmployeeStatus()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button></td></tr> ';
                $content.='<tr><td style="vertical-align: middle;text-align:center;"><button class="btn btn-outline-dark" id="BackwardEmployee" disabled="" onclick="BackwardEmployeeStatus()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></button></td></tr> ';
                $content.='</tbody >';
                $content.='</table >';
            $content.='</div >';
            $content.='<div class="col-md-5">';
                $content.='<table class="table table-bordered table-hover" style="background-color:white;margin-top:10px;">';
                $content.='<thead style="background-color:#124f62; color:white;">';
                $content.='<tr><th colspan="5" style="text-align:center;">Excluded Employee</th></tr>';
                $content.='<tr ><th  width="9%"></th>';
                $content.='<th width="9%" style="text-align:center;">ID</th><th width="40%" style="text-align:center;">Name</th><th width="10%" style="text-align:center;">Status</th>';
                $content.='</tr></thead>';
                $content.='<tbody >';
                $result= DB::connection('mysql')->select("SELECT * FROM hr_employee_salary
                        JOIN 
                        hr_employee_info ON hr_employee_info.employee_id=hr_employee_salary.emp_id
                        WHERE payroll_id='$request->id' AND salary_status='0'");
                foreach($result as $data){
                    $content.='<tr id="Employee2'.$data->salary_id.'" onclick="ClickRow2(\'Employee2'.$data->salary_id.'\',\''.$data->salary_id.'\')">';
                        $content.='<td>';
                        
                        $content.='</td>';
                        $content.='<td>';
                        $content.=$data->emp_id;
                        $content.='</td>';
                        $content.='<td>';
                        $content.=$data->lname.", ".$data->fname." ".$data->mname;
                        $content.='</td>';
                        $content.='<td>';
                        $result=DB::connection('mysql')->select("SELECT * FROM hr_a_asset_request WHERE emp_id='$data->emp_id' AND (request_status='2' OR request_status='1.1')");
                        foreach($result as $re){
                            $date1=date_create($re->asset_due_date);
                            $date2=date_create(date("Y-m-d"));
                            $diff=date_diff($date1,$date2);
                            $result2=$diff->format("%R");
                            if($result2=="-"){
                                
                            }else{
                                $content.='<button class="btn  btn-danger"><span class="glyphicon glyphicon-flag"></span></button>';
                                break;
                            }
                        }
                        
                        $content.='</td>';
                    $content.='</tr>';
                }
                $content.='</tbody></table>';
            $content.='</div>';
        $content.='</div >';
        
        
        $content.="";
        return $content;
    }
    public function update_payroll_employee(Request $request){
        $data=HR_hr_employee_salary::find($request->id);
        $data->salary_status=$request->status;
        $data->save();
    }
    public function get_employee_adjustment(Request $request){
        $data=HR_Company_reference_hr_payroll_company_adjustment::find($request->id);
        return $data;
    }
    public function add_employee_salary_adjustment(Request $request){
        $data=new HR_hr_employee_adjustment;
        $data->employee_adjustment_type=$request->EmpAdjAdjType;
        $data->employee_adjustment_name=$request->EmpAdjName;
        $data->employee_adjustment_code=$request->EmpAdjCode;
        $data->employee_adjustment_amount=$request->EmpAdjAmount;
        $data->employee_adjustment_apply_before=$request->EmpAdjAppliedBefore;
        $data->employee_adjustment_taxable=$request->EmpAdjTaxable;
        $data->employee_adjustment_remarks=$request->EmpAdjRemarks;
        $data->employee_adjustment_payroll_id=$request->EmpAdjSalaryID;
        $data->employee_adjustment_emp_id=$request->EmpAdjEmpID;
        $data->employee_adjustment_active="1";
        $data->save();
    }
    public function get_employee_data(Request $request){
        return HR_hr_employee_adjustment::find($request->id);
    }
    public function update_employee_salary_adjustment(Request $request){
        $data= HR_hr_employee_adjustment::find($request->EmpAdjSalaryIDEdit);
        $data->employee_adjustment_name=$request->EmpAdjNameEdit;
        $data->employee_adjustment_code=$request->EmpAdjCodeEdit;
        $data->employee_adjustment_amount=$request->EmpAdjAmountEdit;
        $data->employee_adjustment_type=$request->EmpAdjAdjTypeEdit;
        $data->employee_adjustment_apply_before=$request->EmpAdjAppliedBeforeEdit;
        $data->employee_adjustment_taxable=$request->EmpAdjTaxableEdit;
        $data->employee_adjustment_remarks=$request->EmpAdjRemarksEdit;
        $data->save();
    }
    public function disable_employee_saary_adjustment(Request $request){
        $data= HR_hr_employee_adjustment::find($request->id);
        $data->employee_adjustment_active="0";
        $data->save();
    }
}
