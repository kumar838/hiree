<?php 
include('config.php'); 
$prevdate=date("Y-m-d", strtotime("-1 months"));
include('chk_session.php'); 

function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = strpos($haystack, $what))!==false) return $pos;
    }
    return false;
}

$unsubscribe = array('wisdom','bayt','naukrigulf','naukri','monster','gulftalent');

if(isset($_POST['button']) && $_POST['button']=="Upload")

{

	extract($_POST);

	$jobtype = $_POST['jobtype'];

	if($jobtype=='GT')

	{

	$filename = $_FILES['csvfile']['tmp_name'];

	if (($handle = fopen($filename, "r")) !== FALSE) {

	fgetcsv($handle);   

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

	{

	$company = $jobtitle = $postedon = $totexp = $location = $jobrole = $jobrefcode = $jobdesc = $about_company = '';

	if($data[1]!='')$company = addslashes($data[1]);

	if($data[2]!='')$jobtitle = addslashes($data[2]);
	$jobtitle = str_replace(' nager',' Manager',$jobtitle);
	$jobtitle = str_replace(' MarMarketing',' Marketing',$jobtitle);

	if($data[3]!='')$postedon = date('Y-m-d',strtotime($data[3]));

	if($data[4]!='')$totexp = addslashes($data[4]);

	if($data[5]!='')$location = addslashes($data[5]);

	if($data[6]!='')$jobrefcode = addslashes($data[6]);

	if($data[7]!='')$jobrole = addslashes($data[7]);

	if($data[8]!='')$jobdesc = addslashes($data[8]);

	if($data[9]!='')$about_company = addslashes($data[9]);

	

	$postedon = date('Y-m-d',strtotime($data[3]));	$totexp = str_replace('Years','',$totexp);

	$splitexp = explode('-',$totexp);	$minexp = $splitexp[0];	$maxexp = $splitexp[1];



	$_POST['csvdata']['job_type'] = 'GT';

	$_POST['csvdata']['job_referid'] = $jobrefcode;

	$_POST['csvdata']['jobtitle'] = $jobtitle;

	$_POST['csvdata']['job_company'] = $company;

	$_POST['csvdata']['jobposted'] = $postedon;

	$_POST['csvdata']['job_minexp'] = $minexp;

	$_POST['csvdata']['job_maxexp'] = $maxexp;

	$_POST['csvdata']['job_desc'] = $jobdesc;

	$_POST['csvdata']['job_farea'] = '';

	$_POST['csvdata']['job_loc'] = $location;

	$_POST['csvdata']['about_company'] = $about_company;

	$_POST['csvdata']['job_exp'] = $data[4];

	$_POST['csvdata']['job_keyword'] = '';
	
	$compos = strpos_arr($company, $unsubscribe);
	
	$chkjobs = $dbObj->SelectQuery("SELECT jobid FROM js_joblist WHERE jobtitle='".trim($jobtitle)."' AND job_minexp='".trim($minexp)."' AND job_maxexp='".trim($maxexp)."' AND job_company='".trim($company)."' AND job_loc='".trim($location)."' AND DATE(jobposted)>=DATE_SUB(CURRENT_DATE,INTERVAL 30 DAY) LIMIT 0,1");
	if(empty($chkjobs) && strlen($jobdesc)>50 && $compos<=0)
	{
	$ins = $dbObj->InsertValues('js_joblist',$_POST['csvdata']);
	}
	}

	fclose($handle);

	}

	}

	elseif($jobtype=='NG')

	{

	$filename = $_FILES['csvfile']['tmp_name'];

	if (($handle = fopen($filename, "r")) !== FALSE) {

	fgetcsv($handle);   

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

	{

	$company = $jobtitle = $postedon = $totexp = $location = $jobrole = $jobrefcode = $jobdesc = $salary = $openings = $industry = $nationality = $education = $farea = $recruiter = $keywords = '';

	if($data[1]!='')$company = addslashes($data[1]);

	if($data[2]!='')$jobtitle = addslashes($data[2]);
	$jobtitle = str_replace(' nager',' Manager',$jobtitle);
	$jobtitle = str_replace(' MarMarketing',' Marketing',$jobtitle);


	if($data[3]!='')$location = addslashes($data[3]);

	if($data[4]!='')$postedon = date('Y-m-d',strtotime($data[4]));

	if($data[5]!='')$totexp = addslashes($data[5]);

	if($data[6]!='')$salary = addslashes($data[6]);

	if($data[7]!='')$openings = addslashes($data[7]);
	
	if($data[9]!='')$nationality = addslashes($data[9]);

	if($data[10]!='')$education = addslashes($data[10]);

	if($data[11]!='')$industry = addslashes($data[11]);

	if($data[12]!='')$farea = addslashes($data[12]);

	if($data[20]!='')$keywords = addslashes($data[20]);

	if($data[21]!='')$jobdesc = addslashes($data[21]);
	
	if($data[23]!='')$about_company = addslashes($data[23]);
	if($data[22]!='')$candidate_profile = addslashes($data[22]);
	if($data[13]!='')$recruiter = addslashes($data[13]);
	if($data[17]!='')$recruiter_contactno = addslashes($data[17]);
	if($data[14]!='')$venue_address = addslashes($data[14]);
	if($data[18]!='')$emailid = addslashes($data[18]);
	
	if($data[24]!='')$jobrefcode = addslashes($data[24]);
	
	//if($data[20]!='')$recruiter = addslashes($data[13]);





	

	$postedon = date('Y-m-d',strtotime($data[4]));	$totexp = str_replace('years','',$totexp); $totexp = str_replace('Years','',$totexp);

	$splitexp = explode('-',$totexp);	$minexp = $splitexp[0];	$maxexp = $splitexp[1];



	$_POST['csvdata']['job_type'] = 'NG';

	$_POST['csvdata']['job_referid'] = $jobrefcode;

	$_POST['csvdata']['jobtitle'] = $jobtitle;

	$_POST['csvdata']['job_company'] = $company;

	$_POST['csvdata']['jobposted'] = $postedon;

	$_POST['csvdata']['job_minexp'] = $minexp;

	$_POST['csvdata']['job_maxexp'] = $maxexp;

	$_POST['csvdata']['job_desc'] = $jobdesc;

	$_POST['csvdata']['job_industry'] = $industry;

	$_POST['csvdata']['job_farea'] = $farea;

	$_POST['csvdata']['job_loc'] = $location;

	$_POST['csvdata']['about_company'] = $about_company;

	$_POST['csvdata']['job_exp'] = $data[5];

	$_POST['csvdata']['job_keyword'] = $keywords;

	$_POST['csvdata']['job_salary'] = $salary;

	$_POST['csvdata']['job_openings'] = $openings;

	$_POST['csvdata']['job_nationality'] = $nationality;

	$_POST['csvdata']['job_education'] = $education;

	$_POST['csvdata']['job_recruiter'] = $recruiter;
	$_POST['csvdata']['candidate_profile'] = $candidate_profile;
	$_POST['csvdata']['recruiter_contactno'] = $recruiter_contactno;
	$_POST['csvdata']['venue_address'] = $venue_address;
	$_POST['csvdata']['emailid'] = $emailid;
	$compos = strpos_arr($company, $unsubscribe);

	$chkjobs = $dbObj->SelectQuery("SELECT jobid FROM js_joblist WHERE jobtitle='".trim($jobtitle)."' AND job_minexp='".trim($minexp)."' AND job_maxexp='".trim($maxexp)."' AND job_company='".trim($company)."' AND job_loc='".trim($location)."' AND DATE(jobposted)>=DATE_SUB(CURRENT_DATE,INTERVAL 30 DAY) LIMIT 0,1");
	if(empty($chkjobs) && strlen($jobdesc)>50 && $compos<=0)
	{
	$ins = $dbObj->InsertValues('js_joblist',$_POST['csvdata']);
	}

	}

	fclose($handle);

	}

	}

	elseif($jobtype=='MG')

	{

	$filename = $_FILES['csvfile']['tmp_name'];

	if (($handle = fopen($filename, "r")) !== FALSE) {

	fgetcsv($handle);   

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

	{

	$company = $jobtitle = $postedon = $totexp = $location = $jobrole = $jobrefcode = $jobdesc = $salary = $openings = $industry = $nationality = $education = $farea = $recruiter = $keywords = '';

	if($data[1]!='')$company = addslashes($data[1]);

	if($data[2]!='')$jobtitle = addslashes(trim($data[2]));
	$jobtitle = str_replace(' nager',' Manager',$jobtitle);
	$jobtitle = str_replace(' MarMarketing',' Marketing',$jobtitle);

	if($data[3]!='')$postedon = date('Y-m-d',strtotime($data[3]));
	if($data[4]!='')$location = addslashes($data[4]);
	if($data[5]!='')$industry = addslashes($data[5]);
	if($data[6]!='')$farea = addslashes($data[6]);
	if($data[7]!='')$salary = addslashes($data[7]);
	if($data[8]!='')$jobrole = addslashes($data[8]);
	if($data[9]!='')$keywords = addslashes($data[9]);
	if($data[10]!='')$totexp = addslashes($data[10]);
	if($data[11]!='')$recruiter = addslashes($data[11]);

	if($data[17]!='')$education = addslashes($data[17]);
	if($data[18]!='')$jobdesc = addslashes($data[18]);
	if($data[19]!='')$nationality = addslashes($data[19]);
	if($data[20]!='')$about_company = addslashes($data[20]);
	if($data[21]!='')$jobrefcode = addslashes($data[21]);

	$totexp = str_replace('years','',$totexp); $totexp = str_replace('Years','',$totexp);
	$splitexp = explode('-',$totexp);	$minexp = $splitexp[0];	$maxexp = $splitexp[1];

	$_POST['csvdata']['job_type'] = 'MG';
	$_POST['csvdata']['job_referid'] = $jobrefcode;
	$_POST['csvdata']['jobtitle'] = $jobtitle;
	$_POST['csvdata']['job_company'] = $company;
	$_POST['csvdata']['jobposted'] = $postedon;
	$_POST['csvdata']['job_minexp'] = $minexp;
	$_POST['csvdata']['job_maxexp'] = $maxexp;
	$_POST['csvdata']['job_desc'] = $jobdesc;
	$_POST['csvdata']['job_industry'] = $industry;
	$_POST['csvdata']['job_farea'] = $farea;
	$_POST['csvdata']['job_role'] = $jobrole;
	$_POST['csvdata']['job_loc'] = $location;
	$_POST['csvdata']['about_company'] = $about_company;
	$_POST['csvdata']['job_exp'] = $data[10];
	$_POST['csvdata']['job_keyword'] = $keywords;
	$_POST['csvdata']['job_salary'] = $salary;
	$_POST['csvdata']['job_openings'] = $openings;
	$_POST['csvdata']['job_nationality'] = $nationality;
	$_POST['csvdata']['job_education'] = $education;
	$_POST['csvdata']['job_recruiter'] = $recruiter;
	$compos = strpos_arr($company, $unsubscribe);

	$chkjobs = $dbObj->SelectQuery("SELECT jobid FROM js_joblist WHERE jobtitle='".trim($jobtitle)."' AND job_minexp='".trim($minexp)."' AND job_maxexp='".trim($maxexp)."' AND job_company='".trim($company)."' AND job_loc='".trim($location)."' AND DATE(jobposted)>=DATE_SUB(CURRENT_DATE,INTERVAL 30 DAY) LIMIT 0,1");
	if(empty($chkjobs) && strlen($jobdesc)>50 && $compos<=0)
	{
	$ins = $dbObj->InsertValues('js_joblist',$_POST['csvdata']);
	}

	}

	fclose($handle);

	}

	}

	elseif($jobtype=='BG')

	{

	$filename = $_FILES['csvfile']['tmp_name'];

	if (($handle = fopen($filename, "r")) !== FALSE) {

	fgetcsv($handle);   

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)

	{

	$company = $jobtitle = $postedon = $totexp = $location = $jobrole = $jobrefcode = $jobdesc = $salary = $openings = $industry = $nationality = $education = $farea = $recruiter = $keywords = '';



	if($data[1]!='')$company = addslashes($data[1]);

	if($data[2]!='')$jobtitle = addslashes($data[2]);
	$jobtitle = str_replace(' nager',' Manager',$jobtitle);
	$jobtitle = str_replace(' MarMarketing',' Marketing',$jobtitle);

	if($data[3]!='')$postedon = date('Y-m-d',strtotime($data[3]));

	if($data[4]!='')$totexp = addslashes($data[4]);

	if($data[5]!='')$location = addslashes($data[5]);

	if($data[6]!='')$salary = addslashes($data[6]);

	if($data[7]!='')$openings = addslashes($data[7]);

	if($data[8]!='')$jobrole = addslashes($data[8]);

	if($data[11]!='')$industry = addslashes($data[11]);

	if($data[12]!='')$nationality = addslashes($data[12]);

	if($data[13]!='')$education = addslashes($data[13]);

	if($data[14]!='')$keywords = addslashes($data[14]);

	if($data[15]!='')$jobdesc = addslashes($data[15]);

	if($data[17]!='')$jobrefcode = addslashes($data[17]);

	

	$postedon = date('Y-m-d',strtotime($data[3]));	$totexp = str_replace('Min','',$totexp); $totexp = str_replace('Max','-',$totexp); $totexp = str_replace(':','',$totexp);

	$splitexp = explode('-',$totexp);	$minexp = $splitexp[0];	$maxexp = $splitexp[1];



	$_POST['csvdata']['job_type'] = 'BG';

	$_POST['csvdata']['job_referid'] = $jobrefcode;

	$_POST['csvdata']['jobtitle'] = $jobtitle;

	$_POST['csvdata']['job_company'] = $company;

	$_POST['csvdata']['jobposted'] = $postedon;

	$_POST['csvdata']['job_minexp'] = $minexp;

	$_POST['csvdata']['job_maxexp'] = $maxexp;

	$_POST['csvdata']['job_desc'] = $jobdesc;

	$_POST['csvdata']['job_industry'] = $industry;

	$_POST['csvdata']['job_farea'] = $farea;

	$_POST['csvdata']['job_role'] = $jobrole;

	$_POST['csvdata']['job_loc'] = $location;

	$_POST['csvdata']['about_company'] = $about_company;

	$_POST['csvdata']['job_exp'] = $data[4];

	$_POST['csvdata']['job_keyword'] = $keywords;

	$_POST['csvdata']['job_salary'] = $salary;

	$_POST['csvdata']['job_openings'] = $openings;

	$_POST['csvdata']['job_nationality'] = $nationality;

	$_POST['csvdata']['job_education'] = $education;

	$_POST['csvdata']['job_recruiter'] = $recruiter;
	$compos = strpos_arr($company, $unsubscribe);

	$chkjobs = $dbObj->SelectQuery("SELECT jobid FROM js_joblist WHERE jobtitle='".trim($jobtitle)."' AND job_minexp='".trim($minexp)."' AND job_maxexp='".trim($maxexp)."' AND job_company='".trim($company)."' AND job_loc='".trim($location)."' AND DATE(jobposted)>=DATE_SUB(CURRENT_DATE,INTERVAL 30 DAY) LIMIT 0,1");
	if(empty($chkjobs) && strlen($jobdesc)>50 && $compos<=0)
	{
	$ins = $dbObj->InsertValues('js_joblist',$_POST['csvdata']);
	}

	}

	fclose($handle);

	}

	}

	header("Location:jobslist.php");

	exit;

}

?>

<!DOCTYPE html>



<html lang="en">



<head>



<meta charset="utf-8">



<title><?php echo SITE_TITLE;?></title>



<meta name="viewport" content="width=device-width, initial-scale=1.0">



<meta name="description" content="Recruiter Control Panel.">



<meta name="author" content="Ramesh">



<!-- The styles -->



<?php include('includes/top_header.php') ;?>



<link href="profile/profile.css" rel="stylesheet" type="text/css">



<style type="text/css">



.tablereg td {



	padding:2px;



}



</style>





    <link rel="stylesheet" href="css/style.css" type="text/css" />



    <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all" />



    <script language="javascript" type="text/javascript" src="js/ajax_cal.js"></script>



    <script src="js/jquery.min.js" type="text/javascript"></script>



    <script src="js/jquery-ui.min.js" type="text/javascript"></script>



	<script src="js/jquery-1.js" type="text/javascript"></script>



</head>



<body>



<!-- topbar starts -->



<?php include('includes/header.php') ;?>



<!-- topbar ends -->



<div class="container-fluid">



  <div class="row-fluid">



    <!-- left menu starts -->



    <?php include('includes/sidemenu.php') ;?>



    <!--/span-->



    <!-- left menu ends -->



    <noscript>



    </noscript>



    <div id="content" class="span10">



      <!-- content starts -->



            <?php include('includes/breadcrum.php');?>







      <div class="row-fluid sortable">



        <div class="box span12">



          <div class="box-header well" data-original-title>



            <h2><i class="icon-user"></i> Upload CSV</h2>



          </div>



          <?php if($error!='')echo '<h4 class="alert_error">'.$error.'</h4>';?>



          <?php if($_REQUEST['update']=="success")echo '<h4 class="alert_success">Password Changed Successfully</h4>';?>



          <div class="box-content">

            <form name="changeform" id="changeform" method="post" enctype="multipart/form-data">

              <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" class="tablereg">

                <tr>

                  <td width="14%">&nbsp;</td>

                  <td width="23%" align="right">Job Type</td>

                  <td width="3%" align="center">&nbsp;</td>

                  <td width="60%"><select name="jobtype" id="jobtype"><option value="">Select Job Type</option>

                  <option value="GT">Gulf Talent</option><option value="NG">Naukri Gulf</option><option value="BG">Byte Gulf</option><option value="MG">Monster Gulf</option></select></td>

                </tr>

                <tr>

                  <td width="14%">&nbsp;</td>

                  <td width="23%" align="right">CSV File</td>

                  <td width="3%" align="center">&nbsp;</td>

                  <td width="60%"><input type="file" name="csvfile" id="csvfile"></td>

                </tr>



                <tr>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                  <td><input type="submit" name="button" id="button" value="Upload" class="btn btn-primary"></td>

                </tr>



                <tr>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

              </table>



            </form>



          </div>



        </div>



        <!--/span-->



      </div>



      <!--/row-->



      <!--/row-->



      <div class="row-fluid sortable">



        <!--/span-->



        <!--/span-->



      </div>



      <!--/row-->



      <div class="row-fluid sortable">



        <!--/span-->



      </div>



      <!--/row-->



      <!-- content ends -->



    </div>



    <!--/#content.span10-->



  </div>



  <!--/fluid-row-->



  <hr>



  <?php include('includes/footer.php') ;?>



</div>



<!-- jQuery -->



</body>



</html>