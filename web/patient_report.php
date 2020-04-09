<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <link rel="stylesheet" href="/stylesheets/patient_report.css">
</head>
<body>
    <header>
        <ul>
            <li>
                <a href="home.html" class="active">Home</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="faq.xml">FAQ's</a>
            </li>
            <li>
                <a href="about.html">About</a>
            </li>
        </ul>
        <button onclick="document.location.href='logout.jsp'">Logout</button>
    </header>
    <section class="container">
        <section class="navigation" style="display: none;"></section>
        <section class="content-holder">
            <section class="ps-card">
                <figure class="ps-profile-image">
                    <img src="https://media.istockphoto.com/vectors/male-patient-profile-icon-with-circle-shape-flat-style-vector-eps-vector-id1125731438"
                    height="100px"
                    width="90px"
                    alt="Image">
                </figure>
                <section class="ps-info">
                    <section class="ps-info-block">
                        <section class="ps-label">Name</section>
                        <section class="ps-name">Chinmay Joshi</section>
                    </section>
                    <section class="ps-info-block">
                        <section class="ps-label">Gender</section>
                        <section class="ps-name">Male</section>
                    </section>
                    <section class="ps-info-block">
                        <section class="ps-label">Age</section>
                        <section class="ps-name">18 Years 3 Months</section>
                    </section>
                    <section class="ps-info-block">
                        <section class="ps-label">Contact</section>
                        <section class="ps-name">8938479379</section>
                    </section>
                </section>
            </section>

            <nav>
                <button class="tab-links" id="history" onclick="onTabChange('history')">History</button>
                <button class="tab-links active-tab" id="general" onclick="onTabChange('general')">General</button>
                <button class="tab-links" id="medications" onclick="onTabChange('medications')">Medications</button>
                <button class="tab-links" id="appointments" onclick="onTabChange('appointments')">Appointments</button>
                <button class="tab-links" id="visits" onclick="onTabChange('visits')">Visits</button>
            </nav>

            <section class="tab-content history">
                <iframe id="content-frame"
                    onload="iframeLoaded()"></iframe>
            </section>
        </section>
    </section>
    <footer>
        <br/>
        <p>Copyright ©2020 Healthcare portal. All right reserved.</p>
    </footer>
    <script src="/scripts/patient_report.js"></script>
</body>
</html>