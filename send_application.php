<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    // Upload Resume
    $uploadDir = "resumes/"; // Directory where resumes will be stored
    $resumePath = $uploadDir . basename($_FILES["resume"]["name"]);
    $resumeFileType = strtolower(pathinfo($resumePath, PATHINFO_EXTENSION));

    if ($resumeFileType === "pdf") {
        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $resumePath)) {
            $subject = "Job Application: Job Title"; // Replace with actual job title
            $message = "Name: $name\nEmail: $email\n";
            // You can include more details in the email message
            
            $to = "manojmadduri@gmail.com"; // Replace with the recipient's email address
            $headers = "From: $email";

            if (mail($to, $subject, $message, $headers)) {
                echo "Application submitted successfully!";
            } else {
                echo "Error sending application.";
            }
        } else {
            echo "Error uploading resume.";
        }
    } else {
        echo "Invalid resume format. Please upload a PDF file.";
    }
}
?>
