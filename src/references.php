<?php
require 'init.php';
//session_start();
//include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["success" => false, "error" => "User not logged in"]));
}

$user_id = $_SESSION['user_id'];

// Handle reference insertion or deletion (AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle reference deletion
    if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['referenceId'])) {
        $referenceId = $_POST['referenceId'];
        $sql = "DELETE FROM user_references WHERE user_id = ? AND reference_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $referenceId);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to delete reference"]);
        }
        exit;
    }

    // Handle reference insertion
    if (isset($_POST['referenceName'])) {
        $stmt = $conn->prepare("INSERT INTO user_references (user_id, reference_name, reference_email, reference_contact, designation) 
                                VALUES (?, ?, ?, ?, ?)");

        foreach ($_POST['referenceName'] as $index => $referenceName) {
            $referenceEmail = $_POST['referenceEmail'][$index];
            $referenceContact = $_POST['referenceContact'][$index];
            $designation = $_POST['designation'][$index];

            $stmt->bind_param("issss", $user_id, $referenceName, $referenceEmail, $referenceContact, $designation);
            $stmt->execute();
        }

        echo json_encode(["success" => true]);
        exit;
    }
}
?>

<!-- References Form with Dynamic Sections -->
<form id="referencesForm" method="POST">
    <div class="editor-section">
        <h3>References</h3>
        <div id="referencesSections">
            <?php
            // Fetch and display existing reference data
            $sql = "SELECT * FROM user_references WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo '<div class="reference-item" data-id="' . $row['reference_id'] . '">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="referenceName" class="form-label">Reference Name</label>
                                <input type="text" class="form-control" name="referenceName[]" value="' . htmlspecialchars($row['reference_name']) . '" required>
                            </div>
                            <div class="col-md-6">
                                <label for="referenceEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="referenceEmail[]" value="' . htmlspecialchars($row['reference_email']) . '">
                            </div>
                            <div class="col-md-6">
                                <label for="referenceContact" class="form-label">Contact</label>
                                <input type="text" class="form-control" name="referenceContact[]" value="' . htmlspecialchars($row['reference_contact']) . '">
                            </div>
                            <div class="col-md-6">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" name="designation[]" value="' . htmlspecialchars($row['designation']) . '">
                            </div>
                            <div class="col-12 mt-2">
                                <button type="button" class="btn btn-danger removeReference w-100">Remove Reference</button>
                            </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <button type="button" class="btn btn-primary mb-3 w-100" onclick="addReference()">Add Reference</button>
    </div>
    <!-- Save References button -->
    <button type="submit" class="btn btn-success">Save References</button>
</form>

<script>
    // Add Reference Section
    function addReference() {
        const referenceDiv = document.createElement("div");
        referenceDiv.classList.add("mb-3");
        referenceDiv.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label for="referenceName" class="form-label">Reference Name</label>
                    <input type="text" class="form-control" name="referenceName[]" required>
                </div>
                <div class="col-md-6">
                    <label for="referenceEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="referenceEmail[]">
                </div>
                <div class="col-md-6">
                    <label for="referenceContact" class="form-label">Contact</label>
                    <input type="text" class="form-control" name="referenceContact[]">
                </div>
                <div class="col-md-6">
                    <label for="designation" class="form-label">Designation</label>
                    <input type="text" class="form-control" name="designation[]">
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Reference</button>
                </div>
            </div>
        `;
        document.getElementById("referencesSections").appendChild(referenceDiv);
    }

    // Remove Reference Section (AJAX Deletion with Confirmation)
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeReference')) {
            const section = event.target.closest('.reference-item');
            const referenceId = section.dataset.id;

            const confirmation = confirm("Are you sure you want to delete this given reference?");
            if (confirmation) {
                fetch('references.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        action: 'delete',
                        referenceId: referenceId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        section.remove(); // Remove the section from the page
                        alert("Reference removed successfully!");
                    } else {
                        alert("Error removing reference: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error during AJAX request:", error);
                });
            }
        }
    });

    // Save References (AJAX Request)
    document.querySelector("#referencesForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('references.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("References saved successfully!");
                location.reload(); // Refresh page to reflect changes
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while saving references.");
        });
    });
</script>
