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
use DateTime;
use DatePeriod;
use DateInterval;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\HR_hr_cash_advances_payment;
class FormController extends Controller
{
    public function update_company_setup_data(Request $request){
        $company = HR_Company_Basic_Info::first();
        if(!empty($company)){
            //added comment via github editorr

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
                                $content.='<button class="btn  btn-danger"><i class="fa fa-flag" aria-hidden="true"></i></button>';
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
                                $content.='<button class="btn  btn-danger"><i class="fa fa-flag" aria-hidden="true"></i></button>';
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
    public function review_payroll(Request $request){
        //load spreadsheet
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("extra/import_file/payroll_report_template.xlsx");

        //change it
        $sheet = $spreadsheet->getActiveSheet();
        
        $index=2;
        $Sel=$request->id;
        $tablecontent='<div class="row" id="ReviewAndProcessTable" style="margin-top:10px;">
        <div class="col-md-12">
            <table class="table table-bordered table-sm" style="background-color:white;">
                <thead style="background-color:#124f62; color:white;">
                  <tr>
                    <th>ID</th><th>Name</th><th>Period</th><th>Basic</th><th>DeMinimis</th><th>OT / Rest Day Pay</th>
                    <th>Abs & Late</th><th>SSS</th><th>PhilHealth</th>
                    <th>Pag-ibig</th><th>Tax</th><th>Adj(+)</th>
                    <th>Adj(-)</th><th>Net Amount</th>
                  </tr>
                </thead>
                <tbody >';
        
        $a=HR_Company_payroll_computation::first();
        $numofdayspermonth=$a->work_day_per_month;
        $employee_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_info 
        JOIN 
        hr_employee_salary ON hr_employee_info.employee_id=hr_employee_salary.emp_id 
        JOIN hr_payroll ON hr_payroll.payroll_id=hr_employee_salary.payroll_id 
        JOIN hr_employee_salary_detail ON hr_employee_salary_detail.emp_id=hr_employee_info.employee_id 
        WHERE hr_employee_salary.payroll_id='$Sel' AND hr_employee_salary.salary_status='1'");
        foreach($employee_list as $rows2){
            if($rows2->payroll_type=="Normal Payroll"){
                $Basic=$rows2->basic_salary;
                $PhilhealthCal=0;
                if($rows2->philhealth_contribution==0){
						
                }else{
                    if($rows2->philhealth_contribution==1){
                        if($rows2->com_phic==1){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                            $PhilhealthCal=$PhilhealthCal/2;
                        }
                        if($rows2->com_phic==2){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                        }
                    }else{
                        if($rows2->com_phic==1){
                            
                            $PhilhealthCal=$rows2->philhealth_contribution/2;
                        }
                        if($rows2->com_phic==2){
                            $PhilhealthCal=$rows2->philhealth_contribution;
                        }
                    }
                }
                $SSSCal=0;
					
				$getsss=HR_Company_reference_sss_table::all();
				if($rows2->com_sss==1){
                    //echo "SSS : ".$rows2->sss_contribution." scan";
					$SSSCal=$rows2->sss_contribution;
					if($SSSCal=="Let System Decide"){
						foreach($getsss as $result){
							$min=$result->min_range;
							$max=$result->max_range;
							if($Basic>=$min && $Basic<=$max){		
								$SSSCal=$result->ss_ee;
							}
						}	
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
					$SSSCal=$SSSCal/2;
                }
                if($rows2->com_sss==2){
                    $SSSCal=$rows2->sss_contribution;
                    //echo "<-".$rows2->emp_id."->Basic: <".$Basic."> SSS : ".$SSSCal."==Let System Decide"." scan2";
                    
                    if($SSSCal=="Let System Decide"){
                        foreach($getsss as $result){
                            $min=$result->min_range;
                            $max=$result->max_range;
                            if($Basic>=$min && $Basic<=$max){
                                $SSSCal=$result->ss_ee;
                            }
                        }
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
                }
                $PagibigCal=0;
				if($rows2->com_pagibig==1){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
					$PagibigCal=$PagibigCal/2;
				}
				if($rows2->com_pagibig==2){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
				}
                $TaxCal=0;
				if($rows2->com_tax==1){
                    $tableget=HR_Company_reference_tax_tax_table::find(4);
                        $one=$tableget->one;
						$two=$tableget->two;
						$three=$tableget->three;
						$four=$tableget->four;
						$five=$tableget->five;
						$six=$tableget->six;
						if($rows2->basic_salary<$one){
							
							
						}
						if($rows2->basic_salary<$two){
							$TaxCal=0;
							
						}
						if($rows2->basic_salary>=$two && $rows2->basic_salary<$three){
							$TaxCal=(20/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$three && $rows2->basic_salary<$four){
							$TaxCal=(25/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$four && $rows2->basic_salary<$five){
							$TaxCal=(30/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$five && $rows2->basic_salary<$six){
							$TaxCal=(32/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$six){
							$TaxCal=(35/100)*$rows2->basic_salary;	
						}
                    

                }
                $TransactionFROM=$rows2->transaction_from;
				$TransactionTO=$rows2->transaction_to;
				$AdjPlus=0;
				$AdjNeg=0;
				$EMPIID=$rows2->employee_id;
				$SALARYID=$rows2->salary_id;
                $get_adjustment = DB::connection('mysql')->select("SELECT * FROM hr_employee_adjustment 
                                WHERE employee_adjustment_emp_id='$EMPIID' AND employee_adjustment_payroll_id='$SALARYID'  AND employee_adjustment_active='1'");
                foreach($get_adjustment as $result){
                    if($result->employee_adjustment_amount<0){
                        $AdjNeg=$AdjNeg+$result->employee_adjustment_amount;
                    }
                    if($result->employee_adjustment_amount>-1){
                        $AdjPlus=$AdjPlus+$result->employee_adjustment_amount;
                    }
                }
                $ot_com_table=$rows2->ot_com_table;
                $ot_table_rate=HR_Company_reference_hr_ot_table::where(
                    [
                        ['data_status','=',NULL],
                        ['dh_id','=',$ot_com_table]
                    ]
                )->first();
                $DeminimisAmount=$rows2->deminimis_total;
                $OTcount=0;
                $OTAmount=0;
                $EMPII=$rows2->employee_id;
                $biomentrics=$rows2->biometrics_id;
                $get_ot = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND 
                (attendance_type='Normal OT' OR attendance_type='Early OT' ) AND attendance_date BETWEEN '$TransactionFROM' AND '$TransactionTO'");
                foreach($get_ot as $result2){
                    $time1 = $result2->attendance_time_in;
					$time2 = $result2->attendance_time_out;
					$diff = abs(strtotime($time1) - strtotime($time2));
					$tmins = $diff/60;
					$hours = floor($tmins/60);
					$mins = $tmins%60;
					$OTcount=$OTcount+$hours;
					
					//echo $hours." ";
					$curdate=strtotime($result2->attendance_date);
					$Special1=strtotime(date('Y-2-16'));
					$Special2=strtotime(date('Y-2-25'));
					$Special3=strtotime(date('Y-4-14'));
					$Special4=strtotime(date('Y-8-21'));
					$Special5=strtotime(date('Y-11-01'));
					$Special6=strtotime(date('Y-11-02'));
					$Special7=strtotime(date('Y-3-31'));
					$Special8=strtotime(date('Y-12-24'));
					$Special9=strtotime(date('Y-12-31'));
					
					$Regular1=strtotime(date('Y-1-1'));
					$Regular2=strtotime(date('Y-1-2'));
					$Regular3=strtotime(date('Y-3-16'));//davao city day
					$Regular4=strtotime(date('Y-3-29'));//holy week
					$Regular5=strtotime(date('Y-3-30'));//holy week
					$Regular6=strtotime(date('Y-4-9'));
					$Regular7=strtotime(date('Y-5-1'));
					$Regular8=strtotime(date('Y-6-12'));
					$Regular9=strtotime(date('Y-8-27'));
					$Regular10=strtotime(date('Y-11-30'));
					$Regular11=strtotime(date('Y-12-25'));
					$Regular12=strtotime(date('Y-12-30'));
					
					$day = date("w", $curdate);
                    $day++;
                    $stt="NO";
                    $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                    foreach($rest_day_list as $data){
                        
						if($result2->is_rest_day==1){
							$stt="YES";
						}
						else{
							$stt="NO";
						}
                    }
                    $holiday=0;
					$daily2=$Basic/$numofdayspermonth;
					$daily=$Basic/$numofdayspermonth;
					$daily=$daily/8;
					
					if($curdate == $Special1 || $curdate == $Special2 || $curdate == $Special3 || $curdate == $Special4
					|| $curdate == $Special5 || $curdate == $Special6 || $curdate == $Special7 || $curdate == $Special8
					|| $curdate == $Special9){
                        if($stt=='YES'){
                            //special holiday rest day OT
                            $shrdot=$ot_table_rate->sh_rd_ot;
                            if($shrdot==""){
                                $shrdot=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$shrdot));
                        }
                        if($stt=='NO'){
                            //special holiday not rest day OT
                            $sh=$ot_table_rate->sh_ot;
                            if($sh==""){
                                $sh=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$sh));
                        }
                        $holiday=1;
                    }
                    else if($curdate == $Regular1 || $curdate == $Regular2 || $curdate == $Regular3 || $curdate == $Regular4 || $curdate == $Regular5 || $curdate == $Regular6 || $curdate == $Regular7 || $curdate == $Regular8
					|| $curdate == $Regular9 || $curdate == $Regular10 || $curdate == $Regular11 || $curdate == $Regular12){
                        if($stt=='YES'){
                            //regular holiday rest day OT
                            $lhrd=$ot_table_rate->lh_rd_ot;
                            if($lhrd==""){
                                $lhrd=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$lhrd));
                        }
                        if($stt=='NO'){
                            //regular holiday not rest day OT
                            $lh=$ot_table_rate->lh_ot;
                            if($lh==""){
                                $lh=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$lh));
                        }
                        $holiday=1;
                    }
                    else if($holiday==0 && $stt=="YES"){
                        // not holiday rest day OT
                        $rd=$ot_table_rate->rd_ot;
                        if($rd==""){
                            $rd=0;
                        }
                        $OTAmount=$OTAmount+($hours*($daily*$rd));
                    }else{
                        //regular OT
                        $rr=$ot_table_rate->ord_ot;
                        if($rr==""){
                            $rr=0;
                        }
                        $OTAmount=$OTAmount+($hours*($daily*$rr));
                    }
                }
                $Late=0;
				$undertimepenalty=0;
				$restdaytiminrate=0;
				$numberofminutesofundertime=0;
				$numberofminutesofundertimerestday=0;
				$numberofminutesofundertimeholiday=0;
				$numberofminutesofundertimeholidayrestday=0;
				$numberofminutesofundertimeRegularholiday=0;
				$numberofminutesofundertimeRegularholidayrestday=0;
				$begin = new DateTime( $TransactionFROM );
				$end = new DateTime($TransactionTO );
				$end = $end->modify( '+1 day' ); 
				
				$interval = new DateInterval('P1D');
				$daterange = new DatePeriod($begin, $interval ,$end);
                $AbsentCount=0;
                foreach($daterange as $date){
                    $currentDate=$date->format('Y-m-d');
                    $Special1=strtotime(date('Y-2-16'));
                    $Special2=strtotime(date('Y-2-25'));
                    $Special3=strtotime(date('Y-4-14'));
                    $Special4=strtotime(date('Y-8-21'));
                    $Special5=strtotime(date('Y-11-01'));
                    $Special6=strtotime(date('Y-11-02'));
                    $Special7=strtotime(date('Y-3-31'));
                    $Special8=strtotime(date('Y-12-24'));
                    $Special9=strtotime(date('Y-12-31'));
                    
                    $Regular1=strtotime(date('Y-1-1'));
                    $Regular2=strtotime(date('Y-1-2'));
                    $Regular3=strtotime(date('Y-3-16'));//davao city day
                    $Regular4=strtotime(date('Y-3-29'));//holy week
                    $Regular5=strtotime(date('Y-3-30'));//holy week
                    $Regular6=strtotime(date('Y-4-9'));
                    $Regular7=strtotime(date('Y-5-1'));
                    $Regular8=strtotime(date('Y-6-12'));
                    $Regular9=strtotime(date('Y-8-27'));
                    $Regular10=strtotime(date('Y-11-30'));
                    $Regular11=strtotime(date('Y-12-25'));
                    $Regular12=strtotime(date('Y-12-30'));
                    
                    $curdate2=strtotime($currentDate);

                    if($curdate2 != $Special1 && $curdate2 != $Special2 && $curdate2 != $Special3 && $curdate2 != $Special4
					&& $curdate2 != $Special5 && $curdate2 != $Special6 && $curdate2 != $Special7 && $curdate2 != $Special8
					&& $curdate2 != $Special9 && $curdate2 != $Regular1 && $curdate2 != $Regular2 && $curdate2 != $Regular3 
					&& $curdate2 != $Regular4 && $curdate2 != $Regular5 && $curdate2 != $Regular6 && $curdate2 != $Regular7 
					&& $curdate2 != $Regular8 && $curdate2 != $Regular9 && $curdate2 != $Regular10 && $curdate2 != $Regular11 
					&& $curdate2 != $Regular12){
                        $attendance_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Official Business' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                        $COUNT2=count($attendance_list);
                        if($COUNT2<1){
                            $timestamp = strtotime($currentDate);
                            $day = date('w', $timestamp);
                            $day++;
                            $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPIID' AND day_id='$day' ");
                            foreach($rest_day_list as $data){
                                if($data->is_rest_day==0){	
                                    $AbsentCount++;
                                }
                            }
                        }
                        $attendance_undertime_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                        $co=count($attendance_undertime_list);
                        if($co<1){
								
                        }else{
                            $timeins=$co;
                            $currentcount=1;
                            $numberofminute=0;
                            $attendance_timein="";
                            $attendance_timeout="";
                            foreach($attendance_undertime_list as $data){
                                if($data->attendance_time_in!="" && $data->attendance_time_out!=""){
                                    $start=$data->attendance_time_in;
                                    $end=$data->attendance_time_out;
                                    $dateStart = new DateTime($start); 
                                    $dateEnd = new DateTime($end);
                                    $dateDiff  = $dateStart->diff($dateEnd);
                                    $time    = explode(':', $dateDiff->format("%H:%I:%S"));
                                    $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                    $numberofminute=$numberofminute+$minutes;
                                    //echo $numberofminute."<br>";
                                }
                                if($currentcount==1){
                                    $attendance_timein=$data->attendance_time_in;
                                }
                                if($currentcount==$timeins){
                                    $attendance_timeout=$data->attendance_time_out;
                                }
                                
                                $currentcount++;
                            }
                            $timestamp = strtotime($currentDate);
                            $day = date('w', $timestamp);
                            $day++;
                            $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                            foreach($rest_day_list as $data){
                                $timestart=$data->core_from;
                                $timeend=$data->core_to;
                                $breakstart=$data->break_start;
                                $breakend=$data->break_end;
                                if($data->is_rest_day==0){
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    $breakstartdate = new DateTime($breakstart); 
                                    $breakenddate = new DateTime($breakend);
                                    $breakDiff  = $breakstartdate->diff($breakenddate);
                                    $breaktime    = explode(':', $breakDiff->format("%H:%I:%S"));
                                    $breakminutes = ($breaktime[0] * 60.0 + $breaktime[1] * 1.0);
                                    $strStart = $timestart;
                                    $strEnd   = $timeend; 
                                    $dteStart = new DateTime($strStart); 
                                    $dteEnd   = new DateTime($strEnd);
                                    $dteDiff  = $dteStart->diff($dteEnd);
                                    $time    = explode(':', $dteDiff->format("%H:%I:%S"));
                                    $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                    //echo $timestart." : ".$timeend."<br>";
                                    ///echo ($minutes-$breakminutes)." :".$breakminutes." - - ".($numberofminute-$breakminutes);
                                    $shedminutesminusbreak=$minutes-$breakminutes;
                                    $timeinminutesminusbreak=$numberofminute-$breakminutes;
                                    //echo "<br> time :".$timeinminutesminusbreak." >= ".$shedminutesminusbreak."<br>";
                                    //calculate 
                                    if($timeinminutesminusbreak>=$shedminutesminusbreak){
                                        
                                        $shiftstart = new DateTime($timestart); 
                                        $timeinstart = new DateTime($attendance_timein);
                                        $shiftDiff  = $shiftstart->diff($timeinstart);
                                        $shifttimediff    = explode(':', $shiftDiff->format("%H:%I:%S"));
                                        $shifttimemin = ($shifttimediff[0] * 60.0 + $shifttimediff[1] * 1.0);
                                        
                                        //$undertimepenalty
                                    }else{
                                        
                                        $lackminutes=$shedminutesminusbreak-$timeinminutesminusbreak;
                                        $lackminutes=$lackminutes-11;
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/$shedminutesminusbreak;
                                        $undertimepenalty=$lackminutes*$rateperminute;
                                        $numberofminutesofundertime=$numberofminutesofundertime+$lackminutes;
                                        //echo $numberofminutesofundertime." undetiime";
                                    }
                                }else{
                                    $rateperminute=$Basic/$numofdayspermonth;
									$rateperminute=$rateperminute/8;
									$rateperminute=$rateperminute/60;
									//Restday time in
									$rdrd=$ot_table_rate->rd;
									if($rdrd==""){
										$rdrd=0;
									}
									$rateperminute=$rateperminute*$rdrd;
									$restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
									//echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
									$numberofminutesofundertimerestday=$numberofminutesofundertimerestday+$numberofminute;
                                }
                            }
                        }

                    }else{
                        //holiday
                        if($currentDate == $Special1 || $currentDate == $Special2 || $currentDate == $Special3 || $currentDate == $Special4
						|| $currentDate == $Special5 || $currentDate == $Special6 || $currentDate == $Special7 || $currentDate == $Special8
						|| $currentDate == $Special9){
                            $attendance_undertime_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                            $co=count($attendance_undertime_list);
                            if($co<1){
                                    
                            }else{
                                $timeins=$co;
								$currentcount=1;
								$numberofminute=0;
								$attendance_timein="";
                                $attendance_timeout="";
                                foreach($attendance_undertime_list as $data){
                                    if($data->attendance_time_in!="" && $data->attendance_time_out!=""){
                                        $start=$data->attendance_time_in;
                                        $end=$data->attendance_time_out;
                                        $dateStart = new DateTime($start); 
                                        $dateEnd = new DateTime($end);
                                        $dateDiff  = $dateStart->diff($dateEnd);
                                        $time    = explode(':', $dateDiff->format("%H:%I:%S"));
                                        $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                        $numberofminute=$numberofminute+$minutes;
                                        //echo $numberofminute."<br>";
                                    }
                                    if($currentcount==1){
                                        $attendance_timein=$data->attendance_time_in;
                                    }
                                    if($currentcount==$timeins){
                                        $attendance_timeout=$data->attendance_time_out;
                                    }
                                    
                                    $currentcount++;
                                }
                                $timestamp = strtotime($currentDate);
                                $day = date('w', $timestamp);
                                $day++;
                                $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                                foreach($rest_day_list as $data){
                                    $timestart=$data->core_from;
                                    $timeend=$data->core_to;
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    if($data->is_rest_day==0){
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        //special holiday not rest day
                                        $shr=$ot_table_rate->sh;
                                        if($shr==""){
                                            $shr=0;
                                        }
                                        $rateperminute=$rateperminute*$shr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeholiday=$numberofminutesofundertimeholiday+$numberofminute;
                                    }else{
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        //special holiday restday
                                        $shrdr=$ot_table_rate->sh_rd;
                                        if($shrdr==""){
                                            $shrdr=0;
                                        }
                                        $rateperminute=$rateperminute*$shrdr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeholidayrestday=$numberofminutesofundertimeholidayrestday+$numberofminute;
                                    }
                                }
                            }

                        }else if($currentDate == $Regular1 || $currentDate == $Regular2 || $currentDate == $Regular3 || $currentDate == $Regular4 
                        || $currentDate == $Regular5 || $currentDate == $Regular6 || $currentDate == $Regular7 || $currentDate == $Regular8
                        || $currentDate == $Regular9 || $currentDate == $Regular10 || $currentDate == $Regular11 || $currentDate == $Regular12){
                            $attendance_undertime_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                            $co=count($attendance_undertime_list);
                            if($co<1){
                                    
                            }else{
                                $timeins=$co;
								$currentcount=1;
								$numberofminute=0;
								$attendance_timein="";
                                $attendance_timeout="";
                                foreach($attendance_undertime_list as $data){
                                    if($data->attendance_time_in!="" && $data->attendance_time_out!=""){
                                        $start=$data->attendance_time_in;
                                        $end=$data->attendance_time_out;
                                        $dateStart = new DateTime($start); 
                                        $dateEnd = new DateTime($end);
                                        $dateDiff  = $dateStart->diff($dateEnd);
                                        $time    = explode(':', $dateDiff->format("%H:%I:%S"));
                                        $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                        $numberofminute=$numberofminute+$minutes;
                                        //echo $numberofminute."<br>";
                                    }
                                    if($currentcount==1){
                                        $attendance_timein=$data->attendance_time_in;
                                    }
                                    if($currentcount==$timeins){
                                        $attendance_timeout=$data->attendance_time_out;
                                    }
                                    
                                    $currentcount++;
                                }
                                $timestamp = strtotime($currentDate);
                                $day = date('w', $timestamp);
                                $day++;
                                $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                                foreach($rest_day_list as $data){
                                    $timestart=$data->core_from;
                                    $timeend=$data->core_to;
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    $timestart=$data->core_from;
                                    $timeend=$data->core_to;
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    if($data->is_rest_day==0){
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        // regular holiday not restday
                                        $lhr=$ot_table_rate->lh;
                                        if($lhr==""){
                                            $lhr=0;
                                        }
                                        $rateperminute=$rateperminute*$lhr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeRegularholiday=$numberofminutesofundertimeRegularholiday+$numberofminute;
                                    }else{
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        // regular holiday rest day
                                        $lhrdr=$ot_table_rate->lh_rd;
                                        if($lhrdr==""){
                                            $lhrdr=0;
                                        }
                                        $rateperminute=$rateperminute*$lhrdr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeRegularholidayrestday=$numberofminutesofundertimeRegularholidayrestday+$numberofminute;
                                    }
                                }
                            }
                        }
                    }
                    
                }
                $paidleave = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Sick' OR attendance_type='Vacation' OR attendance_type='Maternity / Paternity' OR attendance_type='Solo Parent Leave' OR attendance_type='Violence against Woman (VAWC LEAVE)')
				AND attendance_date BETWEEN '$TransactionFROM' AND '$TransactionTO' AND attendance_time_in IS NOT NULL");
                $validleavecount=count($paidleave);
                $AbsentCount=$AbsentCount-$validleavecount;
				
				$DailyRate=$Basic/$numofdayspermonth;
				
				//echo $AbsentCount." ".$DailyRate."<br>";
				
				$Late=$AbsentCount*$DailyRate;
				$Late=$Late+$undertimepenalty;
					
				$OTAmount=$OTAmount+$restdaytiminrate;
				//echo $restdaytiminrate." ".$numberofminutesofundertimeholiday." ".$numberofminutesofundertimeholidayrestday." ".$numberofminutesofundertimeRegularholiday." ".$numberofminutesofundertimeRegularholidayrestday."<br>";
				$Basic2=$Basic/2;
				$totalNetAmount=0;
				$TotalAllowance=$rows2->cash_allowance+$rows2->meal_allowance+$rows2->mobile_allowance;
                $sum=$Basic2+$DeminimisAmount+$OTAmount+$AdjPlus;
                //echo $Late." ".$SSSCal."<br>".$PhilhealthCal." ".$PagibigCal."<br>".$TaxCal." ".$AdjNeg."<br>";
                $neg=$Late+$SSSCal+$PhilhealthCal+$PagibigCal+$TaxCal-$AdjNeg;
                $totalNetAmount=$sum-$neg;
                
                
                $tablecontent.="<tr title='"."Absent : ".$AbsentCount."\n"
                ."Leave with Pay : ".$validleavecount."\n"
                ."Overtime Hours : ".$OTcount."\n"
                ."Undertime minutes : ".$numberofminutesofundertime."\n"
                ."Rest Day Work minutes : ".$numberofminutesofundertimerestday."\n"
                ."Special Holiday Work minutes : ".$numberofminutesofundertimeholiday."\n"
                ."Special Holiday Rest Day Work minutes : ".$numberofminutesofundertimeholidayrestday."\n"
                ."Regular Holiday Work minutes : ".$numberofminutesofundertimeRegularholiday."\n"
                ."Regular Holiday Rest Day Work minutes : ".$numberofminutesofundertimeRegularholidayrestday."\n"."'>";
                    $tablecontent.='<td>';
                    $tablecontent.=$rows2->employee_id;
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=ucwords(strtolower($rows2->lname.", ".$rows2->fname." ".$rows2->mname));
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=date('m-d-Y',strtotime($rows2->transaction_date));
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($Basic2,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($DeminimisAmount,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($OTAmount,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($Late,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($SSSCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($PhilhealthCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($PagibigCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($TaxCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($AdjPlus,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($AdjNeg,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($totalNetAmount,2);
                    $tablecontent.='</td>';
                $tablecontent.='</tr>';
                $sheet->setCellValue('A'.$index, $rows2->employee_id);
                $sheet->setCellValue('B'.$index,ucwords(strtolower($rows2->lname.", ".$rows2->fname." ".$rows2->mname)));
                $sheet->setCellValue('C'.$index, date('m-d-Y',strtotime($rows2->transaction_date)));
                $sheet->setCellValue('D'.$index, number_format($Basic2,2));
                $sheet->setCellValue('E'.$index, number_format($DeminimisAmount,2));
                $sheet->setCellValue('F'.$index, number_format($OTAmount,2));
                $sheet->setCellValue('G'.$index, number_format($Late,2));
                $sheet->setCellValue('H'.$index, number_format($SSSCal,2));
                $sheet->setCellValue('I'.$index, number_format($PhilhealthCal,2));
                $sheet->setCellValue('J'.$index, number_format($PagibigCal,2));
                $sheet->setCellValue('K'.$index, number_format($TaxCal,2));
                $sheet->setCellValue('L'.$index, number_format($AdjPlus,2));
                $sheet->setCellValue('M'.$index, number_format($AdjNeg,2));
                $sheet->setCellValue('N'.$index, number_format($totalNetAmount,2));
                $index++;


                
            }else if($rows2->payroll_type=="13th Month"){
                $Basic=$rows2->basic_salary;
                $onethreeiet=($Basic*6)/6;
                $PhilhealthCal=0;
                if($rows2->philhealth_contribution==0){
						
                }else{
                    if($rows2->philhealth_contribution==1){
                        if($rows2->com_phic==1){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                            $PhilhealthCal=$PhilhealthCal/2;
                        }
                        if($rows2->com_phic==2){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                        }
                    }else{
                        if($rows2->com_phic==1){
                            
                            $PhilhealthCal=$rows2->philhealth_contribution/2;
                        }
                        if($rows2->com_phic==2){
                            $PhilhealthCal=$rows2->philhealth_contribution;
                        }
                    }
                }
                $SSSCal=0;
                $getsss=HR_Company_reference_sss_table::all();
				if($rows2->com_sss==1){
                    //echo "SSS : ".$rows2->sss_contribution." scan";
					$SSSCal=$rows2->sss_contribution;
					if($SSSCal=="Let System Decide"){
						foreach($getsss as $result){
							$min=$result->min_range;
							$max=$result->max_range;
							if($Basic>=$min && $Basic<=$max){		
								$SSSCal=$result->ss_ee;
							}
						}	
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
					$SSSCal=$SSSCal/2;
                }
                if($rows2->com_sss==2){
                    $SSSCal=$rows2->sss_contribution;
                    //echo "<-".$rows2->emp_id."->Basic: <".$Basic."> SSS : ".$SSSCal."==Let System Decide"." scan2";
                    
                    if($SSSCal=="Let System Decide"){
                        foreach($getsss as $result){
                            $min=$result->min_range;
                            $max=$result->max_range;
                            if($Basic>=$min && $Basic<=$max){
                                $SSSCal=$result->ss_ee;
                            }
                        }
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
                }
                $PagibigCal=0;
				if($rows2->com_pagibig==1){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
					$PagibigCal=$PagibigCal/2;
				}
				if($rows2->com_pagibig==2){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
				}
                $TaxCal=0;
				if($rows2->com_tax==1){
                    $tableget=HR_Company_reference_tax_tax_table::all();
                    foreach($tableget as $result){
                        $one=$result->one;
						$two=$result->two;
						$three=$result->three;
						$four=$result->four;
						$five=$result->five;
						$six=$result->six;
						if($rows2->basic_salary<$one){
							
							
						}
						if($rows2->basic_salary<$two){
							$TaxCal=0;
							
						}
						if($rows2->basic_salary>=$two && $rows2->basic_salary<$three){
							$TaxCal=(20/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$three && $rows2->basic_salary<$four){
							$TaxCal=(25/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$four && $rows2->basic_salary<$five){
							$TaxCal=(30/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$five && $rows2->basic_salary<$six){
							$TaxCal=(32/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$six){
							$TaxCal=(35/100)*$rows2->basic_salary;	
						}
                    }

                }
                $AdjPlus=0;
				$AdjNeg=0;
				$EMPIID=$rows2->employee_id;
				$SALARYID=$rows2->salary_id;
                $get_adjustment = DB::connection('mysql')->select("SELECT * FROM hr_employee_adjustment 
                                WHERE employee_adjustment_emp_id='$EMPIID' AND employee_adjustment_payroll_id='$SALARYID' AND employee_adjustment_active='1'");
                foreach($get_adjustment as $result){
                    if($result->employee_adjustment_amount<0){
                        $AdjNeg=$AdjNeg+$result->employee_adjustment_amount;
                    }
                    if($result->employee_adjustment_amount>-1){
                        $AdjPlus=$AdjPlus+$result->employee_adjustment_amount;
                    }
                }
                $plus=$onethreeiet+$AdjPlus;
				$neg=$SSSCal+$PhilhealthCal+$PagibigCal+$TaxCal-$AdjNeg;
				$totalonethree=$plus-$neg;
                $tablecontent.="<tr>";
                    $tablecontent.='<td>';
                    $tablecontent.=$rows2->employee_id;
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=ucwords(strtolower($rows2->lname.", ".$rows2->fname." ".$rows2->mname));
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=date('m-d-Y',strtotime($rows2->transaction_date));
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($onethreeiet,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format(0,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format(0,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format(0,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($SSSCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($PhilhealthCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($PagibigCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($TaxCal,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($AdjPlus,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($AdjNeg,2);
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($totalonethree,2);
                    $tablecontent.='</td>';
                $tablecontent.='</tr>';
                $sheet->setCellValue('A'.$index, $rows2->employee_id);
                $sheet->setCellValue('B'.$index,ucwords(strtolower($rows2->lname.", ".$rows2->fname." ".$rows2->mname)));
                $sheet->setCellValue('C'.$index, date('m-d-Y',strtotime($rows2->transaction_date)));
                $sheet->setCellValue('D'.$index, number_format($onethreeiet,2));
                $sheet->setCellValue('E'.$index, number_format(0,2));
                $sheet->setCellValue('F'.$index, number_format(0,2));
                $sheet->setCellValue('G'.$index, number_format(0,2));
                $sheet->setCellValue('H'.$index, number_format($SSSCal,2));
                $sheet->setCellValue('I'.$index, number_format($PhilhealthCal,2));
                $sheet->setCellValue('J'.$index, number_format($PagibigCal,2));
                $sheet->setCellValue('K'.$index, number_format($TaxCal,2));
                $sheet->setCellValue('L'.$index, number_format($AdjPlus,2));
                $sheet->setCellValue('M'.$index, number_format($AdjNeg,2));
                $sheet->setCellValue('N'.$index, number_format($totalonethree,2));
                $index++;
            }
        }
        $tablecontent.='</tbody></table></div></div>';
        $writer = new Xlsx($spreadsheet);
        $writer->save('extra/import_file/payroll_report.xlsx');
        return $tablecontent;
    }
    public function process_payroll(Request $request){
        $data=HR_payroll::find($request->SelectedPayroll);
        $data->process_status='1';
        $data->save();
    }
    public function get_excluded_employee_from_payroll(Request $request){
        $tablecontent='<tbody id="PayrollEmployeeListDiv">';
        $data=HR_hr_employee_salary::where([['payroll_id','=',$request->id]])->get();
        $data = DB::connection('mysql')->select("SELECT * FROM hr_employee_salary JOIN hr_employee_info ON hr_employee_info.employee_id=hr_employee_salary.emp_id WHERE payroll_id='$request->id' AND  salary_status='0'");
        foreach($data as $result){
            $tablecontent.='<tr>';
            $tablecontent.='<td>';
            $tablecontent.="";
            $tablecontent.='</td>';
            $tablecontent.='<td>';
            $tablecontent.=$result->biometrics_id!=""? $result->biometrics_id : 'N/A';
            $tablecontent.='</td>';
            $tablecontent.='<td>';
            $tablecontent.=ucwords(strtolower($result->lname." ".$result->fname));
            $tablecontent.='</td>';
            $tablecontent.='<td>';
            
            $result=DB::connection('mysql')->select("SELECT * FROM hr_a_asset_request WHERE emp_id='$result->emp_id' AND (request_status='2' OR request_status='1.1')");
            foreach($result as $re){
                $date1=date_create($re->asset_due_date);
				$date2=date_create(date("Y-m-d"));
				$diff=date_diff($date1,$date2);
                $result2=$diff->format("%R");
                if($result2=="-"){
                    
                }else{
                    $tablecontent.='<button class="btn  btn-danger"><i class="fa fa-flag" aria-hidden="true"></i></button>';
                    break;
                }
            }
            $tablecontent.='</td>';
            $tablecontent.='</tr>';
        }
        $tablecontent.='</tbody>'; 
        return $tablecontent;
    }
    public function get_employee_payroll(Request $request){
        $data = DB::connection('mysql')->select("SELECT * FROM hr_employee_salary JOIN hr_payroll ON hr_payroll.payroll_id=hr_employee_salary.payroll_id WHERE emp_id='$request->id' AND post_status='0' AND process_status='0' ORDER BY `hr_employee_salary`.`salary_id` DESC");
        $options='<select class="form-control" name="PayrollPeriod" id="PayrollPeriod">';
        foreach($data as $item){
            $options.='<option value="'.$item->payroll_id.'">'."Period : ".$item->period.", ".$item->payroll_year." ".$item->payroll_month." - ".$item->payroll_type." -- ".$item->employee_type.'</option>';
        }
        $options.='</select>';
        return $options;
    }
    public function add_payment_to_cash_advance(Request $request){
        //HR_hr_cash_advances_payment;
        $a= new HR_hr_cash_advances_payment;
        $a->cash_advance_id=$request->hidden_cash_advance_id;
        $a->amount=$request->PaymentAmount;
        $a->date_recorded=date('Y-m-d');
        $a->payroll_id=$request->PayrollPeriod;
        if($a->save()){
            $data=HR_hr_cash_advances::find($request->hidden_cash_advance_id);
            $data->pay_amount_per_period=$request->PaymentAmount;
            $data->balance=$request->hidden_balance-$request->PaymentAmount;
            $data->save();

            $data=new HR_hr_employee_adjustment;
            $data->employee_adjustment_type="Salary Adjustment";
            $data->employee_adjustment_name="Cash Advance";
            $data->employee_adjustment_code="CA";
            $data->employee_adjustment_amount=-$request->PaymentAmount;
            $data->employee_adjustment_apply_before='0';
            $data->employee_adjustment_taxable='0';
            $data->employee_adjustment_remarks="Auto Generated Adjustment From the Cash Advance";
            $data->employee_adjustment_payroll_id=$request->PayrollPeriod;
            $data->employee_adjustment_emp_id=$request->hidden_emp_id;
            $data->employee_adjustment_active="1";
            $data->save();
            if($request->hidden_cash_advance_type=="Colleague"){
                //hidden_lender_id
                $data=HR_hr_employee_salary::find($request->PayrollPeriod);
                $pay_id=$data->payroll_id;
                $salary_id="";
                $data = DB::connection('mysql')->select("SELECT * FROM hr_employee_salary WHERE payroll_id='$pay_id' AND emp_id='$request->hidden_lender_id'");
                foreach($data as $result){
                    $salary_id=$result->salary_id;
                    break;
                }
                
                $data=new HR_hr_employee_adjustment;
                $data->employee_adjustment_type="Salary Adjustment";
                $data->employee_adjustment_name="Cash Advance";
                $data->employee_adjustment_code="CA";
                $data->employee_adjustment_amount=$request->PaymentAmount;
                $data->employee_adjustment_apply_before='0';
                $data->employee_adjustment_taxable='0';
                $data->employee_adjustment_remarks="Auto Generated Adjustment From the Cash Advance";
                $data->employee_adjustment_payroll_id=$salary_id;
                $data->employee_adjustment_emp_id=$request->hidden_lender_id;
                $data->employee_adjustment_active="1";
                $data->save();
            }
        }
    }

    public function get_payroll_list_summary(Request $request){
        $year=$request->year;
        $tablecontent='<div class="row" id="PayrollTable" ><div class="col-md-12" >';
        $tablecontent.='<table class="table table-bordered table-sm" style="background-color:white;margin-top:10px;">';
        $tablecontent.='<thead style="background-color:#124f62; color:white;"><tr >';
        $tablecontent.='<th width="9%" style="text-align:center;">Year</th><th width="9%" style="text-align:center;">Month</th><th width="9%" style="text-align:center;">Period</th><th width="10%" style="text-align:center;">Type</th><th width="10%" style="text-align:center;">Employee Type</th><th width="14%" style="text-align:center;">Description</th><th width="10%" style="text-align:center;">Transaction Date</th><th width="9%" style="text-align:center;">Action</th><th width="9%" style="text-align:center;">Status</th><th width="5%"style="text-align:center;"></th>';
        $tablecontent.='</tr></thead>';
        $tablecontent.='<tbody>';
        $data=HR_payroll::where([
            ['payroll_year','=',$year]
        ])->get();
        foreach($data as $result){
            $tablecontent.='<tr>';
                $tablecontent.='<td style="text-align:center;">';
                $tablecontent.=$result->payroll_year;
                $tablecontent.='</td>';
                $tablecontent.='<td style="text-align:center;">';
                $tablecontent.=$result->payroll_month;
                $tablecontent.='</td>';
                $tablecontent.='<td style="text-align:center;">';
                $tablecontent.=$result->period;
                $tablecontent.='</td>';
                $tablecontent.='<td>';
                $tablecontent.=$result->payroll_type;
                $tablecontent.='</td>';
                $tablecontent.='<td style="text-align:center;">';
                $tablecontent.=$result->employee_type;
                $tablecontent.='</td>';
                $tablecontent.='<td>';
                $tablecontent.=$result->description;
                $tablecontent.='</td>';
                $tablecontent.='<td style="text-align:center;">';
                $tablecontent.=$result->transaction_date;
                $tablecontent.='</td>';
                $tablecontent.='<td style="text-align:center;">';
                if($result->post_status=="1"){
                    $tablecontent.='<button type="button" onclick="UnPostPayroll(\''.$result->payroll_id.'\')" class="btn btn-link btn-sm">UNPOST</button>';
                }else{
                    $tablecontent.='<button type="button" onclick="PostPayroll(\''.$result->payroll_id.'\')" class="btn btn-link btn-sm">POST</button>';
                }
                
                $tablecontent.='</td>';
                $tablecontent.='<td style="text-align:center;">';
                if($result->process_status=="1"){
                    $tablecontent.='<button type="button" class="btn btn-link btn-sm">Processed</button>';
                }else{
                    $tablecontent.='<button type="button" class="btn btn-link btn-sm">Unprocessed</button>';
                }
                $tablecontent.='</td>';
                $tablecontent.='<td style="text-align:center;">';
                $tablecontent.='<button type="button" onclick="ShowPayrollSummary(\''.$result->payroll_id.'\')" class="btn btn-link btn-sm">SUMMARY</button>';
                $tablecontent.='</td>';
            $tablecontent.='</tr>';
        }
        
        $tablecontent.='</tbody>';
        $tablecontent.='</table>';
        $tablecontent.='</div></div>';


        return $tablecontent;
    }
    public function post_payroll(Request $request){
        $data=HR_payroll::find($request->id);
        $data->post_status=$request->stat;
        $data->save();
    }
    public function view_payroll_summary_modal(Request $request){
        $data=HR_payroll::find($request->id);
        $tablecontent='<div id="ViewSummaryPayrollModal" class="modal fade" role="dialog"><div class="modal-dialog modal-lg">';
            $tablecontent.='<div class="modal-content">';

                $tablecontent.='<div class="modal-header"><h5 class="modal-title" style="color:#083240;">Payroll Summary</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>';

                $tablecontent.='<div class="modal-body">';
                    $tablecontent.='<div class="row"><div class="col-md-12">';
                        $tablecontent.='<table class="table borderless table-sm" style=" background-color:white;">';
                        $tablecontent.='<thead style="background-color:#124f62; color:white;"><tr><th colspan="4">Payroll Period</th></tr></thead>';
                        $tablecontent.='<tbody>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td width="15%" >Year</td>';
                            $tablecontent.='<td  width="35%"><input style="width:80%;" type="number" min="2018" step="1" value="2018" class="form-control" name="PayrollYear" value="'.$data->payroll_year.'" readonly></td>';
                            $tablecontent.='<td width="15%" >Payroll Type</td>';
                            $tablecontent.='<td width="35%" ><select style="width:80%;" class="form-control" name="PayrollType" readonly><option>'.$data->payroll_type.'</option></select></td>';
                            $tablecontent.='</tr>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td >Month</td>';
                            $tablecontent.='<td>
                            <select style="width:80%;" class="form-control" name="PayrollMonth" readonly>
                                <option>'.$data->payroll_month.'</option>
                            </select></td>';
                            $tablecontent.='<td >Transaction Date</td>';
                            $tablecontent.='<td>
                                <input style="width:80%;" type="date" class="form-control" name="PayrollTransactionDate" value="'.$data->transaction_date.'" readonly>
                            </td>';
                            $tablecontent.='</tr>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td >Employee Type </td>';
                            $tablecontent.='<td><select style="width:80%;" class="form-control" name="EmployeeType" readonly>
                                <option>'.$data->employee_type.'</option>
                            </select></td>';
                            $tablecontent.='<td >From</td>';
                            $tablecontent.='<td>
                            <input type="date" style="width:80%;" class="form-control" name="PayrollFrom" value="'.$data->transaction_from.'" readonly>
                            </td>';
                            $tablecontent.='</tr>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td >Period</td>';
                            $tablecontent.='<td><select style="width:80%;" class="form-control" name="PayrollPeriod" readonly>
                                <option>'.$data->period.'</option>
                            </select></td>';
                            $tablecontent.='<td >To</td>';
                            $tablecontent.='<td>
                            <input type="date" style="width:80%;" class="form-control" name="PayrollTo" value="'.$data->transaction_to.'" readonly>
                            </td>';
                            $tablecontent.='</tr>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td >Description</td>';
                            $tablecontent.='<td colspan="3"><textarea class="form-control" rows="3" name="PayrollDescription" readonly>'.$data->description.'</textarea></td>';
                            $tablecontent.='</tr>';
                        $tablecontent.='</tbody>';
                        $tablecontent.='</table>';
                        $tablecontent.='<table class="table borderless table-sm" style=" background-color:white;margin-bottom:10px;">';
                        $tablecontent.='<thead style="background-color:#124f62; color:white;"><tr><th colspan="4">Payroll Option</th></tr></thead>';
                        $tablecontent.='<tbody>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td width="15%" >Compute PHIC</td>';
                            $tablecontent.='<td  width="35%"><select style="width:80%;" class="form-control" name="ComputePHIC" readonly>
                            '.($data->com_phic=="1"? '<option>YES</option>' : ($data->com_phic=="2"? '<option>YES FULL</option>' : '<option>NO</option>')).'
                            </select></td>';
                            $tablecontent.='<td width="15%" >Compute Tax</td>';
                            $tablecontent.='<td width="35%" ><select style="width:80%;" class="form-control" name="ComputeTax" readonly>
                            '.($data->com_tax=="1"? '<option>YES</option>' : '<option>NO</option>').'</select></td>';
                            $tablecontent.='</tr>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td >Compute SSS</td>';
                            $tablecontent.='<td ><select style="width:80%;" class="form-control" name="ComputeSSS" readonly>
                            '.($data->com_sss=="1"? '<option>YES</option>' : ($data->com_sss=="2"? '<option>YES FULL</option>' : '<option>NO</option>')).'
                            </select></td>';
                            $tablecontent.='<td >Force End of Month</td>';
                            $tablecontent.='<td ><select style="width:80%;" class="form-control" name="ForceEnd" readonly>
                            '.($data->com_end_of_month=="1"? '<option>YES</option>' : '<option>NO</option>').'</select></td>';
                            $tablecontent.='</tr>';
                            $tablecontent.='<tr>';
                            $tablecontent.='<td >Compute Pag-Ibig</td>';
                            $tablecontent.='<td ><select style="width:80%;" class="form-control" name="ComputePagibig" readonly>
                            '.($data->com_pagibig=="1"? '<option>YES</option>' : ($data->com_pagibig=="2"? '<option>YES FULL</option>' : '<option>NO</option>')).'
                            </select></td>';
                            $tablecontent.='<td >Use Annual Calculation</td>';
                            $tablecontent.='<td ><select style="width:80%;" class="form-control" name="UseAnnualCal" readonly>
                            '.($data->use_annual_calculation=="1"? '<option>YES</option>' : '<option>NO</option>').'</select></td>';
                            $tablecontent.='</tr>';
                        $tablecontent.='</tbody>';
                        $tablecontent.='</table>';
                    $tablecontent.='</div></div>';

                    $tablecontent.='<div class="row" >';
                        $tablecontent.='<div class="col-md-6 table-responsive">';
                            $tablecontent.='<div class="row">
                                <div class="col-md-12">
                                    <h3 style="color:#083240;">INCLUDED EMPLOYEES</h3>
                                </div>
                            </div>';

                            $tablecontent.=$this->setpayroll_review($request->id);
                            $tablecontent.='';
                        $tablecontent.='</div>';
                        $tablecontent.='<div class="col-md-6 table-responsive">';
                        $tablecontent.='<div class="row">
                                <div class="col-md-12">
                                    <h3 style="color:#083240;">EXLUDED EMPLOYEES</h3>
                                </div>
                            </div>';
                        $tablecontent.=$this->setexcluded_emp_payroll_review($request->id);
                        $tablecontent.='</div>';
                $tablecontent.='</div>';

                $tablecontent.='</div>';

                $tablecontent.='<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>';

            $tablecontent.='</div>';
        $tablecontent.='</div></div>';


        return $tablecontent;
    }
    private function setpayroll_review($Selected){
        $Sel=$Selected;
        $tablecontent='<table class="table table-bordered table-sm" style="background-color:white;">
                <thead style="background-color:#124f62; color:white;">
                  <tr>
                    <th>ID</th><th>Name</th><th>Net Amount</th>
                  </tr>
                </thead>
                <tbody >';
        
        $a=HR_Company_payroll_computation::first();
        $numofdayspermonth=$a->work_day_per_month;
        $employee_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_info 
        JOIN 
        hr_employee_salary ON hr_employee_info.employee_id=hr_employee_salary.emp_id 
        JOIN hr_payroll ON hr_payroll.payroll_id=hr_employee_salary.payroll_id 
        JOIN hr_employee_salary_detail ON hr_employee_salary_detail.emp_id=hr_employee_info.employee_id 
        WHERE hr_employee_salary.payroll_id='$Sel' AND hr_employee_salary.salary_status='1'");
        foreach($employee_list as $rows2){
            if($rows2->payroll_type=="Normal Payroll"){
                $Basic=$rows2->basic_salary;
                $PhilhealthCal=0;
                if($rows2->philhealth_contribution==0){
						
                }else{
                    if($rows2->philhealth_contribution==1){
                        if($rows2->com_phic==1){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                            $PhilhealthCal=$PhilhealthCal/2;
                        }
                        if($rows2->com_phic==2){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                        }
                    }else{
                        if($rows2->com_phic==1){
                            
                            $PhilhealthCal=$rows2->philhealth_contribution/2;
                        }
                        if($rows2->com_phic==2){
                            $PhilhealthCal=$rows2->philhealth_contribution;
                        }
                    }
                }
                $SSSCal=0;
					
				$getsss=HR_Company_reference_sss_table::all();
				if($rows2->com_sss==1){
                    //echo "SSS : ".$rows2->sss_contribution." scan";
					$SSSCal=$rows2->sss_contribution;
					if($SSSCal=="Let System Decide"){
						foreach($getsss as $result){
							$min=$result->min_range;
							$max=$result->max_range;
							if($Basic>=$min && $Basic<=$max){		
								$SSSCal=$result->ss_ee;
							}
						}	
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
					$SSSCal=$SSSCal/2;
                }
                if($rows2->com_sss==2){
                    $SSSCal=$rows2->sss_contribution;
                    //echo "<-".$rows2->emp_id."->Basic: <".$Basic."> SSS : ".$SSSCal."==Let System Decide"." scan2";
                    
                    if($SSSCal=="Let System Decide"){
                        foreach($getsss as $result){
                            $min=$result->min_range;
                            $max=$result->max_range;
                            if($Basic>=$min && $Basic<=$max){
                                $SSSCal=$result->ss_ee;
                            }
                        }
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
                }
                $PagibigCal=0;
				if($rows2->com_pagibig==1){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
					$PagibigCal=$PagibigCal/2;
				}
				if($rows2->com_pagibig==2){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
				}
                $TaxCal=0;
				if($rows2->com_tax==1){
                    $tableget=HR_Company_reference_tax_tax_table::find(4);
                        $one=$tableget->one;
						$two=$tableget->two;
						$three=$tableget->three;
						$four=$tableget->four;
						$five=$tableget->five;
						$six=$tableget->six;
						if($rows2->basic_salary<$one){
							
							
						}
						if($rows2->basic_salary<$two){
							$TaxCal=0;
							
						}
						if($rows2->basic_salary>=$two && $rows2->basic_salary<$three){
							$TaxCal=(20/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$three && $rows2->basic_salary<$four){
							$TaxCal=(25/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$four && $rows2->basic_salary<$five){
							$TaxCal=(30/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$five && $rows2->basic_salary<$six){
							$TaxCal=(32/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$six){
							$TaxCal=(35/100)*$rows2->basic_salary;	
						}
                    

                }
                $TransactionFROM=$rows2->transaction_from;
				$TransactionTO=$rows2->transaction_to;
				$AdjPlus=0;
				$AdjNeg=0;
				$EMPIID=$rows2->employee_id;
				$SALARYID=$rows2->salary_id;
                $get_adjustment = DB::connection('mysql')->select("SELECT * FROM hr_employee_adjustment 
                                WHERE employee_adjustment_emp_id='$EMPIID' AND employee_adjustment_payroll_id='$SALARYID'  AND employee_adjustment_active='1'");
                foreach($get_adjustment as $result){
                    if($result->employee_adjustment_amount<0){
                        $AdjNeg=$AdjNeg+$result->employee_adjustment_amount;
                    }
                    if($result->employee_adjustment_amount>-1){
                        $AdjPlus=$AdjPlus+$result->employee_adjustment_amount;
                    }
                }
                $ot_com_table=$rows2->ot_com_table;
                $ot_table_rate=HR_Company_reference_hr_ot_table::where(
                    [
                        ['data_status','=',NULL],
                        ['dh_id','=',$ot_com_table]
                    ]
                )->first();
                $DeminimisAmount=$rows2->deminimis_total;
                $OTcount=0;
                $OTAmount=0;
                $EMPII=$rows2->employee_id;
                $biomentrics=$rows2->biometrics_id;
                $get_ot = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND 
                (attendance_type='Normal OT' OR attendance_type='Early OT' ) AND attendance_date BETWEEN '$TransactionFROM' AND '$TransactionTO'");
                foreach($get_ot as $result2){
                    $time1 = $result2->attendance_time_in;
					$time2 = $result2->attendance_time_out;
					$diff = abs(strtotime($time1) - strtotime($time2));
					$tmins = $diff/60;
					$hours = floor($tmins/60);
					$mins = $tmins%60;
					$OTcount=$OTcount+$hours;
					
					//echo $hours." ";
					$curdate=strtotime($result2->attendance_date);
					$Special1=strtotime(date('Y-2-16'));
					$Special2=strtotime(date('Y-2-25'));
					$Special3=strtotime(date('Y-4-14'));
					$Special4=strtotime(date('Y-8-21'));
					$Special5=strtotime(date('Y-11-01'));
					$Special6=strtotime(date('Y-11-02'));
					$Special7=strtotime(date('Y-3-31'));
					$Special8=strtotime(date('Y-12-24'));
					$Special9=strtotime(date('Y-12-31'));
					
					$Regular1=strtotime(date('Y-1-1'));
					$Regular2=strtotime(date('Y-1-2'));
					$Regular3=strtotime(date('Y-3-16'));//davao city day
					$Regular4=strtotime(date('Y-3-29'));//holy week
					$Regular5=strtotime(date('Y-3-30'));//holy week
					$Regular6=strtotime(date('Y-4-9'));
					$Regular7=strtotime(date('Y-5-1'));
					$Regular8=strtotime(date('Y-6-12'));
					$Regular9=strtotime(date('Y-8-27'));
					$Regular10=strtotime(date('Y-11-30'));
					$Regular11=strtotime(date('Y-12-25'));
					$Regular12=strtotime(date('Y-12-30'));
					
					$day = date("w", $curdate);
                    $day++;
                    $stt="NO";
                    $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                    foreach($rest_day_list as $data){
                        
						if($result2->is_rest_day==1){
							$stt="YES";
						}
						else{
							$stt="NO";
						}
                    }
                    $holiday=0;
					$daily2=$Basic/$numofdayspermonth;
					$daily=$Basic/$numofdayspermonth;
					$daily=$daily/8;
					
					if($curdate == $Special1 || $curdate == $Special2 || $curdate == $Special3 || $curdate == $Special4
					|| $curdate == $Special5 || $curdate == $Special6 || $curdate == $Special7 || $curdate == $Special8
					|| $curdate == $Special9){
                        if($stt=='YES'){
                            //special holiday rest day OT
                            $shrdot=$ot_table_rate->sh_rd_ot;
                            if($shrdot==""){
                                $shrdot=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$shrdot));
                        }
                        if($stt=='NO'){
                            //special holiday not rest day OT
                            $sh=$ot_table_rate->sh_ot;
                            if($sh==""){
                                $sh=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$sh));
                        }
                        $holiday=1;
                    }
                    else if($curdate == $Regular1 || $curdate == $Regular2 || $curdate == $Regular3 || $curdate == $Regular4 || $curdate == $Regular5 || $curdate == $Regular6 || $curdate == $Regular7 || $curdate == $Regular8
					|| $curdate == $Regular9 || $curdate == $Regular10 || $curdate == $Regular11 || $curdate == $Regular12){
                        if($stt=='YES'){
                            //regular holiday rest day OT
                            $lhrd=$ot_table_rate->lh_rd_ot;
                            if($lhrd==""){
                                $lhrd=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$lhrd));
                        }
                        if($stt=='NO'){
                            //regular holiday not rest day OT
                            $lh=$ot_table_rate->lh_ot;
                            if($lh==""){
                                $lh=0;
                            }
                            $OTAmount=$OTAmount+($hours*($daily*$lh));
                        }
                        $holiday=1;
                    }
                    else if($holiday==0 && $stt=="YES"){
                        // not holiday rest day OT
                        $rd=$ot_table_rate->rd_ot;
                        if($rd==""){
                            $rd=0;
                        }
                        $OTAmount=$OTAmount+($hours*($daily*$rd));
                    }else{
                        //regular OT
                        $rr=$ot_table_rate->ord_ot;
                        if($rr==""){
                            $rr=0;
                        }
                        $OTAmount=$OTAmount+($hours*($daily*$rr));
                    }
                }
                $Late=0;
				$undertimepenalty=0;
				$restdaytiminrate=0;
				$numberofminutesofundertime=0;
				$numberofminutesofundertimerestday=0;
				$numberofminutesofundertimeholiday=0;
				$numberofminutesofundertimeholidayrestday=0;
				$numberofminutesofundertimeRegularholiday=0;
				$numberofminutesofundertimeRegularholidayrestday=0;
				$begin = new DateTime( $TransactionFROM );
				$end = new DateTime($TransactionTO );
				$end = $end->modify( '+1 day' ); 
				
				$interval = new DateInterval('P1D');
				$daterange = new DatePeriod($begin, $interval ,$end);
                $AbsentCount=0;
                foreach($daterange as $date){
                    $currentDate=$date->format('Y-m-d');
                    $Special1=strtotime(date('Y-2-16'));
                    $Special2=strtotime(date('Y-2-25'));
                    $Special3=strtotime(date('Y-4-14'));
                    $Special4=strtotime(date('Y-8-21'));
                    $Special5=strtotime(date('Y-11-01'));
                    $Special6=strtotime(date('Y-11-02'));
                    $Special7=strtotime(date('Y-3-31'));
                    $Special8=strtotime(date('Y-12-24'));
                    $Special9=strtotime(date('Y-12-31'));
                    
                    $Regular1=strtotime(date('Y-1-1'));
                    $Regular2=strtotime(date('Y-1-2'));
                    $Regular3=strtotime(date('Y-3-16'));//davao city day
                    $Regular4=strtotime(date('Y-3-29'));//holy week
                    $Regular5=strtotime(date('Y-3-30'));//holy week
                    $Regular6=strtotime(date('Y-4-9'));
                    $Regular7=strtotime(date('Y-5-1'));
                    $Regular8=strtotime(date('Y-6-12'));
                    $Regular9=strtotime(date('Y-8-27'));
                    $Regular10=strtotime(date('Y-11-30'));
                    $Regular11=strtotime(date('Y-12-25'));
                    $Regular12=strtotime(date('Y-12-30'));
                    
                    $curdate2=strtotime($currentDate);

                    if($curdate2 != $Special1 && $curdate2 != $Special2 && $curdate2 != $Special3 && $curdate2 != $Special4
					&& $curdate2 != $Special5 && $curdate2 != $Special6 && $curdate2 != $Special7 && $curdate2 != $Special8
					&& $curdate2 != $Special9 && $curdate2 != $Regular1 && $curdate2 != $Regular2 && $curdate2 != $Regular3 
					&& $curdate2 != $Regular4 && $curdate2 != $Regular5 && $curdate2 != $Regular6 && $curdate2 != $Regular7 
					&& $curdate2 != $Regular8 && $curdate2 != $Regular9 && $curdate2 != $Regular10 && $curdate2 != $Regular11 
					&& $curdate2 != $Regular12){
                        $attendance_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Official Business' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                        $COUNT2=count($attendance_list);
                        if($COUNT2<1){
                            $timestamp = strtotime($currentDate);
                            $day = date('w', $timestamp);
                            $day++;
                            $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPIID' AND day_id='$day' ");
                            foreach($rest_day_list as $data){
                                if($data->is_rest_day==0){	
                                    $AbsentCount++;
                                }
                            }
                        }
                        $attendance_undertime_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                        $co=count($attendance_undertime_list);
                        if($co<1){
								
                        }else{
                            $timeins=$co;
                            $currentcount=1;
                            $numberofminute=0;
                            $attendance_timein="";
                            $attendance_timeout="";
                            foreach($attendance_undertime_list as $data){
                                if($data->attendance_time_in!="" && $data->attendance_time_out!=""){
                                    $start=$data->attendance_time_in;
                                    $end=$data->attendance_time_out;
                                    $dateStart = new DateTime($start); 
                                    $dateEnd = new DateTime($end);
                                    $dateDiff  = $dateStart->diff($dateEnd);
                                    $time    = explode(':', $dateDiff->format("%H:%I:%S"));
                                    $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                    $numberofminute=$numberofminute+$minutes;
                                    //echo $numberofminute."<br>";
                                }
                                if($currentcount==1){
                                    $attendance_timein=$data->attendance_time_in;
                                }
                                if($currentcount==$timeins){
                                    $attendance_timeout=$data->attendance_time_out;
                                }
                                
                                $currentcount++;
                            }
                            $timestamp = strtotime($currentDate);
                            $day = date('w', $timestamp);
                            $day++;
                            $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                            foreach($rest_day_list as $data){
                                $timestart=$data->core_from;
                                $timeend=$data->core_to;
                                $breakstart=$data->break_start;
                                $breakend=$data->break_end;
                                if($data->is_rest_day==0){
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    $breakstartdate = new DateTime($breakstart); 
                                    $breakenddate = new DateTime($breakend);
                                    $breakDiff  = $breakstartdate->diff($breakenddate);
                                    $breaktime    = explode(':', $breakDiff->format("%H:%I:%S"));
                                    $breakminutes = ($breaktime[0] * 60.0 + $breaktime[1] * 1.0);
                                    $strStart = $timestart;
                                    $strEnd   = $timeend; 
                                    $dteStart = new DateTime($strStart); 
                                    $dteEnd   = new DateTime($strEnd);
                                    $dteDiff  = $dteStart->diff($dteEnd);
                                    $time    = explode(':', $dteDiff->format("%H:%I:%S"));
                                    $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                    //echo $timestart." : ".$timeend."<br>";
                                    ///echo ($minutes-$breakminutes)." :".$breakminutes." - - ".($numberofminute-$breakminutes);
                                    $shedminutesminusbreak=$minutes-$breakminutes;
                                    $timeinminutesminusbreak=$numberofminute-$breakminutes;
                                    //echo "<br> time :".$timeinminutesminusbreak." >= ".$shedminutesminusbreak."<br>";
                                    //calculate 
                                    if($timeinminutesminusbreak>=$shedminutesminusbreak){
                                        
                                        $shiftstart = new DateTime($timestart); 
                                        $timeinstart = new DateTime($attendance_timein);
                                        $shiftDiff  = $shiftstart->diff($timeinstart);
                                        $shifttimediff    = explode(':', $shiftDiff->format("%H:%I:%S"));
                                        $shifttimemin = ($shifttimediff[0] * 60.0 + $shifttimediff[1] * 1.0);
                                        
                                        //$undertimepenalty
                                    }else{
                                        
                                        $lackminutes=$shedminutesminusbreak-$timeinminutesminusbreak;
                                        $lackminutes=$lackminutes-11;
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/$shedminutesminusbreak;
                                        $undertimepenalty=$lackminutes*$rateperminute;
                                        $numberofminutesofundertime=$numberofminutesofundertime+$lackminutes;
                                        //echo $numberofminutesofundertime." undetiime";
                                    }
                                }else{
                                    $rateperminute=$Basic/$numofdayspermonth;
									$rateperminute=$rateperminute/8;
									$rateperminute=$rateperminute/60;
									//Restday time in
									$rdrd=$ot_table_rate->rd;
									if($rdrd==""){
										$rdrd=0;
									}
									$rateperminute=$rateperminute*$rdrd;
									$restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
									//echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
									$numberofminutesofundertimerestday=$numberofminutesofundertimerestday+$numberofminute;
                                }
                            }
                        }

                    }else{
                        //holiday
                        if($currentDate == $Special1 || $currentDate == $Special2 || $currentDate == $Special3 || $currentDate == $Special4
						|| $currentDate == $Special5 || $currentDate == $Special6 || $currentDate == $Special7 || $currentDate == $Special8
						|| $currentDate == $Special9){
                            $attendance_undertime_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                            $co=count($attendance_undertime_list);
                            if($co<1){
                                    
                            }else{
                                $timeins=$co;
								$currentcount=1;
								$numberofminute=0;
								$attendance_timein="";
                                $attendance_timeout="";
                                foreach($attendance_undertime_list as $data){
                                    if($data->attendance_time_in!="" && $data->attendance_time_out!=""){
                                        $start=$data->attendance_time_in;
                                        $end=$data->attendance_time_out;
                                        $dateStart = new DateTime($start); 
                                        $dateEnd = new DateTime($end);
                                        $dateDiff  = $dateStart->diff($dateEnd);
                                        $time    = explode(':', $dateDiff->format("%H:%I:%S"));
                                        $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                        $numberofminute=$numberofminute+$minutes;
                                        //echo $numberofminute."<br>";
                                    }
                                    if($currentcount==1){
                                        $attendance_timein=$data->attendance_time_in;
                                    }
                                    if($currentcount==$timeins){
                                        $attendance_timeout=$data->attendance_time_out;
                                    }
                                    
                                    $currentcount++;
                                }
                                $timestamp = strtotime($currentDate);
                                $day = date('w', $timestamp);
                                $day++;
                                $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                                foreach($rest_day_list as $data){
                                    $timestart=$data->core_from;
                                    $timeend=$data->core_to;
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    if($data->is_rest_day==0){
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        //special holiday not rest day
                                        $shr=$ot_table_rate->sh;
                                        if($shr==""){
                                            $shr=0;
                                        }
                                        $rateperminute=$rateperminute*$shr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeholiday=$numberofminutesofundertimeholiday+$numberofminute;
                                    }else{
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        //special holiday restday
                                        $shrdr=$ot_table_rate->sh_rd;
                                        if($shrdr==""){
                                            $shrdr=0;
                                        }
                                        $rateperminute=$rateperminute*$shrdr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeholidayrestday=$numberofminutesofundertimeholidayrestday+$numberofminute;
                                    }
                                }
                            }

                        }else if($currentDate == $Regular1 || $currentDate == $Regular2 || $currentDate == $Regular3 || $currentDate == $Regular4 
                        || $currentDate == $Regular5 || $currentDate == $Regular6 || $currentDate == $Regular7 || $currentDate == $Regular8
                        || $currentDate == $Regular9 || $currentDate == $Regular10 || $currentDate == $Regular11 || $currentDate == $Regular12){
                            $attendance_undertime_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Time In' OR attendance_type='Undertime') AND attendance_date='$currentDate'");
                            $co=count($attendance_undertime_list);
                            if($co<1){
                                    
                            }else{
                                $timeins=$co;
								$currentcount=1;
								$numberofminute=0;
								$attendance_timein="";
                                $attendance_timeout="";
                                foreach($attendance_undertime_list as $data){
                                    if($data->attendance_time_in!="" && $data->attendance_time_out!=""){
                                        $start=$data->attendance_time_in;
                                        $end=$data->attendance_time_out;
                                        $dateStart = new DateTime($start); 
                                        $dateEnd = new DateTime($end);
                                        $dateDiff  = $dateStart->diff($dateEnd);
                                        $time    = explode(':', $dateDiff->format("%H:%I:%S"));
                                        $minutes = ($time[0] * 60.0 + $time[1] * 1.0);
                                        $numberofminute=$numberofminute+$minutes;
                                        //echo $numberofminute."<br>";
                                    }
                                    if($currentcount==1){
                                        $attendance_timein=$data->attendance_time_in;
                                    }
                                    if($currentcount==$timeins){
                                        $attendance_timeout=$data->attendance_time_out;
                                    }
                                    
                                    $currentcount++;
                                }
                                $timestamp = strtotime($currentDate);
                                $day = date('w', $timestamp);
                                $day++;
                                $rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
                                foreach($rest_day_list as $data){
                                    $timestart=$data->core_from;
                                    $timeend=$data->core_to;
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    $timestart=$data->core_from;
                                    $timeend=$data->core_to;
                                    $breakstart=$data->break_start;
                                    $breakend=$data->break_end;
                                    if($data->is_rest_day==0){
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        // regular holiday not restday
                                        $lhr=$ot_table_rate->lh;
                                        if($lhr==""){
                                            $lhr=0;
                                        }
                                        $rateperminute=$rateperminute*$lhr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeRegularholiday=$numberofminutesofundertimeRegularholiday+$numberofminute;
                                    }else{
                                        $rateperminute=$Basic/$numofdayspermonth;
                                        $rateperminute=$rateperminute/8;
                                        $rateperminute=$rateperminute/60;
                                        // regular holiday rest day
                                        $lhrdr=$ot_table_rate->lh_rd;
                                        if($lhrdr==""){
                                            $lhrdr=0;
                                        }
                                        $rateperminute=$rateperminute*$lhrdr;
                                        $restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
                                        //echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
                                        $numberofminutesofundertimeRegularholidayrestday=$numberofminutesofundertimeRegularholidayrestday+$numberofminute;
                                    }
                                }
                            }
                        }
                    }
                    
                }
                $paidleave = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND (attendance_type='Sick' OR attendance_type='Vacation' OR attendance_type='Maternity / Paternity' OR attendance_type='Solo Parent Leave' OR attendance_type='Violence against Woman (VAWC LEAVE)')
				AND attendance_date BETWEEN '$TransactionFROM' AND '$TransactionTO' AND attendance_time_in IS NOT NULL");
                $validleavecount=count($paidleave);
                $AbsentCount=$AbsentCount-$validleavecount;
				
				$DailyRate=$Basic/$numofdayspermonth;
				
				//echo $AbsentCount." ".$DailyRate."<br>";
				
				$Late=$AbsentCount*$DailyRate;
				$Late=$Late+$undertimepenalty;
					
				$OTAmount=$OTAmount+$restdaytiminrate;
				//echo $restdaytiminrate." ".$numberofminutesofundertimeholiday." ".$numberofminutesofundertimeholidayrestday." ".$numberofminutesofundertimeRegularholiday." ".$numberofminutesofundertimeRegularholidayrestday."<br>";
				$Basic2=$Basic/2;
				$totalNetAmount=0;
				$TotalAllowance=$rows2->cash_allowance+$rows2->meal_allowance+$rows2->mobile_allowance;
                $sum=$Basic2+$DeminimisAmount+$OTAmount+$AdjPlus;
                //echo $Late." ".$SSSCal."<br>".$PhilhealthCal." ".$PagibigCal."<br>".$TaxCal." ".$AdjNeg."<br>";
                $neg=$Late+$SSSCal+$PhilhealthCal+$PagibigCal+$TaxCal-$AdjNeg;
                $totalNetAmount=$sum-$neg;
                
                
                $tablecontent.="<tr>";
                    $tablecontent.='<td>';
                    $tablecontent.=$rows2->employee_id;
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=ucwords(strtolower($rows2->lname.", ".$rows2->fname." ".$rows2->mname));
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($totalNetAmount,2);
                    $tablecontent.='</td>';
                $tablecontent.='</tr>';
                


                
            }else if($rows2->payroll_type=="13th Month"){
                $Basic=$rows2->basic_salary;
                $onethreeiet=($Basic*6)/6;
                $PhilhealthCal=0;
                if($rows2->philhealth_contribution==0){
						
                }else{
                    if($rows2->philhealth_contribution==1){
                        if($rows2->com_phic==1){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                            $PhilhealthCal=$PhilhealthCal/2;
                        }
                        if($rows2->com_phic==2){
                            if($rows2->basic_salary<=10000.00){
                                $PhilhealthCal=137.50;
                            }
                            if($rows2->basic_salary>=10000.01 && $rows2->basic_salary<=39999.99){
                                $PhilhealthCal=(2.75/100)*$rows2->basic_salary;
                            }
                            if($rows2->basic_salary>=40000.00){
                                $PhilhealthCal=550.00;
                            }
                        }
                    }else{
                        if($rows2->com_phic==1){
                            
                            $PhilhealthCal=$rows2->philhealth_contribution/2;
                        }
                        if($rows2->com_phic==2){
                            $PhilhealthCal=$rows2->philhealth_contribution;
                        }
                    }
                }
                $SSSCal=0;
                $getsss=HR_Company_reference_sss_table::all();
				if($rows2->com_sss==1){
                    //echo "SSS : ".$rows2->sss_contribution." scan";
					$SSSCal=$rows2->sss_contribution;
					if($SSSCal=="Let System Decide"){
						foreach($getsss as $result){
							$min=$result->min_range;
							$max=$result->max_range;
							if($Basic>=$min && $Basic<=$max){		
								$SSSCal=$result->ss_ee;
							}
						}	
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
					$SSSCal=$SSSCal/2;
                }
                if($rows2->com_sss==2){
                    $SSSCal=$rows2->sss_contribution;
                    //echo "<-".$rows2->emp_id."->Basic: <".$Basic."> SSS : ".$SSSCal."==Let System Decide"." scan2";
                    
                    if($SSSCal=="Let System Decide"){
                        foreach($getsss as $result){
                            $min=$result->min_range;
                            $max=$result->max_range;
                            if($Basic>=$min && $Basic<=$max){
                                $SSSCal=$result->ss_ee;
                            }
                        }
                    }
                    if($SSSCal=="Let System Decide"){
                        $SSSCal=0;
                    }
                }
                $PagibigCal=0;
				if($rows2->com_pagibig==1){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
					$PagibigCal=$PagibigCal/2;
				}
				if($rows2->com_pagibig==2){
					$PagibigCal=$rows2->pagibigcont;
					if($PagibigCal=="Let System Decide"){
						if($Basic>5000 ){
							$PagibigCal=100;
						}
						if($Basic>1500 && $Basic<=5000){
							$PagibigCal=$Basic*0.02;
						}
						if($Basic<=1500){
							$PagibigCal=$Basic*0.01;
						}
					}
				}
                $TaxCal=0;
				if($rows2->com_tax==1){
                    $tableget=HR_Company_reference_tax_tax_table::all();
                    foreach($tableget as $result){
                        $one=$result->one;
						$two=$result->two;
						$three=$result->three;
						$four=$result->four;
						$five=$result->five;
						$six=$result->six;
						if($rows2->basic_salary<$one){
							
							
						}
						if($rows2->basic_salary<$two){
							$TaxCal=0;
							
						}
						if($rows2->basic_salary>=$two && $rows2->basic_salary<$three){
							$TaxCal=(20/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$three && $rows2->basic_salary<$four){
							$TaxCal=(25/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$four && $rows2->basic_salary<$five){
							$TaxCal=(30/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$five && $rows2->basic_salary<$six){
							$TaxCal=(32/100)*$rows2->basic_salary;
							
						}
						if($rows2->basic_salary>=$six){
							$TaxCal=(35/100)*$rows2->basic_salary;	
						}
                    }

                }
                $AdjPlus=0;
				$AdjNeg=0;
				$EMPIID=$rows2->employee_id;
				$SALARYID=$rows2->salary_id;
                $get_adjustment = DB::connection('mysql')->select("SELECT * FROM hr_employee_adjustment 
                                WHERE employee_adjustment_emp_id='$EMPIID' AND employee_adjustment_payroll_id='$SALARYID' AND employee_adjustment_active='1'");
                foreach($get_adjustment as $result){
                    if($result->employee_adjustment_amount<0){
                        $AdjNeg=$AdjNeg+$result->employee_adjustment_amount;
                    }
                    if($result->employee_adjustment_amount>-1){
                        $AdjPlus=$AdjPlus+$result->employee_adjustment_amount;
                    }
                }
                $plus=$onethreeiet+$AdjPlus;
				$neg=$SSSCal+$PhilhealthCal+$PagibigCal+$TaxCal-$AdjNeg;
				$totalonethree=$plus-$neg;
                $tablecontent.="<tr>";
                    $tablecontent.='<td>';
                    $tablecontent.=$rows2->employee_id;
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=ucwords(strtolower($rows2->lname.", ".$rows2->fname." ".$rows2->mname));
                    $tablecontent.='</td>';
                    
                    $tablecontent.='<td>';
                    $tablecontent.=number_format($totalonethree,2);
                    $tablecontent.='</td>';
                $tablecontent.='</tr>';
                
            }
        }
        $tablecontent.='</tbody></table>';
        return $tablecontent;
    }
    private function setexcluded_emp_payroll_review($Selected){
        $Sel=$Selected;
        $tablecontent='<table class="table table-bordered table-sm" style="background-color:white;">
                <thead style="background-color:#124f62; color:white;">
                  <tr>
                    <th>ID</th><th>Name</th><th></th>
                  </tr>
                </thead>
                <tbody >';
        
        $a=HR_Company_payroll_computation::first();
        $numofdayspermonth=$a->work_day_per_month;
        $employee_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_info 
        JOIN 
        hr_employee_salary ON hr_employee_info.employee_id=hr_employee_salary.emp_id 
        JOIN hr_payroll ON hr_payroll.payroll_id=hr_employee_salary.payroll_id 
        JOIN hr_employee_salary_detail ON hr_employee_salary_detail.emp_id=hr_employee_info.employee_id 
        WHERE hr_employee_salary.payroll_id='$Sel' AND hr_employee_salary.salary_status='0'");
        foreach($employee_list as $rows2){
                $tablecontent.="<tr>";
                    $tablecontent.='<td>';
                    $tablecontent.=$rows2->employee_id;
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.=ucwords(strtolower($rows2->lname.", ".$rows2->fname." ".$rows2->mname));
                    $tablecontent.='</td>';
                    $tablecontent.='<td>';
                    $tablecontent.='<button onclick="includeEmp(\''.$rows2->employee_id.'\',\''.$Selected.'\')" class="btn btn-xs btn-success"><i class="fa fa-share" aria-hidden="true"></i></button>';
                    $tablecontent.='</td>';
                $tablecontent.='</tr>';
            
        }
        $tablecontent.='</tbody></table>';
        return $tablecontent;
    }
    public function include_emp_salary(Request $request){
        $data=HR_hr_employee_salary::where([
            ['emp_id','=',$request->emp_id],
            ['payroll_id','=',$request->id]
        ])->first();
        
        $data->salary_status='1';
        $data->salary_include_note=$request->reason;
        $data->save();
    }
}
