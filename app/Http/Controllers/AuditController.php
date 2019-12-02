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
        
        $result="";
        
        
        $asset_by_location_and_site=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID FROM hr_assets
        JOIN hr_audit ON hr_audit.audit_asset_tag=hr_assets.id
        LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
        WHERE audit_window_name='$AuditName'");

        $selected_asset_checkouts_list=DB::connection('mysql')->select("SELECT *,hr_asset_request.id as REQUEST_ID ,hr_asset_request.asset_tag as Request_Asset_tag,hr_assets.id as ASSET_ID FROM hr_asset_request
        JOIN hr_assets ON hr_assets.id=hr_asset_request.asset_tag
        JOIN hr_audit ON hr_audit.audit_asset_tag=hr_assets.id
        LEFT JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id
        WHERE audit_window_name='$AuditName'  and (request_status='2' OR request_status='1.1' OR request_status='1.2') AND request_active='ACTIVE'");
        $audit_list=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName]
        ])->first();
        $LocationAudit=!empty($audit_list)? $audit_list->audit_location : '';
        $AuditNote=!empty($audit_list)? $audit_list->audit_note : '';
        $SiteAudit=!empty($audit_list)? $audit_list->audit_site : '';
        $AuditDate=!empty($audit_list)? $audit_list->audit_date : '';
        $returnHTML = view('ui_replacement.existing_audit', compact('audit_list','asset_by_location_and_site','selected_asset_checkouts_list','AuditName','LocationAudit','SiteAudit','AuditDate','AuditNote'))->render();
        if(empty($audit_list)){
            $result="1";
            return response()->json(array('success' => true, 'html'=>$returnHTML,'result'=>$result));
        }
        if(!empty($audit_list) && $audit_list->audit_finish=="1"){
            $result="2";
            return response()->json(array('success' => true, 'html'=>$returnHTML,'result'=>$result));
        }
        return response()->json(array('success' => true, 'html'=>$returnHTML,'result'=>$result));
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
    public function GetNotFoundReconcileModal(Request $request){
        $Selected=$request->Selected;
        $Description=$request->Description;
        $AuditName=$request->AuditName;
        $id=$request->id;
        $LastHeldBy='';
        $NameEMp='';
        $Locations='';
        $Site='';
        $AssignTo='';
        $asset_department_code='';
        $audit_asset_not_found=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID FROM hr_assets
        JOIN hr_audit ON hr_audit.audit_asset_tag=hr_assets.id
        LEFT JOIN hr_company_department ON hr_company_department.department_id=hr_assets.asset_department_code
        WHERE audit_window_name='$AuditName' AND audit_asset_tag='$id' AND audit_check='0' ORDER BY  audit_status ASC");
        foreach($audit_asset_not_found as $rows){
            $Locations=$rows->asset_location;
            $Site=$rows->asset_site;
            $asset_department_code=$rows->asset_department_code;
            $AssignTo=$rows->asset_assign_to;
        }
        
        $audit_asset_not_found=DB::connection('mysql')->select("SELECT * FROM hr_asset_request JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id WHERE asset_tag='$id' AND request_status!='2.1' AND request_status!='2.2' ORDER BY asset_borrow_date DESC LIMIT 1");
        foreach($audit_asset_not_found as $borrow){
            $LastHeldBy=$borrow->emp_id;
            $NameEMp=$borrow->fname." ".$borrow->lname;
        }
        $audit_asset_not_found=DB::connection('mysql')->select("SELECT * FROM hr_audit WHERE audit_window_name='$AuditName' AND audit_asset_tag='$id'");
        foreach($audit_asset_not_found as $record){
            $audit_action=$record->audit_action;
            $audit_action_note=$record->audit_action_note;
            $audit_action_reason=$record->audit_action_reason;
            $audit_move_department=$record->audit_move_department;
            $audit_move_employee=$record->audit_move_employee;
            $maintenanceduedate=$record->maintenanceduedate;
        }
		
        
        $returnHTML = view('ui_replacement.notfoundreconcilemodal', compact('Selected','Description','AuditName','AssignTo','id','Site','LastHeldBy','NameEMp','Locations','asset_department_code','audit_action','audit_action_note','audit_action_reason','audit_move_department','audit_move_employee','maintenanceduedate'))->render();
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
    public function SaveFirstAudit(Request $request){
        $difflocation=$request->difflocation;
        $unchecked=$request->unchecked;
        $checked=$request->checked;
        $AuditWindowName=$request->AuditWindowName;
        $AuditDate=$request->AuditDate;
        $AuditNote=$request->AuditNote;
        $Location=$request->Location;
        $Site=$request->SiteAudit;
        $AuditCount=HR_hr_audit::where([
            ['audit_window_name','=',$AuditWindowName]
        ])->count();
        if($AuditCount<1){
            if(!empty($difflocation)){
                foreach($difflocation as $check){
                    $datenow=date('Y-m-d');
                    $t=time();
                    $transaction="";
                    $Reuquestor="";
                    $Loc=HR_hr_Asset::find($check);
                    if(!empty($Loc)){
                        if($Loc->asset_transaction_status=="2" || $Loc->asset_transaction_status=="1.1" || $Loc->asset_transaction_status=="1.2"){
                            $transaction="Check Out";
                            $asset_oncheckout=DB::connection('mysql')->select("SELECT *,hr_asset_request.id as REQUEST_ID FROM hr_asset_request
                            LEFT JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id
                            WHERE (request_status='2' OR request_status='1.1' OR request_status='1.2') AND request_active='ACTIVE'");
                            foreach($asset_oncheckout as $ss){
                                $Reuquestor=$ss->fname." ".$ss->lname;
                                break;
                            }
                            
                        }
                        
                        if($Loc->asset_transaction_status=="4"){
                            $transaction="Maintenace";
                            $asset_on_maintenance=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID FROM hr_assets 
                            LEFT JOIN users ON users.id=hr_assets.maintenance_requestor WHERE hr_assets.id='$check'");
                            foreach($asset_on_maintenance as $ss){
                                $Reuquestor=$ss->name;
                            }
                            
                        }
                        $Audit=HR_hr_audit::where([
                            ['audit_window_name','=',$AuditWindowName],
                            ['audit_asset_tag','=',$check]
                        ])->first();
                        if(empty($Audit)){
                            $Audit=new HR_hr_audit;
                        }
                        $Audit->audit_window_name=$AuditWindowName;
                        $Audit->audit_asset_tag=$check;
                        $Audit->audit_date=$AuditDate;
                        $Audit->audit_location=$Location;
                        $Audit->audit_note=$AuditNote;
                        $Audit->audit_status='1';
                        $Audit->audit_check='2';
                        $Audit->audit_site=$Site;
                        $Audit->auditor=Auth::user()->id;
                        $Audit->transaction=$transaction;
                        $Audit->requestor=$Reuquestor;
                        if($Audit->save()){
                            $date = new DateTime();
                            $result = $date->format('Y-m-d H:i:s');
                            $this->generate_transaction_log($AuditWindowName.$check.$result,$check,'','Audited',$AuditWindowName,'');
                        }
                    }
                    
                }
            }
            if(!empty($checked)){
                foreach($checked as $check){
                    $datenow=date('Y-m-d');
                    $t=time();
                    $transaction="";
                    $Reuquestor="";
                    $Loc=HR_hr_Asset::find($check);
                    if(!empty($Loc)){
                        if($Loc->asset_transaction_status=="2" || $Loc->asset_transaction_status=="1.1" || $Loc->asset_transaction_status=="1.2"){
                            $transaction="Check Out";
                            $asset_oncheckout=DB::connection('mysql')->select("SELECT *,hr_asset_request.id as REQUEST_ID FROM hr_asset_request
                            LEFT JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id
                            WHERE (request_status='2' OR request_status='1.1' OR request_status='1.2') AND request_active='ACTIVE'");
                            foreach($asset_oncheckout as $ss){
                                $Reuquestor=$ss->fname." ".$ss->lname;
                                break;
                            }
                            
                        }
                        
                        if($Loc->asset_transaction_status=="4"){
                            $transaction="Maintenace";
                            $asset_on_maintenance=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID FROM hr_assets 
                            LEFT JOIN users ON users.id=hr_assets.maintenance_requestor WHERE hr_assets.id='$check'");
                            foreach($asset_on_maintenance as $ss){
                                $Reuquestor=$ss->name;
                            }
                            
                        }
                        $Audit=HR_hr_audit::where([
                            ['audit_window_name','=',$AuditWindowName],
                            ['audit_asset_tag','=',$check]
                        ])->first();
                        if(empty($Audit)){
                            $Audit=new HR_hr_audit;
                        }
                        $Audit->audit_window_name=$AuditWindowName;
                        $Audit->audit_asset_tag=$check;
                        $Audit->audit_date=$AuditDate;
                        $Audit->audit_location=$Location;
                        $Audit->audit_note=$AuditNote;
                        $Audit->audit_status='1';
                        $Audit->audit_check='1';
                        $Audit->audit_site=$Site;
                        $Audit->auditor=Auth::user()->id;
                        $Audit->transaction=$transaction;
                        $Audit->requestor=$Reuquestor;
                        if($Audit->save()){
                            $date = new DateTime();
                            $result = $date->format('Y-m-d H:i:s');
                            $this->generate_transaction_log($AuditWindowName.$check.$result,$check,'','Audited',$AuditWindowName,'');
                        }
                    }
                    
                }
            }
            if(!empty($unchecked)){
                foreach($unchecked as $check){
                    $datenow=date('Y-m-d');
                    $t=time();
                    $transaction="";
                    $Reuquestor="";
                    $Loc=HR_hr_Asset::find($check);
                    if(!empty($Loc)){
                        if($Loc->asset_transaction_status=="2" || $Loc->asset_transaction_status=="1.1" || $Loc->asset_transaction_status=="1.2"){
                            $transaction="Check Out";
                            $asset_oncheckout=DB::connection('mysql')->select("SELECT *,hr_asset_request.id as REQUEST_ID FROM hr_asset_request
                            LEFT JOIN hr_employee_info ON hr_employee_info.employee_id=hr_asset_request.emp_id
                            WHERE (request_status='2' OR request_status='1.1' OR request_status='1.2') AND request_active='ACTIVE'");
                            foreach($asset_oncheckout as $ss){
                                $Reuquestor=$ss->fname." ".$ss->lname;
                                break;
                            }
                            
                        }
                        
                        if($Loc->asset_transaction_status=="4"){
                            $transaction="Maintenace";
                            $asset_on_maintenance=DB::connection('mysql')->select("SELECT *,hr_assets.id as ASSET_ID FROM hr_assets 
                            LEFT JOIN users ON users.id=hr_assets.maintenance_requestor WHERE hr_assets.id='$check'");
                            foreach($asset_on_maintenance as $ss){
                                $Reuquestor=$ss->name;
                            }
                            
                        }
                        $Audit=HR_hr_audit::where([
                            ['audit_window_name','=',$AuditWindowName],
                            ['audit_asset_tag','=',$check]
                        ])->first();
                        if(empty($Audit)){
                            $Audit=new HR_hr_audit;
                        }
                        $Audit->audit_window_name=$AuditWindowName;
                        $Audit->audit_asset_tag=$check;
                        $Audit->audit_date=$AuditDate;
                        $Audit->audit_location=$Location;
                        $Audit->audit_note=$AuditNote;
                        
                        $Audit->audit_check='0';
                        $Audit->audit_site=$Site;
                        $Audit->auditor=Auth::user()->id;
                        $Audit->transaction=$transaction;
                        $Audit->requestor=$Reuquestor;
                        $Audit->save();
                    }
                    
                } 
            }
        }
        
    }
    public function SaveAssetMoveAudit(Request $request){
        $AuditName=$request->AuditName;
        $check=$request->tag;
        $site=$request->site;
        $location=$request->location;
        $department=$request->department;
        $name=$request->name;
        $note=$request->note;
        $datenow=date('Y-m-d');
        $Audit=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName],
            ['audit_asset_tag','=',$check]
        ])->first();
        if(empty($Audit)){
            $Audit=new HR_hr_audit;
        }
        
        $Audit->audit_action="Move/Assign To";
        $Audit->audit_move_employee=$name;
        $Audit->audit_move_department=$department;
        $Audit->audit_action_note=$note;
        $Audit->audit_action_date=$datenow;
        $Audit->audit_action_reason=$location;
        $Audit->maintenanceduedate=$site;
        $Audit->audit_status='1';
        
        if($Audit->save()){
            $date = new DateTime();
            $result = $date->format('Y-m-d H:i:s');
            $this->generate_transaction_log($AuditName.$check.$result,$check,'Move/Assign To','Audited',$AuditName,$note);
        }
    }
    public function SaveAssetDisposalAudit(Request $request){
        $AuditName=$request->AuditName;
        $check=$request->tag;
        $site=$request->site;
        $location=$request->location;
        $department=$request->department;
        $name=$request->name;
        $note=$request->note;
        $datenow=date('Y-m-d');
        $Audit=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName],
            ['audit_asset_tag','=',$check]
        ])->first();
        if(empty($Audit)){
            $Audit=new HR_hr_audit;
        }
        $Audit->audit_action="Dispose";
        $Audit->audit_status='1';
        $Audit->audit_action_note=$note;
        $Audit->audit_action_reason=$location;
        $Audit->audit_action_date=$datenow;
        if($Audit->save()){
            $date = new DateTime();
            $result = $date->format('Y-m-d H:i:s');
            $this->generate_transaction_log($AuditName.$check.$result,$check,'Dispose','Audited',$AuditName,$note);
        }
    }
    public function SaveAssetMaintenanceAudit(Request $request){
        $AuditName=$request->AuditName;
        $check=$request->tag;
        $location=$request->location;
        $DueDate=$request->DueDate;
        
        $note=$request->note;
        $datenow=date('Y-m-d');
        $Audit=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName],
            ['audit_asset_tag','=',$check]
        ])->first();
        if(empty($Audit)){
            $Audit=new HR_hr_audit;
        }
        $Audit->audit_action="Maintenance";
        $Audit->audit_status='1';
        $Audit->audit_action_note=$note;
        $Audit->audit_action_reason=$location;
        $Audit->audit_action_date=$datenow;
        $Audit->maintenanceduedate=$DueDate;
        
        if($Audit->save()){
            $date = new DateTime();
            $result = $date->format('Y-m-d H:i:s');
            $this->generate_transaction_log($AuditName.$check.$result,$check,'Maintenance','Audited',$AuditName,$note);
        }
    }
    public function SaveAssetOtherAudit(Request $request){
        $AuditName=$request->AuditName;
        $check=$request->tag;
        $note=$request->note;
        $datenow=date('Y-m-d');
        $Audit=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName],
            ['audit_asset_tag','=',$check]
        ])->first();
        if(empty($Audit)){
            $Audit=new HR_hr_audit;
        }
        $Audit->audit_action="Other";
        $Audit->audit_status='1';
        $Audit->audit_action_note=$note;
        $Audit->audit_action_date=$datenow;
        
        if($Audit->save()){
            $date = new DateTime();
            $result = $date->format('Y-m-d H:i:s');
            $this->generate_transaction_log($AuditName.$check.$result,$check,'Other','Audited',$AuditName,$note);
        }
    }
    public function FinishAudit(Request $request){
        $AuditName=$request->AuditName;
        $Audit=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName],
            ['audit_status','=','0']
        ])->get();
        foreach($Audit as $audit){

            $date = new DateTime();
            $result = $date->format('Y-m-d H:i:s');
            $this->generate_transaction_log($AuditName.$audit->audit_asset_tag.$result,$audit->audit_asset_tag,'','Audited',$AuditName,'');
        }
        $Audit=HR_hr_audit::where([
            ['audit_window_name','=',$AuditName]
        ])->get();
        foreach($Audit as $data){
            $data->audit_status='1';
            $data->audit_finish='1';
            $data->save();
        }
    }
}
