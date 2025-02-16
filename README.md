# web_programming_project_g3

# Readme.md

# Web Programming Project - Team 3

**JRAVICH - Student Portfolio Builder**

JRAVICH is an innovative web platform designed to empower students to create, manage, and showcase their academic and professional portfolios. The platform offers a highly user-friendly interface, helping students present their skills, achievements, and career journey in a polished and visually appealing way.

Key Features:

**Sign Up/Login:**
- Account Creation & Login: Students can create a secure account or log in to access and personalize their portfolio. The login process ensures that each user’s data is protected and easily accessible.
- Signup: Students register by providing basic information, including their full name, email, username, password, and confirming their email address.
- Login: Registered users can log in using their credentials for convenient access to their portfolio from any device.
  
**Upload and Organize Content:**
- Students can upload a wide variety of content, including academic achievements, certifications, projects, skills, internship experiences, and other key details related to their academic and professional development.
- Portfolio Sections:
  Personal Information: Students can input their first name, last name, city, country, ZIP code, phone, email address, LinkedIn URL, and can upload a profile image.
  Experience: Job title, employer, job description, years worked (start date & end date) and city  can be uploaded to highlight professional experience.
  Skills: Students can list various skills with their proficiency level.
  Education: Students can input their institution/ university name(s), field of study, qualification, graduation year(s) and description.
  Projects: Information about completed projects, including project names and URLs, can be added.
  References: Students can add details of references, including name, contact, and relationship.
  
  **Portfolio Design Templates:**
- Pre-Designed Templates: Students can choose from a variety of pre-designed portfolio templates to personalize the look and feel of their portfolio.
- Responsive Design: The templates are mobile-friendly and adapt to all screen sizes, ensuring the portfolio looks great on both desktop and mobile devices.
- Template Features:
  Color Schemes: Various color options, ranging from modern to classic, allowing students to match the design to their personal brand.
  Typography Styles: Different font choices to create a unique look for their portfolio.
- Template Preview: Students can preview templates before applying them to their portfolios, ensuring the design perfectly aligns with their preferences.
  
**Generate a Professional Portfolio Display:**
- Dsiplay Portfolio: Students can create a polished, high-quality portfolio to effectively showcase and share their academic achievements in a professional and impactful manner.

  **Other Potential Features (Optional):**
- Mobile-Friendly Version: Ensure that the portfolio builder works smoothly on mobile devices, so students can access and modify their portfolio on the go.


## Table of Contents
- [Features](#features)
- [Database Tables](#database-tables)
- [Created Forms](#created-forms)
- [Created Tables](#created-tables)

---

## Features

In this section, the features we are working on this website project are listed and their functionalities are described in detail. The checkboxes are used to track the progress of each feature.

- [ ] Sign up/ Login/ Log off (Janaka Alwils)  
- [ ] Editor & Portfolio Building (Janaka Alwis, Charith Kaushalya, Ravidu Wijeseskara)
- [ ] Templates Design & Creation (Charith Kaushalya, Vindya Nukulasooriya)
- [ ] Portflio Display (Vindya Nukulasooriya)
- [ ] Contacts Submission (Ravidu Wijesekara)
- [ ] Preaparation of ReadMe Document (Vindya Nukulasooriya, Ravidu Wijesekara, Charith Kaushalya)

---

### Sign up/ Login/ Log off

Students can securely create an account or log in to personalize and access their portfolio. During signup, they provide essential information, including their full name, email, username, and password, while confirming their email address. Registered users can easily log in using their credentials, ensuring convenient access to their portfolio from any device while keeping their data secure.

[links to related code files (github)] 
src/index.php
src/personal_info.php
src/logout.php

[link to the feature (shell.hamk.fi)]


### Editor & Portfolio Building

Students can create a comprehensive portfolio by adding personal information such as name, contact details, and a profile image. They can highlight professional experience by listing job titles, employers, job descriptions, and duration of employment. The portfolio allows students to showcase their skills with proficiency levels, input educational background, including institutions, qualifications, and graduation years, and provide details of completed projects with project names and URLs. Additionally, students can include references, listing names, contact information, and their relationship to the individual. These sections help students build a well-rounded and professional portfolio.

[links to related code files (github)] 
src/css/editor.css
src/editor.php
src/css/portfolio.css
src/portfolio.php

[link to the feature (shell.hamk.fi)]

### Templates Design & Creation

Students can choose from a variety of pre-designed, mobile-friendly templates to personalize the look and feel of their portfolio. These templates offer customizable color schemes and typography styles, allowing students to align the design with their personal brand. Additionally, students can preview templates before applying them, ensuring the final design matches their preferences and looks great across all devices.

[links to related code files (github)] 
src/css/template1.css
src/css/template2.css
src/css/template3.css
src/css/template4.css
src/css/template5.css
src/css/templates.css
src/templates.php

[link to the feature (shell.hamk.fi)]

### Portflio Display

When displaying the portfolio, the content is organized into clear, easy-to-navigate sections, ensuring a professional and user-friendly presentation. Each section, such as personal information, experience, skills, education, projects, and references, is neatly arranged with relevant details and can be accessed or edited as needed. This allows students to effectively highlight their achievements, making it easy for viewers to understand their qualifications and expertise. The layout is designed to be visually appealing and responsive, ensuring the portfolio looks great on both desktop and mobile devices.

[links to related code files (github)] 
src/css/portfolio.css
src/portfolio.php

[link to the feature (shell.hamk.fi)]

### Contacts Submission

In this contact.php page, students can submit their inquiries or feedback through a contact form. They are required to provide their name, email address, and a message. Upon successful submission, the form data is stored in a database, and a confirmation message is displayed to notify the user that their message has been sent. The form is also reset after submission, ensuring a smooth user experience. This functionality allows students to easily reach out for support or make inquiries related to their portfolio or other academic matters.

[links to related code files (github)] 
src/css/contact.css
src/css/contact.css

[link to the feature (shell.hamk.fi)]


### Preaparation of ReadMe Document

This README document outlines the purpose, features, and development progress of the JRAVICH Student Portfolio Builder project. It provides a detailed overview of key functionalities such as account creation, content upload, customizable portfolio templates, and the ability to display a professional portfolio. The document also tracks the project's progress by listing the features, database tables, created forms, and tables, with links to related code and live demos. It serves as a comprehensive guide for both developers and users, ensuring clarity and effective collaboration throughout the project's lifecycle.

[links to related code files (github)] 
README.md

[link to the feature (shell.hamk.fi)]


---

## Database Tables

The list of the database tables that are part of the JRAVICH Student Portfolio Builder Project are as follows: 

- Table 1 (Janaka Alwis): users table
- Table 2 (Janaka Alwis): experience table 
- Table 3 (Vindya Nukulasooriya): skills table
- Table 4 (Vindya Nukulasooriya): master_templates table
- Table 5 (Charith Kaushalya): education table
- Table 6 (Charith Kaushalya): projects table 
- Table 7 (Ravidu Wijesekara): user_references table
- Table 8 (Ravidu Wijesekara): contact_messages table

## ER Diagram of the Database

![Jravich_DB_ERD](https://github.com/user-attachments/assets/d2cc513a-91b1-460b-bad6-439a0e79610b)

---

## Created Forms

The list of the forms that has been created as a part of the JRAVICH Student Portfolio Builder Project are stated below and described.

### Form 1 (Janaka Alwis): Sign Up
The sign up form collects basic information to create a user account, including the user's first name, last name, email address, and password.

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to First Name, Last Name, Email & Password.

### Form 2 (Janaka Alwis): Login
The login form utilizes the email address and password provided during the sign-up process to authenticate the user and grant access to their account. This ensures secure access to the user's personalized profile and data.

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to Email & Password.

### Form 3 (Janaka Alwis): Personal Information
The Personal Information form provides logged-in users with the ability to update various details associated with their account, such as their First Name, Last Name, City, Country, Zip Code, Phone Number, Profile Image, and LinkedIn URL. However, the Email Address cannot be modified because it serves as the unique identifier for the user account and is typically tied to the user’s ID.

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to First Name, Last Name, City, Country, Zip Code, Phone Number, Profile Image, and LinkedIn URL.

### Form 4 (Janaka Alwis): Experience
The Experience form provides logged-in users with the ability to update various details associated with their account, such as their Job Title, Employer, Job Description, Start Date, End Date & City. 

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to Title, Employer, Job Description, Start Date, End Date & City.
 
### Form 5 (Vindya Nukulasooriya): Skills
The Skills form provides logged-in users with the ability to update various skills details associated with their account, such as the skill name and skill level. 

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to skill name & skill level.

### Form 6 (Charith Kaushalya): Education
The Education form provides logged-in users with the ability to update various details associated with their education background, such as the Institution, Field of Study, Qualification, Graduation Year & Description. 

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to Institution, Field of Study, Qualification, Graduation Year & Description.

### Form 7 (Charith Kaushalya): Projects
The Projects form provides logged-in users with the ability to update various details associated with their completed projects, such as the Project Name, Project Link & Project Description. 

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to Project Name, Project Link & Project Description.

### Form 8 (Ravidu Wijesekara): References
The References form provides logged-in users with the ability to update their references details, such as the Reference Name, Email, Contact & Designation. 

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to Reference Name, Email, Contact & Designation.

### Form 9 (Ravidu Wijesekara): Get in Touch
The Get in Touch form provides logged-in users & guest users with the ability to send their contact information including Name, Email & Message. 

Link to the related code file (github) | Link to the form (shell.hamk.fi). | Validations Applied to Name, Email & Message.

---

## Created Tables

The list of the tables that has been created as a part of the JRAVICH Student Portfolio Builder Project are as follows:

- Table 1 (Janaka Alwis): users table | src/personal_info.php | Link to the table (shell.hamk.fi)
- Table 2 (Janaka Alwis): experience table | src/experience.php | Link to the table (shell.hamk.fi)
- Table 3 (Vindya Nukulasooriya): skills table | src/skills.php | Link to the table (shell.hamk.fi)
- Table 4 (Vindya Nukulasooriya): master_templates table | src/templates.php | Link to the table (shell.hamk.fi)
- Table 5 (Charith Kaushalya): education table | src/education.php | Link to the table (shell.hamk.fi)
- Table 6 (Charith Kaushalya): projects table | src/projects.php | Link to the table (shell.hamk.fi)
- Table 7 (Ravidu Wijesekara): user_references table | src/references.php | Link to the table (shell.hamk.fi)
- Table 8 (Ravidu Wijesekara): contact_messages table | src/contact.php | Link to the table (shell.hamk.fi)

---




