<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DateTime;
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
use App\HR_hr_asset_transaction_log;
use App\HR_hr_asset_extend_due_request;
use App\HR_hr_asset_transfer_request;
use App\HR_hr_audit;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
   
    function ReportAsset_type(Request $request){
        $Type=$request->Type;

        $returnHTML = view('ui_replacement.report_asset_type', compact('Type'))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    function ReplaceAuditParam(Request $request){
        $AuditMonth=$request->AuditMonth;
        $AuditYear=$request->AuditYear;
        $data=HR_hr_audit::where([
            ['audit_finish','=','1']
        ])->groupBy('audit_window_name')->get();
        $options='';
        foreach($data as $list){
            $audit_date=$list->audit_date;
            $audit_d = explode("-", $audit_date);
            $YearAudit=$audit_d[0];
            $MonthAudit=$audit_d[1];
            if($AuditYear==$YearAudit && $AuditMonth==$MonthAudit){
                $options.='<option>'.$list->audit_window_name.'</option>';

            }
        }
        return $options;
    }
    function Report(Request $request){
        $column_list = preg_split ("/\,/", $request->Columns);  
        $Columns=$column_list;
        $Kind=$request->Kind;
        $Type=$Kind;
        $value=$request->value;
        $value2=$request->value2;
        $ReportKind="";
        if($Type=="A1"){
            $ReportKind="Asset Report By Asset Type";
        }
        if($Type=="B1"){
            $ReportKind="Asset Depreciation Report Asset Type";
        }
        if($Type=="C1"){
            $ReportKind="Audit Report";
        }
        if($Type=="D1"){
            $ReportKind="Check Out Report By Asset Type";
        }
        if($Type=="A2"){
            $ReportKind="Asset Report By Location And Site";
        }
        if($Type=="B2"){
            $ReportKind="Asset Depreciation Report By Location";
        }
        if($Type=="C2"){
            $ReportKind="Audit Report By Location And Site";
        }
        if($Type=="D2"){
            $ReportKind="Check Out Report By Location And Site";
        }
        if($Type=="A3"){
            $ReportKind="Asset Report By Department";
        }
        if($Type=="B3"){
            $ReportKind="Asset Depreciation Report By Department";
        }
        if($Type=="C3"){
            $ReportKind="Audit Report By Department";
        }
        if($Type=="D3"){
            $ReportKind="Check Out Report By Department";
        }
        if($Type=="A4"){
            $ReportKind="Asset Report By Status";
        }
        if($Type=="B4"){
            $ReportKind="Asset Depreciation Report By Status";
        }
        if($Type=="C4"){
            $ReportKind="Audit Report By Status";
        }
        if($Type=="D4"){
            $ReportKind="Check Out Report By Status";
        }
        if($Type=="LS1"){
            $ReportKind="Lapsing Schedule Report";
        }
        $table='<table class="table table-bordered" style="width:5000px" id="ReportTable">';
        $asset_setup_lists=HR_hr_Asset_setup::where([
            ['asset_setup_tag','=','Asset Tag'],
            ['asset_setup_status','=','1']
        ])->get();
        if($Type=='LS1'){
            $asset_list=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID,hr_assets.purchase_order as PO FROM hr_assets
            LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
            WHERE asset_approval='1' ORDER BY asset_description ASC ");
            $returnHTML= view('ui_replacement.report_lapsing_schedule', compact('ReportKind','Columns','Kind','value','value2','asset_setup_lists','Type','asset_list'))->render();
            $table=$returnHTML;
        }
        if($Type=='A1' || $Type=='A2' || $Type=='A3' || $Type=='A4'){
            $WHERE='';
            $dept='';
            if($Type=="A2"){
                $WHERE="WHERE asset_location='$value' AND asset_site='$value2' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
                if($value=="All"){
                    $WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
                }
            }
            if($Type=="A3"){
                $WHERE="WHERE asset_department_code='$value' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
                if($value==""){
                    $WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
                }else{
                    $ddd=HR_Company_Department::where([
                        ['department_id','=',$value]
                    ])->first();
                    $dept=$ddd->department_name;
                }
            }
            $asset_list=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID,hr_assets.purchase_order as PO FROM hr_assets
            LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
            $WHERE ");
            $returnHTML= view('ui_replacement.report_asset_list', compact('ReportKind','Columns','Kind','value','value2','asset_setup_lists','Type','asset_list','dept'))->render();
            $table=$returnHTML;
        }
        if($Type=='B1' || $Type=='B2' || $Type=='B3' || $Type=='B4'){
            //report_depreciation
            $WHERE='';
            $dept='';
            if($Type=="B2"){
                $WHERE="WHERE asset_location='$value' AND asset_site='$value2' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
                if($value=="All"){
                    $WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
                }
            }
            if($Type=="B3"){
                $WHERE="WHERE asset_department_code='$value' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
                if($value==""){
                    $WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
                }else{
                    $ddd=HR_Company_Department::where([
                        ['department_id','=',$value]
                    ])->first();
                    $dept=$ddd->department_name;
                }
            }
            $asset_list=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID,hr_assets.purchase_order as PO FROM hr_assets
            LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
            $WHERE ");
            $returnHTML= view('ui_replacement.report_depreciation', compact('ReportKind','Columns','Kind','value','value2','asset_setup_lists','Type','asset_list','dept'))->render();
            $table=$returnHTML;
        }
        if($Type=='C1'){
            $audit_info=DB::connection('mysql')->select("SELECT * FROM hr_audit
            LEFT JOIN users ON users.id=hr_audit.auditor
            WHERE audit_window_name='$value' LIMIT 1");

            $getassetByType=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID,hr_assets.purchase_order as PO FROM hr_assets
            JOIN hr_audit ON hr_audit.audit_asset_tag=hr_assets.id
            LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
            WHERE audit_window_name='$value' AND audit_status='1' ORDER BY asset_description ASC");
            //return $getassetByType;
            $returnHTML= view('ui_replacement.report_audit', compact('ReportKind','Columns','Kind','value','value2','audit_info','getassetByType','asset_setup_lists','Type'))->render();
            $table=$returnHTML;
        }
        if($Type=='D1' || $Type=='D2' || $Type=='D3' || $Type=='D4'){
            $WHERE='';
            $dept='';
            if($Type=="D2"){
                $WHERE="WHERE asset_location='$value' AND asset_site='$value2' AND (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
                if($value=="All"){
                    $WHERE="WHERE (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
                }
            }
            if($Type=="D3"){
                $WHERE="WHERE asset_department_code='$value' AND (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
                if($value==""){
                    $WHERE="WHERE (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
                }else{
                    $ddd=HR_Company_Department::where([
                        ['department_id','=',$value]
                    ])->first();
                    $dept=$ddd->department_name;
                }
            }
            $asset_list=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID,hr_assets.asset_tag as ASSET_TAG,hr_assets.purchase_order as PO FROM hr_assets
            JOIN hr_asset_request ON hr_assets.id=hr_asset_request.asset_tag
            LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
            LEFT JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id
            
            $WHERE ");
            //report_checkout_list
           
            $returnHTML= view('ui_replacement.report_checkout_list', compact('ReportKind','Columns','Kind','value','value2','asset_setup_lists','Type','asset_list','dept'))->render();
            $table=$returnHTML;
        }


        $table.='</table>';
        return view('report', compact('column_list','Kind','value','value2','table'));
    }
}
