<?php

namespace App\Http\Controllers;
use Auth;
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
use App\HR_hr_notification;
use App\HR_hr_cash_advances_payment;
use App\HR_hr_asset_transaction_log;

class NotifController extends Controller
{
    public function clearnotif(Request $request){
        $data =HR_hr_notification::where([
            ['notif_target','=',$request->id]
        ])->get();
        foreach($data as $dat){
            $dat->notif_status='0';
            $dat->save();
        }
        
    }
    public function fetch_notif(Request $request){
        $notifications=HR_hr_notification::where([
            ['notif_target','=', $request->id],
            ['notif_status','=', '1']
        ])->orderBy('notif_date', 'DESC')->get();
        $notif_count2=count($notifications);
        $limit=30;
        if($notif_count2>30){
            $limit=$notif_count2;
        }

        $notifications_limited_list=HR_hr_notification::where([
            ['notif_target','=', $request->id]
        ])->orderBy('notif_date', 'DESC')->limit(10)->get();

        $output="";
        if(count($notifications_limited_list)>0){
            foreach($notifications_limited_list as $rows){
                $timestamp=$rows->notif_date;
                $time = strtotime($timestamp);
                $curtime = date("Y-m-d H:i:s");
                $time2 = strtotime($curtime);
                $diff=$time2-$time;
                $ago="";
                $convertd=(($diff/60)/60)/24;
                if($convertd<1){
                    $convertd1=($diff/60)/60;
                    if($convertd1<1){
                        $convertd12=$diff/60;
                        if($convertd12<1){
                            $ago="a moment ago";
                            
                        }else{
                            if($convertd12<1){
                                $ago=number_format($convertd12)." min ago";
                            }else{
                                $ago=number_format($convertd12)." mins ago";
                            }
                            
                            
                        }
                    }else{
                        if($convertd1<1){
                            $ago=number_format($convertd1)." hr ago";	
                        }else{
                        $ago=number_format($convertd1)." hrs ago";
                        }
                    }
                }else{
                    if($convertd<1){
                        $ago=number_format($convertd)." day ago";
                    }else{
                        $ago=number_format($convertd)." days ago";
                    }
                }
                
                $link="#";
                if($rows['notif_subject']=="Pending Request" || $rows['notif_subject']=="Pending Confirmation"){
                    $link="asset_management";
                }
                if($rows['notif_subject']=="Denied Request"){
                    if($Position=="Data Entry Officer"){
                        $link="asset_management";
                    }
                    if($Position=="Asset Management Officer"){
                        $link="asset_management_dispose";
                    }
                }
                $ticket=str_replace("Ticket No. ","",$rows->notif_text);
                $Position=Auth::user()->position;
                $lll=0;
                if($Position=="Asset Management Officer"){
                    $lll=count(HR_hr_asset_transaction_log::where([
                        ['asset_transaction_log_id','=',$ticket],
                        ['transaction_action','=','Queued on AM']
                    ])->get());

                }
                else if($Position=="Fixed Asset Officer"){
                   $lll=count(HR_hr_asset_transaction_log::where([
                        ['asset_transaction_log_id','=',$ticket],
                        ['transaction_action','=','Queued on FA']
                    ])->get()); 
                }
                else if($Position=="Data Entry Officer"){
                   //pending task incomplete database table yet .waitng for asset table and asset_setup table

                }
                $style="";
                if($lll>0){
                    $style="style='background-color:#eaf3f9;border-bottom:2px solid #eaeaea;'";
                }else{
                    $style="style='border-bottom:2px solid #eaeaea;'";
                }
                $output .= '
                <a '.$style.' class="dropdown-item" href="'.$link.'">
                <strong>'.$rows->notif_subject.'</strong><br />
                <small>'.$rows->notif_text.'</small><br>
                <small>'.$ago.'</small>
                </a>
                ';
            }
            
        }else{
            $output .= '<a class="dropdown-item" href="#">No Notification Found</a>';
        }

        $data = array(
        'notification' => $output,
        'unseen_notification'  => $notif_count2
        );

        return json_encode($data);
    }
}
