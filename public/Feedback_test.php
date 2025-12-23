<!DOCTYPE html>
<?php
session_start();
include("db_connect.php");
  if (!isset($_SESSION['username'])) {
    header('location: index.php');
  }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <title>OCS Training Institute - Feedback Form</title>

  <style>
    :root{
      --primary:#007bff;
      --accent: #00b4d8;
      --card-bg: #ffffff;
      --muted: #6c757d;
      --shadow: 0 10px 30px rgba(13,38,77,0.08);
      --radius: 12px;
    }

    *{box-sizing:border-box}
    body{
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg,#f0f4ff,#e6eefc);
      padding: 24px 12px;
      color:#203547;
    }

    .form-container{
      max-width: 980px;
      margin: 12px auto;
      background: var(--card-bg);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: transform .18s ease;
    }
    .form-container:hover{ transform: translateY(-4px); }

    .banner{
      display:flex;
      align-items:center;
      gap:18px;
      padding:18px;
      background: linear-gradient(90deg,#0f4c81,#0b6ea8);
      color:#fff;
      position: relative; /* added so absolute-positioned logout button can sit on the banner */
    }
    .banner img{ max-height:64px; }
    .banner .title{ font-weight:700;font-size:1.25rem; }

    .card-body{
      padding: 22px;
    }

    h2.section-title{
      font-size:1.05rem;
      color: #073b66;
      margin-top:18px;
      margin-bottom:12px;
      font-weight:700;
      border-left: 4px solid var(--primary);
      padding-left:10px;
      display:inline-block;
    }

    .form-row { display:flex; gap:12px; flex-wrap:wrap; }
    .form-col{ flex:1 1 220px; min-width:180px; }
    label{ font-weight:600; margin-bottom:6px; display:block; color:#1e405a;}
    input[type="text"], input[type="email"], select, textarea{
      width:100%;
      padding:10px 12px;
      border-radius:8px;
      border:1px solid #d6dfea;
      background:#fbfdff;
      transition: box-shadow .15s, border-color .15s;
    }
    input:focus, textarea:focus, select:focus{ outline:none; border-color:var(--primary); box-shadow:0 6px 18px rgba(11,111,180,0.08); }

    .table-responsive{ overflow:auto; border-radius:8px; border:1px solid #e6eef8; margin-bottom:12px; }
    table.table{ margin-bottom:0; width:100%; border-collapse:collapse; }
    table.table th{ background:#0f5ea8; color:#fff; padding:10px; text-align:left; font-size:0.95rem; }
    table.table td{ padding:10px; border-top:1px solid #eef4fb; vertical-align:middle; }

    .rating-select{ width:110px; padding:8px; border-radius:6px; }

    .expectation-card{ background:#f6fbff; border:1px solid #e6f0ff; padding:14px; border-radius:8px; }
    .options{ display:flex; flex-wrap:wrap; gap:12px; }
    .option{ display:flex; align-items:center; gap:8px; font-size:0.95rem; }

    .btn-submit{
      display:inline-block;
      background: linear-gradient(135deg,var(--primary),var(--accent));
      color:#fff;
      border:none;
      padding:12px 20px;
      border-radius:10px;
      font-weight:700;
      cursor:pointer;
      transition: transform .15s ease, box-shadow .15s;
    }
    .btn-submit:hover{ transform: translateY(-2px); box-shadow:0 10px 30px rgba(0,123,255,0.12); }

    footer{ padding:14px; background:#f7f9fc; text-align:center; font-size:0.95rem; color:var(--muted); border-top:1px solid #eef4fb; }

    @media (max-width:900px){
      .banner{ flex-direction:column; align-items:flex-start; gap:8px; padding:14px; }
      .form-row{ flex-direction:column; }
      .rating-select{ width:100%; }
    }

    /* logout button positioned over banner */
    .logout-btn{
      position: absolute;
      top: 10px;
      right: 12px;
      background: rgba(255,255,255,0.12);
      color: #fff;
      padding: 8px 12px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 700;
      border: 1px solid rgba(255,255,255,0.18);
      transition: background .12s, color .12s, transform .08s;
    }
    .logout-btn:hover{
      background: #fff;
      color: #0b6ea8;
      transform: translateY(-2px);
    }
    @media (max-width:480px){
      .logout-btn{ padding:6px 8px; top:8px; right:8px; font-size:0.9rem; }
    }
  </style>
</head>
<body>

<?php

if (isset($_POST['form_submitted']))
{
    // sanitize simple inputs
    $CourseID = $_POST['courseid'] ?? '';
    $Course_Name = "RIG INSPECTION-Land Rig (IADC certified)";
    $Feed_Date = date("Y/m/d");
    $Feed_Name = trim($_POST['txtusr_name'] ?? '');
    $Feed_Desig = trim($_POST['txtusr_des'] ?? '');
    $Feed_Org = trim($_POST['txtusr_org'] ?? '');
    $Feed_Email = trim($_POST['txtusr_email'] ?? '');

    // ratings (wta_sc_1..6) and comments (wta_cm_1..6)
    $Feed_wta_sc_1 = $_POST['wta_sc_1'] ?? null;
    $Feed_wta_sc_2 = $_POST['wta_sc_2'] ?? null;
    $Feed_wta_sc_3 = $_POST['wta_sc_3'] ?? null;
    $Feed_wta_sc_4 = $_POST['wta_sc_4'] ?? null;
    $Feed_wta_sc_5 = $_POST['wta_sc_5'] ?? null;
    $Feed_wta_sc_6 = $_POST['wta_sc_6'] ?? null;

    $Feed_wta_cm_1 = $_POST['wta_cm_1'] ?? '';
    $Feed_wta_cm_2 = $_POST['wta_cm_2'] ?? '';
    $Feed_wta_cm_3 = $_POST['wta_cm_3'] ?? '';
    $Feed_wta_cm_4 = $_POST['wta_cm_4'] ?? '';
    $Feed_wta_cm_5 = $_POST['wta_cm_5'] ?? '';
    $Feed_wta_cm_6 = $_POST['wta_cm_6'] ?? '';

    $Feed_rdexpt = $_POST['rdexpt'] ?? '';
    $Feed_rd_owv1 = $_POST['rd_owv1'] ?? '';
    $Feed_rd_owv2 = $_POST['rd_owv2'] ?? '';
    $Feed_rd_owv3 = $_POST['rd_owv3'] ?? '';
    $Feed_rd_owv4 = $_POST['rd_owv4'] ?? '';
    $Feed_rd_owv5 = $_POST['rd_owv5'] ?? '';

    $Feed_fut_eve1 = $_POST['fut_eve1'] ?? '';
    $Feed_fut_eve2 = $_POST['fut_eve2'] ?? '';
    $Feed_fut_eve3 = $_POST['fut_eve3'] ?? '';
    $Feed_fut_eve4 = $_POST['fut_eve4'] ?? '';

    $Feed_gc1 = $_POST['gc1'] ?? '';
    $Feed_gc2 = $_POST['gc2'] ?? '';
    $Feed_rdgc = $_POST['rdgc'] ?? '';

    // referrals
    $Ref_Name1 = $_POST['rname1'] ?? '';
    $Ref_Position1 = $_POST['rpos1'] ?? '';
    $Ref_Orga1 = $_POST['rorg1'] ?? '';
    $Ref_Email1 = $_POST['remail1'] ?? '';
    $Ref_Tele1 = $_POST['rtel1'] ?? '';

    $Ref_Name2 = $_POST['rname2'] ?? '';
    $Ref_Position2 = $_POST['rpos2'] ?? '';
    $Ref_Orga2 = $_POST['rorg2'] ?? '';
    $Ref_Email2 = $_POST['remail2'] ?? '';
    $Ref_Tele2 = $_POST['rtel2'] ?? '';

    if ($Feed_Name == "" || $Feed_Email == "") {
        echo '<div class="container mt-3"><div class="alert alert-warning">Name and Email are required.</div></div>';
    } else {
        // prepare feed insert (32 columns)
        $query = "INSERT INTO dbo.feed_table (
            CourseID, Course_Name, Feed_Date, Feed_Name, Feed_Desig, Feed_Org, Feed_Email,
            Feed_wta_sc_1, Feed_wta_sc_2, Feed_wta_sc_3, Feed_wta_sc_4, Feed_wta_sc_5, Feed_wta_sc_6,
            Feed_wta_cm_1, Feed_wta_cm_2, Feed_wta_cm_3, Feed_wta_cm_4, Feed_wta_cm_5, Feed_wta_cm_6,
            Feed_rdexpt,
            Feed_rd_owv1, Feed_rd_owv2, Feed_rd_owv3, Feed_rd_owv4, Feed_rd_owv5,
            Feed_fut_eve1, Feed_fut_eve2, Feed_fut_eve3, Feed_fut_eve4,
            Feed_gc1, Feed_gc2, Feed_rdgc
        ) VALUES (".str_repeat('?,',31)."?)";

        $params1 = array(
            $CourseID, $Course_Name, $Feed_Date, $Feed_Name, $Feed_Desig, $Feed_Org, $Feed_Email,
            $Feed_wta_sc_1, $Feed_wta_sc_2, $Feed_wta_sc_3, $Feed_wta_sc_4, $Feed_wta_sc_5, $Feed_wta_sc_6,
            $Feed_wta_cm_1, $Feed_wta_cm_2, $Feed_wta_cm_3, $Feed_wta_cm_4, $Feed_wta_cm_5, $Feed_wta_cm_6,
            $Feed_rdexpt,
            $Feed_rd_owv1, $Feed_rd_owv2, $Feed_rd_owv3, $Feed_rd_owv4, $Feed_rd_owv5,
            $Feed_fut_eve1, $Feed_fut_eve2, $Feed_fut_eve3, $Feed_fut_eve4,
            $Feed_gc1, $Feed_gc2, $Feed_rdgc
        );

        $query2 = "INSERT INTO dbo.Refer_Table (
            Feed_Name, Feed_Date, Feed_Email, Ref_Name, Ref_Position, Ref_Orga, Ref_Email, Ref_Tele
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $result = sqlsrv_query($conn, $query, $params1);

        // insert referrals only if name/email provided
        if ($Ref_Name1 != "" || $Ref_Email1 != "" ) {
            $params2 = array($Feed_Name, $Feed_Date, $Feed_Email, $Ref_Name1, $Ref_Position1, $Ref_Orga1, $Ref_Email1, $Ref_Tele1 );
            $result2 = sqlsrv_query($conn, $query2, $params2);
        }
        if ($Ref_Name2 != "" || $Ref_Email2 != "" ) {
            $params3 = array($Feed_Name, $Feed_Date, $Feed_Email, $Ref_Name2, $Ref_Position2, $Ref_Orga2, $Ref_Email2, $Ref_Tele2 );
            $result3 = sqlsrv_query($conn, $query2, $params3);
        }

        sqlsrv_close($conn);

        // send notification email
        $mail = new PHPMailer();

        try {
            $mail->isSMTP();
            $mail->Host       = 'plesk2000.is.cc';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@elearning-ocs.com';
            $mail->Password   = 'december!123';
            $mail->Port       = 25;

            $mail->setFrom('info@elearning-ocs.com', 'OCS Training');
            $mail->addAddress('clifford.foh@ocsgroup.com');
            $mail->addAddress('Anna.Htoon@ocsgroup.com');

            $mail->isHTML(true);
            $mail->Subject = 'Feedback Submitted';
            $mail->Body    = 'Feedback was submitted by  <b>'.htmlspecialchars($Feed_Name).'</b>';
            $mail->AltBody = 'Feedback was submitted by '. $Feed_Name;

            $mail->send();
        } catch (Exception $e) {
            // do not block user on mail error
        }

        header('location: thank.php');
        exit;
    }
}

?>
  <div class="form-container shadow-sm">
    <div class="banner">
      <img src="images/OCSTrainingbig.png" alt="OCS Logo" />
      <div>
        <div class="title">OCS Training Institute</div>
        <div style="font-size:0.9rem; opacity:0.9;">“We Connect with Quality” - Feedback Form</div>
      </div>
      <!-- top-right logout button -->
      <a href="logout.php" class="logout-btn" role="button" title="Logout">Logout</a>
    </div>

    <div class="card-body">
      <div class="text-center mb-3">
        <h4 style="margin-bottom:0.25rem;">Course Name</h4>
        <div style="font-weight:700;">RIG INSPECTION - Land Rig (IADC Certified)</div>
      </div>

      <form action="Feedback.php" method="POST" novalidate>
        <input type="hidden" name="form_submitted" value="1">

        <div class="form-row mb-3">
          <div class="form-col">
            <label for="courseid">Course ID</label>
            <select name="courseid" id="courseid" class="form-control">
              <?php
                $q = "select distinct(trainingcode),datefrom from TrainingClass order by datefrom desc";
                $r = sqlsrv_query($conn,$q);
                while( $row = sqlsrv_fetch_array( $r , SQLSRV_FETCH_ASSOC) ) {
                  $code = htmlspecialchars($row['trainingcode']);
                  echo "<option value=\"{$code}\">{$code}</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-col">
            <label>Name <span style="color:#d9534f">*</span></label>
            <input name="txtusr_name" required type="text" class="form-control" value="<?php echo htmlspecialchars($_POST['txtusr_name'] ?? '', ENT_QUOTES); ?>">
          </div>
          <div class="form-col">
            <label>Designation</label>
            <input name="txtusr_des" type="text" class="form-control" value="<?php echo htmlspecialchars($_POST['txtusr_des'] ?? '', ENT_QUOTES); ?>">
          </div>
          <div class="form-col">
            <label>Organization</label>
            <input name="txtusr_org" type="text" class="form-control" value="<?php echo htmlspecialchars($_POST['txtusr_org'] ?? '', ENT_QUOTES); ?>">
          </div>
          <div class="form-col">
            <label>Email <span style="color:#d9534f">*</span></label>
            <input name="txtusr_email" type="email" class="form-control" required value="<?php echo htmlspecialchars($_POST['txtusr_email'] ?? '', ENT_QUOTES); ?>">
          </div>
        </div>

        <h2 class="section-title">Workshop & Trainer’s Appraisal</h2>

        <div class="table-responsive mb-3">
          <table class="table">
            <thead>
              <tr>
                <th>Speaker</th>
                <th style="width:160px">Score</th>
                <th>Comments</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // helper to output a row
                function rating_row($label, $sc_name, $cm_name) {
                  $selected = $_POST[$sc_name] ?? '';
                  $cm = htmlspecialchars($_POST[$cm_name] ?? '', ENT_QUOTES);
                  echo "<tr>
                        <td>{$label}</td>
                        <td>";
                  echo "<select name=\"{$sc_name}\" class=\"rating-select form-control\">";
                  for($i=1;$i<=10;$i++){
                    $sel = $selected == (string)$i ? 'selected' : '';
                    echo "<option value=\"{$i}\" {$sel}>{$i}</option>";
                  }
                  echo "</select></td>
                        <td><textarea name=\"{$cm_name}\" class=\"form-control\">{$cm}</textarea></td>
                      </tr>";
                }
                rating_row("Trainer’s Presentation Style","wta_sc_1","wta_cm_1");
                rating_row("Trainer’s knowledge and experience","wta_sc_2","wta_cm_2");
                rating_row("Extent of topics covered","wta_sc_3","wta_cm_3");
                rating_row("Relevancy of topics to your organisation","wta_sc_4","wta_cm_4");
                rating_row("Trainer’s ability to answer to your queries","wta_sc_5","wta_cm_5");
                rating_row("Extent of open discussion","wta_sc_6","wta_cm_6");
              ?>
            </tbody>
          </table>
        </div>

        <h2 class="section-title">Overall Expectations</h2>
        <div class="expectation-card mb-3">
          <div class="form-group">
            <label>How would you rate this event?</label>
            <div class="options">
              <?php
                $opts = ['Excellent','Good','Average','Poor'];
                foreach($opts as $o){
                  $chk = (isset($_POST['rdexpt']) && $_POST['rdexpt']==$o) ? 'checked' : '';
                  echo "<label class='option'><input type='radio' name='rdexpt' value='".htmlspecialchars($o)."' {$chk} /> {$o}</label>";
                }
              ?>
            </div>
          </div>
        </div>

        <h2 class="section-title">Organisation of Workshop and Venue</h2>
        <div class="expectation-card mb-3">
          <?php
            $owv_labels = [
              'rd_owv1' => 'Organisation of workshop',
              'rd_owv2' => 'Quality of support documentation',
              'rd_owv3' => 'Delegate group size',
              'rd_owv4' => 'Mix of delegates',
              'rd_owv5' => 'Efficiency of support staff'
            ];
            foreach($owv_labels as $name=>$label){
              echo "<div class='form-group'><label>{$label}</label><div class='options'>";
              foreach($opts as $o){
                $chk = (isset($_POST[$name]) && $_POST[$name]==$o) ? 'checked' : '';
                echo "<label class='option'><input type='radio' name='{$name}' value='".htmlspecialchars($o)."' {$chk}> {$o}</label>";
              }
              echo "</div></div>";
            }
          ?>
        </div>

        <h2 class="section-title">Future Events</h2>
        <div class="form-group">
          <label>1. What additional topics should have been included?</label>
          <textarea name="fut_eve1" class="form-control" rows="2"><?php echo htmlspecialchars($_POST['fut_eve1'] ?? '', ENT_QUOTES); ?></textarea>
        </div>
        <div class="form-group">
          <label>2. Which presentations/topics were most useful?</label>
          <textarea name="fut_eve2" class="form-control" rows="2"><?php echo htmlspecialchars($_POST['fut_eve2'] ?? '', ENT_QUOTES); ?></textarea>
        </div>
        <div class="form-group">
          <label>3. Suggestions for other training topics</label>
          <textarea name="fut_eve3" class="form-control" rows="2"><?php echo htmlspecialchars($_POST['fut_eve3'] ?? '', ENT_QUOTES); ?></textarea>
        </div>
        <div class="form-group">
          <label>4. Top three key training topics your organisation needs</label>
          <textarea name="fut_eve4" class="form-control" rows="2"><?php echo htmlspecialchars($_POST['fut_eve4'] ?? '', ENT_QUOTES); ?></textarea>
        </div>

        <h2 class="section-title">General Comments</h2>
        <div class="form-group">
          <label>1. Would you be able to provide a written testimonial? If yes, provide below</label>
          <textarea name="gc1" class="form-control" rows="2"><?php echo htmlspecialchars($_POST['gc1'] ?? '', ENT_QUOTES); ?></textarea>
        </div>
        <div class="form-group">
          <label>2. May we use your comments for marketing materials?</label>
          <div class="options">
            <label class="option"><input type="radio" name="rdgc" value="Yes" <?php if(isset($_POST['rdgc']) && $_POST['rdgc']=='Yes') echo 'checked'; ?>> Yes</label>
            <label class="option"><input type="radio" name="rdgc" value="No" <?php if(isset($_POST['rdgc']) && $_POST['rdgc']=='No') echo 'checked'; ?>> No</label>
          </div>
        </div>
        <div class="form-group">
          <label>Additional comments</label>
          <textarea name="gc2" class="form-control" rows="2"><?php echo htmlspecialchars($_POST['gc2'] ?? '', ENT_QUOTES); ?></textarea>
        </div>

        <h2 class="section-title">Referral of Colleagues</h2>
        <p>If you know of colleagues who may be interested, please provide details:</p>

        <div class="table-responsive mb-3">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Designation</th>
                <th>Organization</th>
                <th>Email</th>
                <th>Telephone</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" name="rname1" class="form-control" value="<?php echo htmlspecialchars($_POST['rname1'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="text" name="rpos1" class="form-control" value="<?php echo htmlspecialchars($_POST['rpos1'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="text" name="rorg1" class="form-control" value="<?php echo htmlspecialchars($_POST['rorg1'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="email" name="remail1" class="form-control" value="<?php echo htmlspecialchars($_POST['remail1'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="text" name="rtel1" class="form-control" value="<?php echo htmlspecialchars($_POST['rtel1'] ?? '', ENT_QUOTES); ?>" /></td>
              </tr>
              <tr>
                <td><input type="text" name="rname2" class="form-control" value="<?php echo htmlspecialchars($_POST['rname2'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="text" name="rpos2" class="form-control" value="<?php echo htmlspecialchars($_POST['rpos2'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="text" name="rorg2" class="form-control" value="<?php echo htmlspecialchars($_POST['rorg2'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="email" name="remail2" class="form-control" value="<?php echo htmlspecialchars($_POST['remail2'] ?? '', ENT_QUOTES); ?>" /></td>
                <td><input type="text" name="rtel2" class="form-control" value="<?php echo htmlspecialchars($_POST['rtel2'] ?? '', ENT_QUOTES); ?>" /></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="text-right">
          <button type="submit" class="btn-submit">Submit Feedback</button>
        </div>

      </form>

      <footer class="mt-3">
        Thank you for your valuable comments. OCS Group © <?php echo date("Y");?> — www.ocsgroup.com — info@ocsgroup.com
      </footer>
    </div>
  </div>

</body>
</html>
