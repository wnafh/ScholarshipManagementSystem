# 📚 Scholara - Scholarship Management System

## System Overview

Scholara is a comprehensive scholarship management platform that automates and streamlines the entire scholarship process. The system connects three key user roles—students, reviewers, and administrators—providing each with tailored tools to efficiently manage scholarship applications from submission to final decision.

## Core Purpose

The system eliminates manual paperwork, reduces administrative overhead, ensures transparent evaluation, and provides real-time tracking for all stakeholders. It serves as a centralized hub where scholarships are created, applications are submitted, evaluations are conducted, and final awards are distributed.

## User Roles & Responsibilities

### 🎓 Students
Students are the primary applicants who seek financial aid for their education.

**Student Capabilities:**
- Browse and search available scholarships by title, category, or description
- View detailed scholarship information including amount, deadline, and requirements
- Submit applications with required documents (transcripts, recommendation letters, supporting documents)
- Write and submit personal statements
- Track application status in real-time (pending → assigned → reviewed → approved/rejected)
- View final results and reviewer feedback
- Manage personal profile information

### 📝 Reviewers
Reviewers are subject matter experts who evaluate applications based on established criteria.

**Reviewer Capabilities:**
- View applications assigned by administrators
- Evaluate applications using a weighted scoring rubric:
  - Academic Performance: 40%
  - Personal Statement: 30%
  - Extracurricular Activities: 20%
  - Recommendations: 10%
- Provide detailed feedback and comments for each application
- Submit recommendation (Approve or Reject)
- Track completed vs. pending reviews
- Update professional profile information

**Reviewer Approval Process:**
Reviewers must register and be approved by an administrator before they can access any applications. Administrators review their credentials, including resume and proof of expertise, before granting approval.

### 👑 Administrators
Administrators have full system control and oversee all operations.

**Administrator Capabilities:**

**Scholarship Management:**
- Create new scholarships with title, category, amount, dates, and description
- Edit existing scholarship details
- Publish, draft, or close scholarships
- Delete scholarships (with consideration for existing applications)

**Reviewer Management:**
- View all registered reviewers
- Approve or reject reviewer applications after reviewing credentials
- Edit reviewer information
- Delete reviewer accounts

**Student Management:**
- View all registered students
- Edit student information
- Delete student accounts

**Application Management:**
- View all applications with filtering by status
- Assign pending applications to approved reviewers
- Make final approval or rejection decisions after reviewer evaluation
- View complete application details including documents and evaluation scores

**Reporting:**
Generate comprehensive reports in four categories:
- **Students Report:** List of all students with their application counts
- **Scholarships Report:** Scholarship details with number of applicants
- **Reviewers Report:** Reviewer information with number of reviews completed
- **Overall Report:** System-wide statistics including total students, reviewers, scholarships, applications, approved applications, and total funding amount

## Core Processes

### Application Submission Process
1. Student browses available scholarships
2. Student selects a scholarship and clicks "Apply"
3. Student writes a personal statement (minimum 300 words)
4. Student uploads required documents:
   - Report Card / Transcript
   - Recommendation Letter / Good Moral Character
   - Supporting documents (Residency, Indigency, ITR, ID picture, etc.)
5. Student submits the application
6. System generates unique Application ID (APP001 format)
7. Application status set to "pending"

### Evaluation Process
1. Administrator reviews pending applications
2. Administrator assigns application to an approved reviewer
3. Application status changes to "assigned"
4. Reviewer receives access to the application
5. Reviewer evaluates each criterion and enters scores (0-100)
6. System automatically calculates weighted total score
7. Reviewer provides feedback and recommendation
8. Application status changes to "reviewed"

### Decision Process
1. Administrator reviews the completed evaluation
2. Administrator makes final decision:
   - Approve: Scholarship awarded
   - Reject: Application denied
3. Application status updates to "approved" or "rejected"
4. Student can view the decision and feedback

## Technical Architecture

### Scoring Calculation
The system automatically calculates the total score using weighted percentages:

Each criterion is scored from 0-100. The final score is stored in the database and displayed to both the reviewer and administrator.

### Document Management
All uploaded documents are stored in the Laravel filesystem with public disk access. Document types accepted:
- PDF files
- JPG/JPEG images
- PNG images
- Maximum file size: 5MB per file
- Multiple files allowed for supporting documents

### Application Status Flow

Each status change is tracked with timestamps:
- `applied_date`: When student submits
- `reviewed_date`: When reviewer completes evaluation
- `evaluated_at`: When evaluation scores are saved
- `updated_at`: When final decision is made

## Database Relationships

- **Users** have many **Applications** (as student)
- **Users** have many **Applications** (as reviewer)
- **Users** have one **ReviewerProfile**
- **Scholarships** have many **Applications**
- **Applications** belong to one **Student** (User)
- **Applications** belong to one **Scholarship**
- **Applications** belong to one **Reviewer** (User)

## Security Features

- Role-based middleware protection on all routes
- File type and size validation
- SQL injection prevention (Eloquent ORM)
- CSRF protection on all forms
- XSS prevention through Blade escaping
- Secure password hashing (bcrypt)
- Authentication required for all dashboard access

## Report Generation Details

### Students Report
Displays: Name, Email, Education Level, Number of Applications Submitted

### Scholarships Report
Displays: Title, Amount, Deadline, Number of Applications, Status

### Reviewers Report
Displays: Name, Email, Occupation, Number of Reviews Completed, Approval Status

### Overall Report
Displays: Total Students, Total Reviewers, Total Scholarships, Total Applications, Approved Applications, Total Funding Amount

## Default Scholarship Requirements

Every scholarship includes these default required documents (cannot be modified by administrators):
1. Report Card / TOR
2. ALS Accreditation & Equivalency (if applicable)
3. Certificate of Residency (Original)
4. Certificate of Good Moral Character (Photocopy)
5. Certificate of Indigency or Eligibility (Original)
6. ITR of both parents or Certificate of Tax Exemption (Photocopy)
7. 2x2 I.D. picture

## Business Rules

1. Only approved reviewers can be assigned to applications
2. Students cannot apply for the same scholarship twice
3. Scholarships must have end dates after start dates
4. Personal statements must be at least 300 words
5. All documents are required before submission
6. Only published scholarships appear to students
7. Expired scholarships (end_date past) do not appear in browse results
8. Administrators cannot be deleted if they are the only admin
9. Reviewer profiles must be approved before assignment
10. Final decisions (approve/reject) cannot be changed after submission

## User Interface Features

- Responsive design compatible with desktop, tablet, and mobile devices
- Role-specific layouts and navigation menus
- Status badges with color coding for quick visual reference
- File preview links for uploaded documents
- Print functionality for reports
- Search and filter capabilities on all management pages
- Form validation with user-friendly error messages
- Success/error notifications after actions

## System Requirements

- PHP 8.2 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Web server (Apache/Nginx) or Laravel development server
- 256MB minimum RAM
- 100MB storage for application (plus document storage space)

## Installation Overview

1. Clone repository
2. Install PHP dependencies via Composer
3. Install Node dependencies via NPM
4. Configure environment file with database credentials
5. Run database migrations
6. Create storage symbolic link
7. Compile frontend assets
8. Create admin user via Tinker
9. Start the development server

## Support & Maintenance

The system is designed for easy maintenance with:
- Modular controller structure for each user role
- Separate migration files for each database change
- Configuration-driven scoring weights
- Extensible model relationships
- Clean separation of concerns following MVC pattern

---

**Built to make education accessible for everyone**
