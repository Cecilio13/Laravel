<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
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
use App\HR_hr_cash_advances_payment;
use App\HR_hr_asset_transaction_log;
use App\HR_hr_Asset;
use App\User;
use App\HR_hr_Asset_setup;


use App\Company;
use App\Sales;
use App\Expenses;
use App\Advance;
use App\Customers;
use App\ProductsAndServices;
USE App\SalesTransaction;
use App\Supplier;
use App\JournalEntry;
use App\Formstyle;
use App\Report;
use App\AuditLog;
use App\Voucher;
use App\ChartofAccount;
use App\Numbering;
use App\CostCenter;
use App\DepositRecord;
use App\Bank;
use App\UserAccess;
use App\Clients;

class ApiController extends Controller
{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header('Content-type: application/x-www-form-urlencoded');
        
    }
    public function getAllStudents() {
        
        $users = User::get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);
    }
    public function getDashboardData(Request $request){
        $sales_transaction = DB::connection('mysql')->select("SELECT * FROM sales_transaction");
        
        $total_invoice_receivable=0;
        $total_invoice_receivable_due=0;
        foreach($sales_transaction as $transaction){
            if($transaction->st_type == "Invoice" && $transaction->remark!="Cancelled"){
                $total_invoice_receivable += $transaction->st_balance;
                if(strtotime($transaction->st_due_date) < time()){
                    $total_invoice_receivable_due += $transaction->st_balance;
                }
            }
            
        }
        $overduetotal_amount=0;
        $unuetotal_amount=0;
        $current_month=0;
        $current_month_due=0;
        $current_month_less_one=0;
        $current_month_less_one_due=0;
        $current_month_less_two=0;
        $current_month_less_two_due=0;
        $current_month_less_three=0;
        $current_month_less_three_due=0;
        $rest=$request->expense_month;
        if($rest==""){
            $rest=date('n');
        }
        $month_selected_raw=$rest;
        $month_selected=$rest;
        if($month_selected<10){
            $month_selected="0".$month_selected;
        }

        $year_less_one=date('Y');
        $month_selected_less_one=$rest-1;
        $one_month=$rest-1;
        if($month_selected_less_one<=0){
            $month_selected_less_one+=12;
            $one_month+=12;
            $year_less_one=date('Y')-1;
        }
        if($month_selected_less_one<10){
            $month_selected_less_one="0".$month_selected_less_one;
        }

        $year_less_two=date('Y');
        $month_selected_less_two=$rest-2;
        $two_month=$month_selected_less_two;
        if($month_selected_less_two<=0){
            $month_selected_less_two+=12;
            $two_month+=12;
            $year_less_two=date('Y')-1;
        }
        if($month_selected_less_two<10){
            $month_selected_less_two="0".$month_selected_less_two;
        }

        $year_less_three=date('Y');
        $month_selected_less_three=$rest-3;
        $three_month=$month_selected_less_two;
        if($month_selected_less_three<=0){
            $month_selected_less_three+=12;
            $three_month+=12;
            $year_less_three=date('Y')-1;
        }
        if($month_selected_less_three<10){
            $month_selected_less_three="0".$month_selected_less_three;
        }
        $expense_transactions = DB::table('expense_transactions')
            ->join('et_account_details', 'expense_transactions.et_no', '=', 'et_account_details.et_ad_no')
            ->join('customers', 'customers.customer_id', '=', 'expense_transactions.et_customer')
            ->get();
        foreach($expense_transactions as $et){
        
            if ($et->et_type==$et->et_ad_type){
                if($et->et_due_date!=""){
                    
                    if($et->et_date>=date('Y-'.$month_selected.'-01') && $et->et_date<=date('Y-'.$month_selected.'-t') ){
                        $date1=date_create(date('Y-m-d'));
                        $date2=date_create($et->et_due_date);
                        $diff=date_diff($date1,$date2);
                        if(($diff->format("%R")=="-" || ($diff->format("%R")=="+" && $diff->format("%a")=="0")) && $et->et_bil_status!="Paid" && $et->remark=="" ){
                            $current_month_due+=$et->bill_balance;
                        }else{
                            if($et->et_bil_status!="Paid" && $et->remark==""){
                                $current_month+=$et->bill_balance;
                            }   
                        }
                    }
                    if($et->et_date>=date($year_less_one.'-'.$month_selected_less_one.'-01') && $et->et_date<=date($year_less_one.'-'.$month_selected_less_one.'-t') ){
                        $date1=date_create(date('Y-m-d'));
                        $date2=date_create($et->et_due_date);
                        $diff=date_diff($date1,$date2);
                        if(($diff->format("%R")=="-" || ($diff->format("%R")=="+" && $diff->format("%a")=="0")) && $et->et_bil_status!="Paid" && $et->remark=="" ){
                            $current_month_less_one_due+=$et->bill_balance;
                        }else{
                            if($et->et_bil_status!="Paid" && $et->remark==""){
                                $current_month_less_one+=$et->bill_balance;
                            }   
                        }
                    }
    
                    if($et->et_date>=date($year_less_two.'-'.$month_selected_less_two.'-01') && $et->et_date<=date($year_less_two.'-'.$month_selected_less_two.'-t') ){
                        $date1=date_create(date('Y-m-d'));
                        $date2=date_create($et->et_due_date);
                        $diff=date_diff($date1,$date2);
                        if(($diff->format("%R")=="-" || ($diff->format("%R")=="+" && $diff->format("%a")=="0")) && $et->et_bil_status!="Paid" && $et->remark=="" ){
                            $current_month_less_two_due+=$et->bill_balance;
                        }else{
                            if($et->et_bil_status!="Paid" && $et->remark==""){
                                $current_month_less_two+=$et->bill_balance;
                            }   
                        }
                    }
                    if($et->et_date>=date($year_less_three.'-'.$month_selected_less_three.'-01') && $et->et_date<=date($year_less_three.'-'.$month_selected_less_three.'-t') ){
                        $date1=date_create(date('Y-m-d'));
                        $date2=date_create($et->et_due_date);
                        $diff=date_diff($date1,$date2);
                        if(($diff->format("%R")=="-" || ($diff->format("%R")=="+" && $diff->format("%a")=="0")) && $et->et_bil_status!="Paid" && $et->remark=="" ){
                            $current_month_less_three_due+=$et->bill_balance;
                        }else{
                            if($et->et_bil_status!="Paid" && $et->remark==""){
                                $current_month_less_three+=$et->bill_balance;
                            }   
                        }
                    }
    
                }
            }
        }    
        $current_year=date('Y');
        $data = array(
            'current_year'=> $current_year,
            'month_selected_raw' => $month_selected_raw,
            'current_month_less_three' => $current_month_less_three,
            'current_month_less_three_due' => $current_month_less_three_due,
            'month_selected_less_three' => $month_selected_less_three,
            'year_less_three' => $year_less_three,
            'three_month' => $three_month,
            'one_month' => $one_month,
            'two_month' => $two_month,
            'current_month_less_two' => $current_month_less_two,
            'current_month_less_two_due' => $current_month_less_two_due,
            'month_selected_less_two' => $month_selected_raw,
            'year_less_two' => $year_less_two,
            'year_less_one' => $year_less_one,
            'current_month_less_one' => $current_month_less_one,
            'current_month_less_one_due' => $current_month_less_one_due,
            'current_month_due' => $current_month_due,
            'current_month' => $current_month,
            'overduetotal_amount' => $overduetotal_amount,
            'unuetotal_amount' => $unuetotal_amount,
            'total_invoice_receivable' => $total_invoice_receivable,
            'total_invoice_receivable_due' => $total_invoice_receivable_due
        );
        // $data = array(
        //     'month_selected_raw' => $month_selected_raw,
        //     'Total' => $countloop,
        //     'Skiped'  => $error_count,
        //     'Error_Log' =>$Log,
        //     'Extra'=>$extra
        // );
        return response($data, 200);
    }
    public function update_setting_company(Request $request){
        
        $company = Company::first();
        if(!empty($company)){
            $company->company_name = $request->company_name;
            $company->company_legal_name = $request->legal_name;
            $company->company_business_id_no = $request->business_id_no;
            $company->company_tax_form = $request->tax_form;
            $company->company_industry = $request->industry;
            $company->company_email = $request->company_email;
            $company->company_customer_facing_email = $request->customer_facing_email;
            $company->company_phone = $request->company_phone;
            $company->company_website = $request->website;
            $company->company_address = $request->company_address;
            $company->company_customer_facing_address = $request->customer_facing_address;
            $company->company_legal_address = $request->legal_address;
            $company->company_address_postal = $request->postal1;
            $company->facing_postal = $request->postal2;
            $company->legal_postal = $request->postal3;
            $company->company_tin_no = $request->com_tin_no;
            if ($request->hasFile('esignatory')) {
                $request->esignatory->storeAs('e_sig', $request->esignatory->getClientOriginalName());
                $company->esig = $request->esignatory->getClientOriginalName();
            }
            
            $company->save(); 
        }else{
            $company = new Company;
            $company->company_name = $request->company_name;
            $company->company_legal_name = $request->legal_name;
            $company->company_business_id_no = $request->business_id_no;
            $company->company_tax_form = $request->tax_form;
            $company->company_industry = $request->industry;
            $company->company_email = $request->company_email;
            $company->company_customer_facing_email = $request->customer_facing_email;
            $company->company_phone = $request->company_phone;
            $company->company_website = $request->website;
            $company->company_address = $request->company_address;
            $company->company_customer_facing_address = $request->customer_facing_address;
            $company->company_legal_address = $request->legal_address;
            $company->company_address_postal = $request->postal1;
            $company->facing_postal = $request->postal2;
            $company->legal_postal = $request->postal3;
            $company->company_tin_no = $request->com_tin_no;
            if ($request->hasFile('esignatory')) {
                $request->esignatory->storeAs('e_sig', $request->esignatory->getClientOriginalName());
                $company->esig = $request->esignatory->getClientOriginalName();
            }
            
            $company->save(); 
        }
    }
    public function getAccount(Request $request){
        $users = ChartofAccount::where([
            ['coa_active','=','1']
        ])->get()->toJson(JSON_PRETTY_PRINT);
        return response($users, 200);
    }
    public function getSettingCompany(Request $request){
        $data = Company::first()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getSettingSales(Request $request){
        $data = Sales::first()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getSettingExpense(Request $request){
        $data = Expenses::first()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getSettingAdvanceNumberring(Request $request){
        $data = Numbering::first()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getSettingAdvance(Request $request){
        $data = Advance::first()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getBanks(Request $request){
        $data = Bank::where([
            ['bank_status','=','1']
        ])->get()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getBankInfo(Request $request){
        $data = Bank::where([
            ['bank_no','=',$request->bank_id]
        ])->first()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    
    public function update_setting_sales(Request $request){
        $sales = Sales::first();
        
        if(!empty($sales)){
        $sales->id ='0';
        $sales->sales_show_product_column = $request->show_product_column;
        $sales->sales_show_sku_column = $request->show_sku_column;
        $sales->sales_track_quantity_and_price = $request->track_quantity_and_price;
        $sales->sales_track_quantity_on_hand = $request->track_quantity_on_hand;
        
        $sales->sales_sales_receipt_preferred_debit_cheque_account = $request->preferred_bedit_cheque_account;
        
        $sales->save();
        }else{
            $sales = new Sales;
            $sales->id ='0';
            $sales->sales_show_product_column = $request->show_product_column;
            $sales->sales_show_sku_column = $request->show_sku_column;
            $sales->sales_track_quantity_and_price = $request->track_quantity_and_price;
            $sales->sales_track_quantity_on_hand = $request->track_quantity_on_hand;
            
            $sales->sales_sales_receipt_preferred_debit_cheque_account = $request->preferred_bedit_cheque_account;
            $sales->save();
        }
    }
    public function update_setting_expense(Request $request){
        $expenses = Expenses::first();
        if(!empty($expenses)){
            $expenses->id ='0';
            $expenses->expenses_show_items_table = $request->show_items_table;
            $expenses->expenses_track_expense_and_item_by_customer = $request->track_expense_and_item_by_customer;
            $expenses->expenses_billable = $request->billable;
            $expenses->expenses_bill_payment_terms = $request->bill_payment_terms;
            $expenses->expenses_use_purchase_order = $request->use_purchase_order;
            $expenses->expenses_purchase_order_email_message = $request->purchase_order_email_message;
            $expenses->save();
        }else{
            $expenses = new Expenses;
            $expenses->id ='0';
            $expenses->expenses_show_items_table = $request->show_items_table;
            $expenses->expenses_track_expense_and_item_by_customer = $request->track_expense_and_item_by_customer;
            $expenses->expenses_billable = $request->billable;
            $expenses->expenses_bill_payment_terms = $request->bill_payment_terms;
            $expenses->expenses_use_purchase_order = $request->use_purchase_order;
            $expenses->expenses_purchase_order_email_message = $request->purchase_order_email_message;
            $expenses->save();
        }
    }
    public function update_setting_advance(Request $request){
        //return $request;
        $numbering = Numbering::first();
        if(empty($numbering)){
            $numbering = new Numbering;
        }
        $numbering->numbering_no="0";
        $numbering->sales_exp_start_no=$request->numbering_sales_exp;
        $numbering->numbering_bill_invoice_main=$request->numbering_bill_invoice_main;
        $numbering->numbering_sales_invoice_branch=$request->numbering_sales_invoice_branch;
        $numbering->numbering_bill_invoice_branch=$request->numbering_bill_invoice_branch;

        $numbering->cash_voucher_start_no=$request->numbering_cash_voucher;
        $numbering->cheque_voucher_start_no=$request->numbering_cheque_voucher;
        $numbering->use_cost_center=$request->useCostCenter;

        $numbering->credit_note_start_no=$request->numbering_credit_note;
        $numbering->sales_receipt_start_no=$request->numbering_sales_receipt;
        $numbering->bill_start_no=$request->numbering_bill;
        $numbering->suppliers_credit_start_no=$request->numbering_suppliers_credit;
        $numbering->estimate_start_no=$request->numbering_estimate;
        
        $numbering->save();
        
        
        $advance = Advance::first();
        if(empty($advance)){
            $advance = new Advance;
        }
        $advance->id ='0';
        
        $advance->advance_first_month_of_fiscal_year = $request->first_month_of_fiscal_year;
        $advance->advance_first_month_of_tax_year = $request->first_month_of_tax_year;
        $advance->advance_accounting_method = $request->accounting_method;
        $advance->advance_close_book = $request->close_book;
        $advance->advance_end_month_of_fiscal_year = $request->end_month_of_fiscal_year;
        $advance->advance_beginning_balance = $request->ad_beg_bal;
        $advance->advance_enable_acc_number = $request->enable_acc_number;
        $advance->advance_date_format = $request->date_format;
        $advance->advance_number_format = $request->number_format;
        $advance->advance_inactive_time = $request->inactive_time;
        
        $advance->save();
    }
    public function add_bank(Request $request){
        
        $Bank = new Bank;
        $BankNo= Bank::count()+1;
        $Bank->bank_no=$BankNo;
        $Bank->bank_name=$request->BankNameInput;
        $Bank->bank_code=$request->BankCodeInput;
        $Bank->bank_branch=$request->BankBranchInput;
        
        $Bank->bank_account_no=$request->AccountNoInput;
        $Bank->bank_remark=$request->RemarkTextAreaBank;
        $Bank->save();

    }
    public function update_bank(Request $request){
        $Bank =BankEdits::find($request->BankNoHidden);
        if(empty($Bank)){
            $Bank = new BankEdits;
        }
        $Bank->bank_no=$request->BankNoHidden;
        $Bank->bank_name=$request->BankNameInput;
        $Bank->bank_code=$request->BankCodeInput;
        $Bank->bank_branch=$request->BankBranchInput;
        $Bank->bank_account_no=$request->AccountNoInput;
        $Bank->bank_remark=$request->RemarkTextAreaBank;
        $Bank->edit_status="0";
        $Bank->save();
    }
}
