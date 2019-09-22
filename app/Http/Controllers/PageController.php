<?php

namespace App\Http\Controllers;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DateTime;
use DatePeriod;
use DateInterval;
class PageController extends Controller
{
    public function access_denied(Request $request){
        return view('403');
        
    }
    public function test_page(Request $request){
        return view('pages.test');
    }
    public function bulletin(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function ceo(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function hr(Request $request){
        $None="";
        return view('pages.main.hr_dashboard', compact('None'));
    
    }
    public function employee_list(Request $request){
        
        $None="";
        return view('pages.main.employee_list', compact('None'));
    
    }
    public function add_employee(Request $request){
        $None="";
        return view('pages.main.add_employee', compact('None'));
    
    }
    public function view_employee(Request $request){
        $None="";
        $id=$request->id;
        $emp_info= HR_hr_employee_info::find($id);
        $emp_emergency_contact= HR_hr_employee_emergency_contact::where([
            ['emp_id','=',$id]
        ])->get();
        $emp_alt_contact= HR_hr_employee_alt_contact::where([
            ['emp_id','=',$id]
        ])->get();
        $emp_email_address= HR_hr_employee_email::where([
            ['emp_id','=',$id]
        ])->get();
        
        $emp_educ= HR_hr_employee_education::where([
            ['emp_id','=',$id]
        ])->get();
        $emp_trainer= HR_hr_employee_trainer::where([
            ['emp_id','=',$id]
        ])->get();
        $emp_seminar= HR_hr_employee_seminar::where([
            ['emp_id','=',$id]
        ])->get();
        $emp_salary_detail= HR_hr_employee_salary_detail::where([
            ['emp_id','=',$id]
        ])->first();
        $emp_job_detail= HR_hr_employee_job_detail::where([
            ['emp_id','=',$id]
        ])->first();
        $emp_files="";
        if($id!=""){
            $path = '/public/employee_file/'.$id;
            $emp_files = Storage::allFiles($path);
        }
        
        
        $emp_leave= HR_hr_employee_leavemanagement::where([
            ['emp_id','=',$id]
        ])->first();
        $emp_sched= HR_hr_employee_schedule_detail::where([
            ['emp_id','=',$id]
        ])->get();
        
        return view('pages.main.view_employee', compact('emp_sched','emp_leave','emp_job_detail','emp_files','emp_salary_detail','None','id','emp_info','emp_emergency_contact','emp_alt_contact','emp_email_address','emp_educ','emp_trainer','emp_seminar'));
    
    }
    public function memo(Request $request){
        $None="";
        return view('pages.main.employee_memo', compact('None'));
    
    }
    public function form_generator(Request $request){
        $None="";
        return view('pages.main.form_generator', compact('None'));
    
    }
    public function cash_advance(Request $request){
        $None="";
        return view('pages.main.cash_advance', compact('None'));
    
    }
    public function payroll(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function create_payroll(Request $request){
        $None="";
        return view('pages.main.create_payroll', compact('None'));
    
    }
    public function employee(Request $request){
        $page=$request->page;
        $None="";
        $attendance_computed_list = []; 
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
        foreach ($employee_list as $rows2){
            $EMPII=$rows2->employee_id;
            $biomentrics=$rows2->biometrics_id;
            $OTcount=0;
            $mins=0;
            $contomin=0;
            $NotAbsent=0;
            $AbsentCount=0;
            $TransactionFROM=$rows2->start_date;
            if($TransactionFROM=="" || $TransactionFROM=="0000-00-00"){
                $TransactionFROM=date('Y-m-d');
            }
            $TransactionTO=date('Y-m-d');
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
            $ot_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics'  AND (attendance_type='Normal OT' OR attendance_type='Early OT') ");
            foreach($ot_list as $data){
                $time1 = $data->attendance_time_in;
				$time2 = $data->attendance_time_out;
				$diff = abs(strtotime($time1) - strtotime($time2));
				$tmins = $diff/60;
				$hours = floor($tmins/60);
				$mins = $tmins%60;
				$OTcount=$OTcount+$hours;
				$contomin=$OTcount*60;
				$contomin+=$mins;
            }
            $time_in_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_attendance WHERE emp_id='$biomentrics' AND  attendance_type='Time In' ");
            foreach($time_in_list as $data){
                $NotAbsent++;
            }
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
						$rest_day_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_schedule_detail WHERE emp_id='$EMPII' AND day_id='$day' ");
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
								$rateperminute=$rateperminute*1.30;
								$restdaytiminrate=$restdaytiminrate+($rateperminute*$numberofminute);
								//echo $rateperminute." ".$numberofminute." ".$restdaytiminrate."<br>";
								$numberofminutesofundertimerestday=$numberofminutesofundertimerestday+$numberofminute;
                            }
                        }
                    }
                }


            }

            //store data in array
            $attendance_computed_list[]=array(
                $biomentrics,
                $rows2->company_id,
                ucwords(strtolower($rows2->fname." ".$rows2->lname)),
                $NotAbsent>1? number_format($NotAbsent)." Days" : number_format($NotAbsent)." Day",
                $AbsentCount>1? number_format($AbsentCount)." Days" : $AbsentCount." Day",
                $contomin>1? number_format($contomin)." minutes" : $contomin." minute",
                $numberofminutesofundertime>1? number_format($numberofminutesofundertime)." minutes" : $numberofminutesofundertime." minute");
        }
        
        //return $attendance_computed_list;
        return view('pages.main.payroll_employee', compact('None','page','attendance_computed_list'));
    
    }
    public function payroll_report(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function govt_report(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function asset_management(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function asset_management_dispose(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    
    public function asset(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function transaction(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function audit(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function audit_detail(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    
    public function report(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function print_qr(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function department(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function project_management(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }
    public function employee_dashboard(Request $request){
        $None="";
        return view('pages.test', compact('None'));
    
    }

    public function setup_company(Request $request){
        $page=$request->page;
        $None="";
        return view('pages.setup_pages.setup_company', compact('None','page'));
    
    }
    public function setup_payroll(Request $request){
        $page=$request->page;
        $None="";
        return view('pages.setup_pages.setup_payroll', compact('None','page'));
    
    }
    public function setup_references(Request $request){
        $page=$request->page;
        $None="";
        return view('pages.setup_pages.setup_references', compact('None','page'));
    
    }
}
