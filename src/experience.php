<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["success" => false, "error" => "User not logged in"]));
}

$user_id = $_SESSION['user_id'];

// Handle experience insertion or deletion (AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle experience deletion
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['experienceId'])) {
        $experienceId = $_POST['experienceId'];
        $sql = "DELETE FROM experience WHERE user_id = ? AND experience_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $experienceId);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to delete experience"]);
        }
        exit;
    }

    // Handle experience insertion
    if (isset($_POST['jobTitle'])) {
        $stmt = $conn->prepare("INSERT INTO experience (user_id, job_title, employer, job_description, start_date, end_date, city) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($_POST['jobTitle'] as $index => $jobTitle) {
            $employer = $_POST['employer'][$index];
            $jobDescription = $_POST['jobDescription'][$index];
            $startDate = $_POST['startDate'][$index];
            $endDate = $_POST['endDate'][$index];
            $experienceCity = $_POST['experienceCity'][$index];

            $stmt->bind_param("issssss", $user_id, $jobTitle, $employer, $jobDescription, $startDate, $endDate, $experienceCity);
            $stmt->execute();
        }

        echo json_encode(["success" => true]);
        exit;
    }
}
?>

<!-- Experience Form with Dynamic Sections -->
<form id="experienceForm" method="POST">
    <div class="editor-section">
        <h3>Experience</h3>
        <div id="experienceSections">
            <?php
            // Fetch and display existing experience data
            $sql = "SELECT * FROM experience WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo '<div class="experience-item" data-id="' . $row['experience_id'] . '">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="jobTitle" class="form-label">Job Title</label>
                                <input type="text" class="form-control" name="jobTitle[]" value="' . htmlspecialchars($row['job_title']) . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="employer" class="form-label">Employer</label>
                                <input type="text" class="form-control" name="employer[]" value="' . htmlspecialchars($row['employer']) . '" required>
                            </div>
                            <div class="col-12">
                                <label for="jobDescription" class="form-label">Job Description</label>
                                <textarea class="form-control" name="jobDescription[]">' . htmlspecialchars($row['job_description']) . '</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="startDate[]" value="' . $row['start_date'] . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="endDate[]" value="' . $row['end_date'] . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="experienceCity" class="form-label">City</label>
                                <input type="text" class="form-control" name="experienceCity[]" value="' . htmlspecialchars($row['city']) . '">
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-danger removeExperience w-100">Remove Experience</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <button type="button" class="btn btn-primary mb-3 w-100" onclick="addExperience()">Add Experience</button>
    </div>
    <button type="submit" class="btn btn-success">Save Experience</button>
</form>

<script>
    // Add Experience Section
    function addExperience() {
        const experienceDiv = document.createElement("div");
        experienceDiv.classList.add("mb-3");
        experienceDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input type="text" class="form-control" name="jobTitle[]" required>
                </div>
                <div class="col-md-6">
                    <label for="employer" class="form-label">Employer</label>
                    <input type="text" class="form-control" name="employer[]" required>
                </div>
                <div class="col-12">
                    <label for="jobDescription" class="form-label">Job Description</label>
                    <textarea class="form-control" name="jobDescription[]"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="startDate[]" required>
                </div>
                <div class="col-md-6">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="endDate[]" required>
                </div>
                <div class="col-md-6">
                    <label for="experienceCity" class="form-label">City</label>
                    <input type="text" class="form-control" name="experienceCity[]">
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Experience</button>
                </div>
            </div>
        `;
        document.getElementById("experienceSections").appendChild(experienceDiv);
    }

    // Remove Experience Section (AJAX Deletion with Confirmation)
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeExperience')) {
            const section = event.target.closest('.experience-item');
            const experienceId = section.dataset.id;

            const confirmation = confirm("Are you sure you want to delete this experience?");
            if (confirmation) {
                fetch('experience.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'delete',
                        experienceId: experienceId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        section.remove(); // Remove the section from the page
                        alert("Experience removed successfully!");
                    } else {
                        alert("Error removing experience: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error during AJAX request:", error);
                });
            }
        }
    });

    // Save Experience (AJAX Request)
    document.querySelector("#experienceForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('experience.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Experience saved successfully!");
                location.reload(); // Refresh page to reflect changes
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while saving experience.");
        });
    });
</script>
