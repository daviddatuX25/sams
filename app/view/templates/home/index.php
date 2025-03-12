<style>
    .parallax-section {
        background-image: url('<?=BASE_URL_PUBLIC?>/img/background/parallax.gif');
        min-height: 500px;
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background: rgba(255, 255, 255, 0.6); /* Translucent white */
        border: none;
        backdrop-filter: blur(5px); /* Blurred glass effect */
    }
    .card-body {
        color: #333; /* Dark text for readability */
    }
    .importance-section {
        background: white;
        padding: 50px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .feature-card {
        transition: 0.3s;
    }
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .icon {
        font-size: 40px;
        margin-bottom: 15px;
    }
</style>

    <!-- Parallax Section -->
    <div class="parallax-section">
    <h1 class="display-4">Welcome</h1>
</div>

<!-- Content Section -->
<div class="container py-5 text-center">
    <h1><b>S</b>tudent <b>A</b>ttendance <b>M</b>onitoring <b>S</b>ystem</h1>
    <p>
    SAMS revolutionizes school and university operations by seamlessly handling enrollments, class schedules, teacher assignments, and attendance tracking. Designed for accuracy and ease, our system ensures a smarter, more organized, and future-ready academic environment.
    </p>
</div>

<!-- Feature Parallax Section -->
<div class="parallax-section">
    <div class="container py-5">
        <h2 class="text-center text-white mb-4">Key Features of SAMS</h2>
        <div class="row">
            <!-- Feature 1 -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-tachometer-alt fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">User-Friendly Dashboard</h5>
                        <p class="card-text">Easily access and manage all system features in one place.</p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-bell fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Real-Time Notifications</h5>
                        <p class="card-text">Get instant updates on attendance, schedule changes, and system alerts.</p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-shield fa-3x text-warning mb-3"></i>
                        <h5 class="card-title">Role-Based Access Control</h5>
                        <p class="card-text">Securely assign different permissions for students, teachers, and admins.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Feature 4 -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-cloud fa-3x text-info mb-3"></i>
                        <h5 class="card-title">Cloud-Based Access</h5>
                        <p class="card-text">Manage student data securely from anywhere, anytime.</p>
                    </div>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-mobile-alt fa-3x text-danger mb-3"></i>
                        <h5 class="card-title">Mobile Compatibility</h5>
                        <p class="card-text">Seamlessly access the system on desktop, tablet, and mobile devices.</p>
                    </div>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="col-md-4">
                <div class="card feature-card shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-lock fa-3x text-secondary mb-3"></i>
                        <h5 class="card-title">Data Security & Privacy</h5>
                        <p class="card-text">Ensure data protection with encryption and secure authentication.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Content Section -->
<div class="container py-5">
        <!-- Section Title -->
    <div class="text-center mb-4">
        <h2 class="text-primary">Empowering Education Through Efficient Management</h2>
        <p class="text-muted">Why the Student Attendance and Management System (SAMS) is Essential</p>
    </div>

    <!-- Content Section -->
    <div class="importance-section">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-success">Why is SAMS Important?</h4>
                <p class="text-muted">
                    In today’s fast-paced educational environment, managing student attendance, enrollments, and class schedules is crucial. 
                    The **Student Attendance and Management System (SAMS)** simplifies and automates these tasks, ensuring accuracy and efficiency.  
                </p>
                <p class="text-muted">
                    By implementing SAMS, institutions can **increase efficiency, reduce errors, and enhance student engagement**, 
                    creating a **more effective and organized learning environment**.
                </p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <!-- Feature 1 -->
                    <div class="col-md-6 mb-4">
                        <div class="card text-center feature-card">
                            <div class="card-body">
                                <i class="fas fa-user-check text-success icon"></i>
                                <h6>Accurate Attendance Tracking</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="col-md-6 mb-4">
                        <div class="card text-center feature-card">
                            <div class="card-body">
                                <i class="fas fa-user-plus text-primary icon"></i>
                                <h6>Efficient Enrollment</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="col-md-6 mb-4">
                        <div class="card text-center feature-card">
                            <div class="card-body">
                                <i class="fas fa-calendar-alt text-warning icon"></i>
                                <h6>Optimized Class Scheduling</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 4 -->
                    <div class="col-md-6 mb-4">
                        <div class="card text-center feature-card">
                            <div class="card-body">
                                <i class="fas fa-file-alt text-info icon"></i>
                                <h6>Data-Driven Insights</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 5 -->
                    <div class="col-md-6 mb-4">
                        <div class="card text-center feature-card">
                            <div class="card-body">
                                <i class="fas fa-tachometer-alt text-danger icon"></i>
                                <h6>Improved Efficiency</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 6 -->
                    <div class="col-md-6 mb-4">
                        <div class="card text-center feature-card">
                            <div class="card-body">
                                <i class="fas fa-chalkboard-teacher text-secondary icon"></i>
                                <h6>Enhanced Teacher Assignments</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="alert alert-info text-center" role="alert">
        <h4 class="alert-heading">🚀 Ongoing Development</h4>
        <p>
            The <strong>Student Attendance Monitoring System (SAMS)</strong> is actively evolving. 
            <br><b>This version</b> is focused on an <strong>admin-dashboard functionalities</strong> for making insights in attendance records, student and class metrics - integrating basic functionality of students enrollment, teacher assignment, attendance management, and so on. 
        </p>
        <p>Future updates will bring key functionalities like seemless and realtime attendance recording, customized class attendance optimization configuration, and more.</p>
        <hr>
        <a href="#" class="btn btn-primary">View Project Updates</a>
    </div>
</div>