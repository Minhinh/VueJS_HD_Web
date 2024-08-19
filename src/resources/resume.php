<?php
// Connect to the database
$conn = mysqli_connect('feenix-mariadb.swin.edu.au', 's104082552', '111004', 's104082552_db');
mysqli_set_charset($conn, 'utf8');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the resume ID from the request
$resumeId = $_GET['id']; // Assuming 'id' is the parameter for the resume ID

// Prepare SQL statement to retrieve the resume file
$sql = "SELECT filename, filetype, filesize, filedata FROM resumes WHERE id = $resumeId";

// Execute the SQL statement
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the resume data
    $row = mysqli_fetch_assoc($result);

    // Set the appropriate content headers
    header("Content-type: " . $row['filetype']);
    header("Content-length: " . $row['filesize']);
    header("Content-Disposition: inline; filename=" . $row['filename']);

    // Output the resume file content
    echo $row['filedata'];
} else {
    // Resume not found
    http_response_code(404);
    echo "Resume not found";
}

// Close the database connection
mysqli_close($conn);
?>
