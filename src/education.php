<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["success" => false, "error" => "User not logged in"]));
}

$user_id = $_SESSION['user_id'];

// Handle education insertion or deletion (AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle education deletion
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['educationId'])) {
        $educationId = $_POST['educationId'];
        $sql = "DELETE FROM education WHERE user_id = ? AND education_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $educationId);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to delete education"]);
        }
        exit;
    }

    // Handle education insertion
    if (isset($_POST['institution'])) {
        $stmt = $conn->prepare("INSERT INTO education (user_id, institution, field_of_study, qualification, grad_year, description) 
                                VALUES (?, ?, ?, ?, ?, ?)");

        foreach ($_POST['institution'] as $index => $institution) {
            $fieldOfStudy = $_POST['fieldOfStudy'][$index];
            $qualification = $_POST['qualification'][$index];
            $gradYear = $_POST['gradYear'][$index];
            $description = $_POST['description'][$index];

            $stmt->bind_param("isssis", $user_id, $institution, $fieldOfStudy, $qualification, $gradYear, $description);
            $stmt->execute();
        }

        echo json_encode(["success" => true]);
        exit;
    }
}
?>

<!-- Education Form with Dynamic Sections -->
<form id="educationForm" method="POST">
    <div class="editor-section">
        <h3>Education</h3>
        <div id="educationSections">
            <?php
            // Fetch and display existing education data
            $sql = "SELECT * FROM education WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo '<div class="education-item" data-id="' . $row['education_id'] . '">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="institution" class="form-label">Institution</label>
                                <input type="text" class="form-control" name="institution[]" value="' . htmlspecialchars($row['institution']) . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fieldOfStudy" class="form-label">Field of Study</label>
                                <input type="text" class="form-control" name="fieldOfStudy[]" value="' . htmlspecialchars($row['field_of_study']) . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="qualification" class="form-label">Qualification</label>
                                <input type="text" class="form-control" name="qualification[]" value="' . htmlspecialchars($row['qualification']) . '">
                            </div>
                            <div class="col-md-6">
                                <label for="gradYear" class="form-label">Graduation Year</label>
                                <input type="number" class="form-control" name="gradYear[]" value="' . $row['grad_year'] . '" required>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description[]">' . htmlspecialchars($row['description']) . '</textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-danger removeEducation w-100">Remove Education</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <button type="button" class="btn btn-primary mb-3 w-100" onclick="addEducation()">Add Education</button>
    </div>
    <!-- Save Education button -->
    <button type="submit" class="btn btn-success">Save Education</button>
</form>

<script>
    // Add Education Section
    function addEducation() {
        const educationDiv = document.createElement("div");
        educationDiv.classList.add("mb-3");
        educationDiv.innerHTML = `        
            <div class="row">
                <div class="col-md-6">
                    <label for="institution" class="form-label">Institution</label>
                    <input type="text" class="form-control" name="institution[]" required>
                </div>
                <div class="col-md-6">
                    <label for="fieldOfStudy" class="form-label">Field of Study</label>
                    <input type="text" class="form-control" name="fieldOfStudy[]" required>
                </div>
                <div class="col-md-6">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control" name="qualification[]">
                </div>
                <div class="col-md-6">
                    <label for="gradYear" class="form-label">Graduation Year</label>
                    <input type="number" class="form-control" name="gradYear[]" required>
                </div>
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description[]"></textarea>
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Education</button>
                </div>
            </div>
        `;
        document.getElementById("educationSections").appendChild(educationDiv);
    }

    // Remove Education Section (AJAX Deletion with Confirmation)
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeEducation')) {
            const section = event.target.closest('.education-item');
            const educationId = section.dataset.id;

            const confirmation = confirm("Are you sure you want to delete this education?");
            if (confirmation) {
                fetch('education.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'delete',
                        educationId: educationId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        section.remove(); // Remove the section from the page
                        alert("Education removed successfully!");
                    } else {
                        alert("Error removing education: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error during AJAX request:", error);
                });
            }
        }
    });

    // Save Education (AJAX Request)
    document.querySelector("#educationForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('education.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Education saved successfully!");
                location.reload(); // Refresh page to reflect changes
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while saving education.");
        });
    });
</script>
