<?php
require 'init.php';
//session_start();
//include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["success" => false, "error" => "User not logged in"]));
}

$user_id = $_SESSION['user_id'];

// Handle skill insertion or deletion (AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle skill deletion
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['skillId'])) {
        $skillId = $_POST['skillId'];
        $sql = "DELETE FROM skills WHERE user_id = ? AND skill_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $skillId);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to delete skill"]);
        }
        exit;
    }

    // Handle skill insertion
    if (isset($_POST['skillName'])) {
        $stmt = $conn->prepare("INSERT INTO skills (user_id, skill_name, skill_level) 
                                VALUES (?, ?, ?)");

        foreach ($_POST['skillName'] as $index => $skillName) {
            $skillLevel = $_POST['skillLevel'][$index];

            $stmt->bind_param("iss", $user_id, $skillName, $skillLevel);
            $stmt->execute();
        }

        echo json_encode(["success" => true]);
        exit;
    }
}
?>

<!-- Skills Form with Dynamic Sections -->
<form id="skillsForm" method="POST">
    <div class="editor-section">
        <h3>Skills</h3>
        <div id="skillsSections">
            <?php
            // Fetch and display existing skills data
            $sql = "SELECT * FROM skills WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo '<div class="skills-item" data-id="' . $row['skill_id'] . '">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="skillName" class="form-label">Skill Name</label>
                                <input type="text" class="form-control" name="skillName[]" value="' . htmlspecialchars($row['skill_name']) . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="skillLevel" class="form-label">Skill Level</label>
                                <select class="form-control" name="skillLevel[]" required>
                                    <option value="Beginner"' . ($row['skill_level'] == 'Beginner' ? ' selected' : '') . '>Beginner</option>
                                    <option value="Intermediate"' . ($row['skill_level'] == 'Intermediate' ? ' selected' : '') . '>Intermediate</option>
                                    <option value="Advanced"' . ($row['skill_level'] == 'Advanced' ? ' selected' : '') . '>Advanced</option>
                                    <option value="Expert"' . ($row['skill_level'] == 'Expert' ? ' selected' : '') . '>Expert</option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-danger removeSkill w-100">Remove Skill</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <button type="button" class="btn btn-primary mb-3 w-100" onclick="addSkill()">Add Skill</button>
    </div>
    <button type="submit" class="btn btn-success">Save Skills</button>
</form>

<script>
    // Add Skill Section
    function addSkill() {
        const skillDiv = document.createElement("div");
        skillDiv.classList.add("mb-3");
        skillDiv.innerHTML = `        
            <div class="row">
                <div class="col-md-6">
                    <label for="skillName" class="form-label">Skill Name</label>
                    <input type="text" class="form-control" name="skillName[]" required>
                </div>
                <div class="col-md-6">
                    <label for="skillLevel" class="form-label">Skill Level</label>
                    <select class="form-control" name="skillLevel[]" required>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                        <option value="Expert">Expert</option>
                    </select>
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Skill</button>
                </div>
            </div>
        `;
        document.getElementById("skillsSections").appendChild(skillDiv);
    }

    // Remove Skill Section (AJAX Deletion with Confirmation)
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeSkill')) {
            const section = event.target.closest('.skills-item');
            const skillId = section.dataset.id;

            const confirmation = confirm("Are you sure you want to delete this skill?");
            if (confirmation) {
                fetch('skills.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'delete',
                        skillId: skillId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        section.remove(); // Remove the section from the page
                        alert("Skill removed successfully!");
                    } else {
                        alert("Error removing skill: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error during AJAX request:", error);
                });
            }
        }
    });

    // Save Skills (AJAX Request)
    document.querySelector("#skillsForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('skills.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Skills saved successfully!");
                location.reload(); // Refresh page to reflect changes
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while saving skills.");
        });
    });
</script>
