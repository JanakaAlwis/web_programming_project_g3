<?php
$pageTitle = "Editor";
$metaDescription = "Customize your portfolio with an easy-to-use editor. Modify text, images, and layout.";
$headerTitle = "Portfolio Editor";
$headerSubtitle = "";
$extraCSS = '<link rel="stylesheet" href="css/editor.css">';
include 'header.php';
?>

<main class="editor-container">
    <h2>Edit Your Portfolio</h2>

<!-- Personal Information -->
<div class="editor-section">
    <h3>Personal Information</h3>
    <form>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="zipCode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zipCode" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="profileImage" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="profileImage" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="linkedin" class="form-label">LinkedIn URL</label>
                <input type="url" class="form-control" id="linkedin">
            </div>
        </div>
    </form>
</div>

        <!-- Dynamic Experience Section -->
        <div class="editor-section">
            <h3>Experience</h3>
            <div id="experienceSections">
                <button type="button" class="btn btn-primary mb-3" onclick="addExperience()">Add Experience</button>
            </div>
        </div>

        <!-- Dynamic Skills Section -->
        <div class="editor-section">
            <h3>Skills</h3>
            <div id="skillsSections">
                <button type="button" class="btn btn-primary mb-3" onclick="addSkill()">Add Skill</button>
            </div>
        </div>

        <!-- Dynamic Education Section -->
        <div class="editor-section">
            <h3>Education</h3>
            <div id="educationSections">
                <button type="button" class="btn btn-primary mb-3" onclick="addEducation()">Add Education</button>
            </div>
        </div>

        <!-- Dynamic Projects Section -->
        <div class="editor-section">
            <h3>Projects</h3>
            <div id="projectsSections">
                <button type="button" class="btn btn-primary mb-3" onclick="addProject()">Add Project</button>
            </div>
        </div>

        <!-- Dynamic References Section -->
        <div class="editor-section">
            <h3>References</h3>
            <div id="referencesSections">
                <button type="button" class="btn btn-primary mb-3" onclick="addReference()">Add Reference</button>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-success" type="submit">Save Portfolio</button>
        </div>
    </main>

    <!-- Include footer.php -->
    <?php include 'footer.php'; ?>

    <script>
        // Add Experience Section
        function addExperience() {
            const experienceDiv = document.createElement('div');
            experienceDiv.classList.add('mb-3');
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
            document.getElementById('experienceSections').appendChild(experienceDiv);
        }

        // Add Skill Section
        function addSkill() {
            const skillDiv = document.createElement('div');
            skillDiv.classList.add('mb-3');
            skillDiv.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <label for="skillName" class="form-label">Skill Name</label>
                        <input type="text" class="form-control" name="skillName[]" required>
                    </div>
                    <div class="col-md-6">
                        <label for="skillLevel" class="form-label">Skill Level</label>
                        <input type="text" class="form-control" name="skillLevel[]" required>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Skill</button>
                    </div>
                </div>
            `;
            document.getElementById('skillsSections').appendChild(skillDiv);
        }

        // Add Education Section
        function addEducation() {
            const educationDiv = document.createElement('div');
            educationDiv.classList.add('mb-3');
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
                        <input type="text" class="form-control" name="qualification[]" required>
                    </div>
                    <div class="col-md-6">
                        <label for="gradYear" class="form-label">Graduation Year</label>
                        <input type="number" class="form-control" name="gradYear[]" required>
                    </div>
                    <div class="col-12">
                        <label for="eduDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="eduDescription[]"></textarea>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Education</button>
                    </div>
                </div>
            `;
            document.getElementById('educationSections').appendChild(educationDiv);
        }

        // Add Project Section
        function addProject() {
            const projectDiv = document.createElement('div');
            projectDiv.classList.add('mb-3');
            projectDiv.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <label for="projectName" class="form-label">Project Name</label>
                        <input type="text" class="form-control" name="projectName[]" required>
                    </div>
                    <div class="col-12">
                        <label for="projectDescription" class="form-label">Project Description</label>
                        <textarea class="form-control" name="projectDescription[]"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="projectLink" class="form-label">Project Link</label>
                        <input type="url" class="form-control" name="projectLink[]">
                    </div>
                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Project</button>
                    </div>
                </div>
            `;
            document.getElementById('projectsSections').appendChild(projectDiv);
        }

        // Add Reference Section
        function addReference() {
            const referenceDiv = document.createElement('div');
            referenceDiv.classList.add('mb-3');
            referenceDiv.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <label for="referanceName" class="form-label">Reference Name</label>
                        <input type="text" class="form-control" name="referanceName[]" required>
                    </div>
                    <div class="col-md-6">
                        <label for="referanceEmail" class="form-label">Reference Email</label>
                        <input type="email" class="form-control" name="referanceEmail[]" required>
                    </div>
                    <div class="col-md-6">
                        <label for="referanceContact" class="form-label">Reference Contact</label>
                        <input type="tel" class="form-control" name="referanceContact[]" required>
                    </div>
                    <div class="col-md-6">
                        <label for="referanceDesignation" class="form-label">Designation</label>
                        <input type="text" class="form-control" name="referanceDesignation[]" required>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="button" class="btn btn-danger" onclick="removeSection(this)">Remove Reference</button>
                    </div>
                </div>
            `;
            document.getElementById('referencesSections').appendChild(referenceDiv);
        }

        // Remove Section
        function removeSection(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
</body>
</html>
