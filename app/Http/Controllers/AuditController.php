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
use App\HR_hr_asset_transaction_log;
use App\HR_hr_asset_extend_due_request;
use App\HR_hr_asset_transfer_request;
use App\HR_hr_audit;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;
class AuditController extends Controller
{
    //
    public function CountExistingAudit(Request $request){
        $AuditName=$request->AuditName;
        $data=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName]
        ])->count();
        return $data;
    }
    public function FetchExistingAudit(Request $request){
        $AuditName=$request->AuditName;
        $audit_list=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName]
        ])->get();
        $returnHTML = view('ui_replacement.existing_audit', compact('audit_list'))->render();
        
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    public function get_assets_audit(Request $request){
        $AuditName=$request->AuditName;
        $LocationAudit=$request->LocationAudit;
        $AuditNote=$request->AuditNote;
        $SiteAudit=$request->SiteAudit;
        $AuditDate=$request->AuditDate;
        $audit_list=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName]
        ])->get();
        
        $asset_by_location_and_site=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID FROM hr_assets
        LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
        WHERE asset_location='$LocationAudit' AND asset_site='$SiteAudit'");

        $selected_asset_checkouts_list=DB::connection('mysql')->select("SELECT *,hr_asset_request.id as REQUEST_ID ,hr_asset_request.asset_tag as Request_Asset_tag,hr_assets.id as ASSET_ID FROM hr_asset_request
        JOIN hr_assets ON hr_assets.id=hr_asset_request.asset_tag
        LEFT JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id
        WHERE asset_location='$LocationAudit' AND asset_site='$SiteAudit' and (request_status='2' OR request_status='1.1' OR request_status='1.2') AND request_active='ACTIVE'");

        $returnHTML = view('ui_replacement.fetched_audit', compact('audit_list','asset_by_location_and_site','selected_asset_checkouts_list','AuditName','LocationAudit','SiteAudit'))->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    public function GETAUDITEXCEL(Request $request){
        $streamedResponse = new StreamedResponse();
        $streamedResponse->setCallback(function () use($request) {
            //load spreadsheet
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("extra/audit/download_audit_asset_list.xlsx");

            //change it
            $sheet = $spreadsheet->getActiveSheet();
            $AuditName=$request->name;
            $LocationAudit=$request->location;
            $SiteAudit=$request->site;
            $audit_list=HR_hr_audit::where([
                ['audit_window_name','=',$AuditName]
            ])->get();
            
            if(count($audit_list)>0){

            }else{
                $asset_by_location_and_site=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID FROM hr_assets
                LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
                WHERE asset_location='$LocationAudit' AND asset_site='$SiteAudit'");
        
                $selected_asset_checkouts_list=DB::connection('mysql')->select("SELECT *,hr_asset_request.id as REQUEST_ID ,hr_asset_request.asset_tag as Request_Asset_tag,hr_assets.id as ASSET_ID FROM hr_asset_request
                JOIN hr_assets ON hr_assets.id=hr_asset_request.asset_tag
                LEFT JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id
                WHERE asset_location='$LocationAudit' AND asset_site='$SiteAudit' and (request_status='2' OR request_status='1.1' OR request_status='1.2') AND request_active='ACTIVE'");
                $index=4;
                foreach($asset_by_location_and_site as $data){
                    
                    $sheet->setCellValue('B'.$index, $data->asset_tag);
                    $ssasdasd=HR_hr_Asset_setup::where([
                        ['asset_setup_tag','=','Asset Tag'],
                        ['asset_setup_status','=','1'],
                        ['asset_setup_ad','=',$data->asset_description]
                    ])->groupBy('asset_setup_description')->first();

                    $sheet->setCellValue('C'.$index, !empty($ssasdasd)? $ssasdasd->asset_setup_description : '');
                    $sheet->setCellValue('D'.$index, $data->asset_brand);
                    $sheet->setCellValue('E'.$index, $data->asset_model);
                    $sheet->setCellValue('F'.$index, $data->asset_serial_number);
                    $sheet->setCellValue('G'.$index, $data->department_name);
                    $sheet->setCellValue('H'.$index, $data->asset_site);
                    $sheet->setCellValue('I'.$index, $data->asset_location);
                    if($data->asset_transaction_status=="1" || $data->asset_transaction_status=="2.1" || $data->asset_transaction_status=="2.2" ){
                        
                        $sheet->setCellValue('J'.$index, "Available");
                    }
                    if($data->asset_transaction_status=="2" || $data->asset_transaction_status=="1.1" || $data->asset_transaction_status=="1.2"){
                        
                        $sheet->setCellValue('J'.$index, "Checked Out");
                    }
                    
                    if($data->asset_transaction_status=="4.1" || $data->asset_transaction_status=="4.2"){
                        
                        $sheet->setCellValue('J'.$index, "Queued for Maintenance");
                    }
                    if($data->asset_transaction_status=="4"){
                       
                        $sheet->setCellValue('J'.$index, "On Maintenace");
                    }
                    foreach($selected_asset_checkouts_list as $ch){
                        if($ch->Request_Asset_tag==$data->ASSET_ID){
                            $sheet->setCellValue('K'.$index,$ch->fname." ".$ch->lname);
                            break;
                        }
                    }
                    
                    $index++;
                }

            }
            
            //write it again to Filesystem with the same name (=replace)
            $writer = new Xlsx($spreadsheet);
            // $writer->save('extra/import_file/yourspreadsheet.xlsx');
            $writer->save('php://output');
        });
        $streamedResponse->setStatusCode(Response::HTTP_OK);
        $streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $streamedResponse->headers->set('Content-Disposition', 'attachment; filename="Audit Asset List.xlsx"');
        return $streamedResponse->send();
        // Excel::load('extra/audit/download_audit_asset_list.xlsx', function($doc) use($request) {
            
            

        // })->setFilename('Audit Asset List '.date('m-d-Y'))->download('xlsx');
    }
}