<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DateTime;
use App\HR_hr_a_digit;
use App\HR_hr_notification;
use App\HR_hr_asset_transaction_log;
use App\HR_hr_employee_info;
use App\User;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function generate_id(){
        $getIDgen =HR_hr_a_digit::find(1);
        if(empty($getIDgen)){
            $data=new HR_hr_a_digit;
            $data->gen_alpha="A";
            $data->gen_count="1";
            $data->save();
        }
        $getIDgen =HR_hr_a_digit::find(1);
        $n = $getIDgen->gen_count; //"id" number piece.
        $l = $getIDgen->gen_alpha; //"id" letter piece.
        $id = $l."-".sprintf("%02d", $n); //Create "id". Sprintf pads the number to make it 4 digits.

            if ($n == 9999999) { //Once the number reaches 9999, increase the letter by one and reset number to 0.
                $n = 0;
                $l++;
            }
            $n++; //Letters can be incremented the same as numbers. Adding 1 to "AAA" prints out "AAB".
            $data =HR_hr_a_digit::find(1);
            $data->gen_alpha=$l;
            $data->gen_count=$n;
            $data->save();
            return "AM-".$id; //return the id.
    }
    protected function generate_transaction_log($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=Auth::user()->id;
        $Requestor=Auth::user()->name;
        $data=new HR_hr_asset_transaction_log;
        $data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        $data->transaction_ticket_no=$transaction_ticket_no;
        $data->deny_reason=$deny_reason;
        $data->save();
        $users=User::where([
            ['approved_status','=','1']
        ])->get();
        $position_required="";
        if($status=="Queued on AM"){
            $position_required="Asset Management Officer";
        }
        else if($status=="Queued on FA"){
            $position_required="Fixed Asset Officer";
        }
        $notif_text="Ticket No. ".$log_id;
        foreach($users as $user){
            if($position_required==$user->position){
                $notif= new HR_hr_notification;
                $notif->notif_subject="Pending Request";
                $notif->notif_text=$notif_text;
                $notif->notif_target=$user->id;
                $notif->notif_status="1";
                $notif->save();
                
            }
        }
    }
    protected function generate_transaction_log_checkout($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=$transaction_ticket_no;
        $user= HR_hr_employee_info::find($ID);
        $name="";
        if(!empty($user)){
            $name=$user->fname." ".$user->lname;
        }
        $Requestor=$name;
        $data=new HR_hr_asset_transaction_log;
        $data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        
        $data->deny_reason=$deny_reason;
        $data->save();
        $users=User::where([
            ['approved_status','=','1']
        ])->get();
        $position_required="";
        if($status=="Queued on AM"){
            $position_required="Asset Management Officer";
        }
        else if($status=="Queued on FA"){
            $position_required="Fixed Asset Officer";
        }
        $notif_text="Ticket No. ".$log_id;
        foreach($users as $user){
            if($position_required==$user->position){
                $notif= new HR_hr_notification;
                $notif->notif_subject="Pending Request";
                $notif->notif_text=$notif_text;
                $notif->notif_target=$user->id;
                $notif->notif_status="1";
                $notif->save();
                
            }
        }
    }
    protected function generate_transaction_log_confirmation($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=Auth::user()->id;
        $Requestor=Auth::user()->name;
        $data=HR_hr_asset_transaction_log::where([
            ['asset_transaction_log_id','=',$log_id]
        ])->first();

        //$data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        $data->transaction_ticket_no=$transaction_ticket_no;
        $data->deny_reason=$deny_reason;
        $data->save();
        $users=User::where([
            ['approved_status','=','1']
        ])->get();
        $position_required="";
        if($status=="Queued on AM"){
            $position_required="Asset Management Officer";
        }
        else if($status=="Queued on FA"){
            $position_required="Fixed Asset Officer";
        }
        $notif_text="Ticket No. ".$log_id;
        foreach($users as $user){
            if($position_required==$user->position){
                $notif= new HR_hr_notification;
                $notif->notif_subject="Pending Confirmation";
                $notif->notif_text=$notif_text;
                $notif->notif_target=$user->id;
                $notif->notif_status="1";
                $notif->save();
                
            }
        }
    }
    protected function generate_transaction_log_approve($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=Auth::user()->id;
        $Requestor=Auth::user()->name;
        $data=HR_hr_asset_transaction_log::where([
            ['asset_transaction_log_id','=',$log_id]
        ])->first();

        //$data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        $data->transaction_ticket_no=$transaction_ticket_no;
        $data->deny_reason=$deny_reason;
        $data->save();
        $users=User::where([
            ['approved_status','=','1'],
            ['id','=',$ID]
        ])->get();
        $position_required="";
        
        $notif_text="Ticket No. ".$log_id;
        foreach($users as $user){
            
                $notif= new HR_hr_notification;
                $notif->notif_subject="Approved Request";
                $notif->notif_text=$notif_text;
                $notif->notif_target=$user->id;
                $notif->notif_status="1";
                $notif->save();
            
        }
    }
    protected function generate_transaction_log_deny_fa($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=Auth::user()->id;
        $Requestor=Auth::user()->name;
        $data=HR_hr_asset_transaction_log::where([
            ['asset_transaction_log_id','=',$log_id]
        ])->first();

        //$data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        $data->transaction_ticket_no=$transaction_ticket_no;
        $data->deny_reason=$deny_reason;
        $data->save();
        $users=User::where([
            ['approved_status','=','1']
        ])->get();
        $position_required="Asset Management Officer";
        
        $notif_text="Ticket No. ".$log_id;
        foreach($users as $user){
            if($position_required==$user->position){
                $notif= new HR_hr_notification;
                $notif->notif_subject="Pending Request";
                $notif->notif_text=$notif_text;
                $notif->notif_target=$user->id;
                $notif->notif_status="1";
                $notif->save();
                
            }
        }
    }
    protected function generate_transaction_log_deny_am($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=Auth::user()->id;
        $Requestor=Auth::user()->name;
        $data=HR_hr_asset_transaction_log::where([
            ['asset_transaction_log_id','=',$log_id]
        ])->first();

        //$data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        $data->transaction_ticket_no=$transaction_ticket_no;
        $data->deny_reason=$deny_reason;
        $data->save();
        $users=User::where([
            ['approved_status','=','1'],
            ['id','=',$ID]
        ])->get();
        $position_required="Asset Management Officer";
        
        $notif_text="Ticket No. ".$log_id;
        foreach($users as $user){
                $notif= new HR_hr_notification;
                $notif->notif_subject="Denied Request";
                $notif->notif_text=$notif_text;
                $notif->notif_target=$user->id;
                $notif->notif_status="1";
                $notif->save();
        }
    }
    protected function generate_transaction_log_delete($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=Auth::user()->id;
        $Requestor=Auth::user()->name;
        $data=HR_hr_asset_transaction_log::where([
            ['asset_transaction_log_id','=',$log_id]
        ])->first();

        //$data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        $data->transaction_ticket_no=$transaction_ticket_no;
        $data->deny_reason=$deny_reason;
        $data->save();
        
    }
    protected function generate_transaction_log_denied_am($request_no,$request_tag,$action,$status,$transaction_ticket_no,$deny_reason){
        date_default_timezone_set("Asia/Manila");
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		$DAY=$date->format('Y-m-d');
        $TIME=$date->format('H:i:s');
        $log_id=$request_no; 
		$Action=$action; 
		$tag=$request_tag; 
        $ID=Auth::user()->id;
        $Requestor=Auth::user()->name;
        $data=HR_hr_asset_transaction_log::where([
            ['asset_transaction_log_id','=',$log_id]
        ])->first();

        //$data->asset_transaction_log_id=$log_id;
        $data->asset_tag=$tag;
        $data->log_date=$DAY;
        $data->log_time=$TIME;
        $data->audit_action_date=$DAY;
        $data->log_action=$Action;
        $data->log_action_requestor_id=$ID;
        $data->log_action_requestor=$Requestor;
        $data->transaction_action=$status;
        $data->transaction_ticket_no=$transaction_ticket_no;
        
        $data->save();
        $users=User::where([
            ['approved_status','=','1'],
            ['id','=',$ID]
        ])->get();
        $position_required="Asset Management Officer";
        
        $notif_text="Ticket No. ".$log_id;
        foreach($users as $user){
                $notif= new HR_hr_notification;
                $notif->notif_subject="Pending Request";
                $notif->notif_text=$notif_text;
                $notif->notif_target=$user->id;
                $notif->notif_status="1";
                $notif->save();
        }
    }
    
}
