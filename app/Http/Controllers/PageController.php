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
        return view('pages.main.payroll_dashboard', compact('None'));
    
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
        //load spreadsheet
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("extra/import_file/payroll_report_template.xlsx");

        //change it
        $sheet = $spreadsheet->getActiveSheet();
        
        $index=2;
        $None="";
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
        $payrollgroupold="";
        $a=HR_Company_payroll_computation::first();
        $numofdayspermonth=$a->work_day_per_month;
        $employee_list = DB::connection('mysql')->select("SELECT * FROM hr_employee_info 
        JOIN 
        hr_employee_salary ON hr_employee_info.employee_id=hr_employee_salary.emp_id 
        JOIN hr_payroll ON hr_payroll.payroll_id=hr_employee_salary.payroll_id 
        JOIN hr_employee_salary_detail ON hr_employee_salary_detail.emp_id=hr_employee_info.employee_id 
        WHERE hr_employee_salary.salary_status='1'");
        foreach($employee_list as $rows2){
            $payrollgroup=$rows2->payroll_id;
			
			if($payrollgroupold!=$payrollgroup){
				$tablecontent.='<tr><th colspan="14">'.$rows2->description."(".$rows2->payroll_type.") - '".$rows2->employee_type."'".'</th></tr>';
				$sheet->setCellValue('A'.$index,$rows2->description."(".$rows2->payroll_type.") - '".$rows2->employee_type."'");
                $index++;
				$payrollgroupold=$payrollgroup;
			}
            
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
                $tablecontent.='</td>';
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
                $tablecontent.='</td>';
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
        
        
        
        //write it again to Filesystem with the same name (=replace)
        $writer = new Xlsx($spreadsheet);
        $writer->save('extra/import_file/payroll_report.xlsx');
        

        return view('pages.main.payroll_report', compact('None','tablecontent'));
    
    }
    public function govt_report(Request $request){
        $None="";
        return view('pages.main.govt_report', compact('None'));
    
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
