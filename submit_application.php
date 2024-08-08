<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Local Database connection,Xampp
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "internship_application";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $nickname = $conn->real_escape_string($_POST['nickname']);
    $address = $conn->real_escape_string($_POST['address']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $blood_type = $conn->real_escape_string($_POST['blood_type']);
    $line_id = $conn->real_escape_string($_POST['line_id']);
    $university = $conn->real_escape_string($_POST['university']);
    $qualification = $conn->real_escape_string($_POST['qualification']);
    $field_of_study = $conn->real_escape_string($_POST['field_of_study']);
    $gpa = $conn->real_escape_string($_POST['gpa']);
    $internship_role = $conn->real_escape_string($_POST['internship_role']);
    $internship_start = $conn->real_escape_string($_POST['internship_start']);
    $internship_end = $conn->real_escape_string($_POST['internship_end']);
    $reason = $conn->real_escape_string($_POST['reason']);
    $swot = $conn->real_escape_string($_POST['swot']);
    $know_program = $conn->real_escape_string($_POST['know_program']);
    $work_preference = $conn->real_escape_string($_POST['work_preference']);

    $resume = $_FILES['resume'];
    $resume_path = 'uploads/' . basename($resume['name']);
    move_uploaded_file($resume['tmp_name'], $resume_path);

    $sql = "INSERT INTO applications (
        name, email, mobile, nickname, address, dob, blood_type, line_id, university, qualification, 
        field_of_study, gpa, resume_path, internship_role, internship_start, internship_end, reason, 
        swot, know_program, work_preference
    ) VALUES (
        '$name', '$email', '$mobile', '$nickname', '$address', '$dob', '$blood_type', '$line_id', 
        '$university', '$qualification', '$field_of_study', '$gpa', '$resume_path', '$internship_role', 
        '$internship_start', '$internship_end', '$reason', '$swot', '$know_program', '$work_preference'
    )";

    if ($conn->query($sql) === TRUE) {
        // Generate PDF
        $dompdf = new Dompdf();
        $html = "
            <h1>Internship Application Details</h1>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Mobile No.:</strong> $mobile</p>
            <p><strong>Nickname:</strong> $nickname</p>
            <p><strong>Address:</strong> $address</p>
            <p><strong>Date of Birth:</strong> $dob</p>
            <p><strong>Blood Type:</strong> $blood_type</p>
            <p><strong>Line ID:</strong> $line_id</p>
            <p><strong>University:</strong> $university</p>
            <p><strong>Qualification:</strong> $qualification</p>
            <p><strong>Field of Study:</strong> $field_of_study</p>
            <p><strong>GPA:</strong> $gpa</p>
            <p><strong>Internship Role:</strong> $internship_role</p>
            <p><strong>Internship Period:</strong> $internship_start to $internship_end</p>
            <p><strong>Reason:</strong> $reason</p>
            <p><strong>SWOT:</strong> $swot</p>
            <p><strong>How did you know about our internship program?:</strong> $know_program</p>
            <p><strong>Work Preference:</strong> $work_preference</p>
        ";
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdf_output = $dompdf->output();

        // Send email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'lionmyanmarnationalcompany@gmail.com';
            $mail->Password = 'adrq wvqz auar jbrt';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('your_email@example.com', 'Internship Application');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Internship Application Received';
            $mail->Body = '
                    <html>
                    <body>
                        <p>Dear Khun '.$name.',</p>   
                        <h2 style="color:gold;"> Greeting from the Main Office</h2>            
                        <p>Thank you for filling out our application form. We will contact you shortly. Stay Tune Khrap. Please find attached a copy of your application details belows.</p>
                        <p>Best regards,</p>
                        <p>Lion Myanmar National Software Co.Ltd,</p>
                    </body>
                    </html>      
             ';

            $mail->addStringAttachment($pdf_output, 'application.pdf');

            $mail->send();

            // Redirect to confirmation page
            header('Location: confirmation.php');
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
