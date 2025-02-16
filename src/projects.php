<?php
require 'init.php';
//session_start();
//include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["success" => false, "error" => "User not logged in"]));
}

$user_id = $_SESSION['user_id'];

// Handle project insertion or deletion (AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle project deletion
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['projectId'])) {
        $projectId = $_POST['projectId'];
        $sql = "DELETE FROM projects WHERE user_id = ? AND project_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $projectId);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to delete project"]);
        }
        exit;
    }

    // Handle project insertion
    if (isset($_POST['projectName'])) {
        $stmt = $conn->prepare("INSERT INTO projects (user_id, project_name, project_description, project_link) 
                                VALUES (?, ?, ?, ?)");

        foreach ($_POST['projectName'] as $index => $projectName) {
            $projectDescription = $_POST['projectDescription'][$index];
            $projectLink = $_POST['projectLink'][$index];

            $stmt->bind_param("isss", $user_id, $projectName, $projectDescription, $projectLink);
            $stmt->execute();
        }

        echo json_encode(["success" => true]);
        exit;
    }
}
?>

<!-- Projects Form with Dynamic Sections -->
<form id="projectsForm" method="POST">
    <div class="editor-section">
        <h3>Projects</h3>
        <div id="projectsSections">
            <?php
            // Fetch and display existing project data
            $sql = "SELECT * FROM projects WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo '<div class="project-item" data-id="' . $row['project_id'] . '">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="projectName" class="form-label">Project Name</label>
                                <input type="text" class="form-control" name="projectName[]" value="' . htmlspecialchars($row['project_name']) . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="projectLink" class="form-label">Project Link</label>
                                <input type="text" class="form-control" name="projectLink[]" value="' . htmlspecialchars($row['project_link']) . '">
                            </div>
                            <div class="col-12">
                                <label for="projectDescription" class="form-label">Project Description</label>
                                <textarea class="form-control" name="projectDescription[]">' . htmlspecialchars($row['project_description']) . '</textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-danger removeProject w-100">Remove Project</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <button type="button" class="btn btn-primary mb-3 w-100" onclick="addProject()">Add Project</button>
    </div>
    <!-- Save Projects button -->
    <button type="submit" class="btn btn-success">Save Projects</button>
</form>

<script>
    // Add Project Section
    function addProject() {
        const projectDiv = document.createElement("div");
        projectDiv.classList.add("mb-3");
        projectDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label for="projectName" class="form-label">Project Name</label>
                    <input type="text" class="form-control" name="projectName[]" required>
                </div>
                <div class="col-md-6">
                    <label for="projectLink" class="form-label">Project Link</label>
                    <input type="text" class="form-control" name="projectLink[]">
                </div>
                <div class="col-12">
                    <label for="projectDescription" class="form-label">Project Description</label>
                    <textarea class="form-control" name="projectDescription[]"></textarea>
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Project</button>
                </div>
            </div>
        `;
        document.getElementById("projectsSections").appendChild(projectDiv);
    }

    // Remove Project Section (AJAX Deletion with Confirmation)
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeProject')) {
            const section = event.target.closest('.project-item');
            const projectId = section.dataset.id;

            const confirmation = confirm("Are you sure you want to delete this project?");
            if (confirmation) {
                fetch('projects.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'delete',
                        projectId: projectId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        section.remove(); // Remove the section from the page
                        alert("Project removed successfully!");
                    } else {
                        alert("Error removing project: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error during AJAX request:", error);
                });
            }
        }
    });

    // Save Projects (AJAX Request)
    document.querySelector("#projectsForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('projects.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Projects saved successfully!");
                location.reload(); // Refresh page to reflect changes
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while saving projects.");
        });
    });
</script>
