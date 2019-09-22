<?php
	include("../config.php");
    include("zklib/zklib.php");
   
    //$zk = new ZKLib("192.168.254.157", 8000);
    $zk = new ZKLib("192.168.254.105", 8000);
    $ret = $zk->connect();
	
    sleep(1);
	
    if ( $ret ):
		//connected
        $zk->disableDevice();
        sleep(1);
		
    ?>
	<!--<table border="1" cellpadding="5" cellspacing="2">
            <tr>
                <th colspan="6">Data Attendance</th>
            </tr>
            <tr>
                <th>Index</th>
                <th>UID</th>
                <th>ID</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>
            </tr>-->
            <?php
            $attendance = $zk->getAttendance();
            sleep(1);
            while(list($idx, $attendancedata) = each($attendance)):
                if ( $attendancedata[2] == 14 )
                    $status = 'Check Out';
                else
                    $status = 'Check In';
            ?>
            <!--<tr>
                <td><?php //echo $idx ?></td>
                <td><?php //echo $attendancedata[0] ?></td>
                <td><?php //echo $attendancedata[1] ?></td>
                <td><?php //echo $status ?></td>
                <td><?php //echo date( "d-m-Y", strtotime( $attendancedata[3] ) ) ?></td>
                <td><?php //echo date( "H:i:s", strtotime( $attendancedata[3] ) ) ?></td>
            </tr>-->
            <?php
			if($attendancedata[2] == 14){
				$emp_id=$attendancedata[1];
				$ID=$attendancedata[0];
				$timein=date( "H:i:s", strtotime( $attendancedata[3] ));
				$timeindate=date( "d-m-Y", strtotime( $attendancedata[3] ) );
				$InsertAtt="INSERT INTO hr_employee_attendance( emp_id, attendance_date, attendance_time_in,  attendance_type, attendance_status)
							VALUES('$emp_id','$timeindate','$timein','Time In','1')";
				mysqli_query($conn,$InsertAtt);
			}else{
				$timeout=date( "H:i:s", strtotime( $attendancedata[3] ));
				$timeoutdate=date( "d-m-Y", strtotime( $attendancedata[3] ) );
				$emp_id=$attendancedata[1];
				$updateAtt="UPDATE hr_employee_attendance SET attendance_time_in='$timeout' WHERE emp_id='$emp_id' AND attendance_date='$timeoutdate' AND attendance_time_out IS NULL";
				mysqli_query($conn,$updateAtt);
			}
			
            endwhile
            ?>
        <!--</table>-->
		<?php
		sleep(1);
        $zk->disconnect();
	else :
	//not connected
		
		echo "Not Connected";
    endif
?>