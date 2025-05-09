<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="../css/messages.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
        <img src="../images/134216_menu_lines_hamburger_icon.png" class="menu">
        <h2 class="sidebarh2">Prodify.</h2>
        <div class="sidebar-header">
            <img src="../images/9055226_bxs_dashboard_icon.png" class="dashboard">
            <img src="../images/9035967_people_sharp_icon.png" class="userni">
            <img src="../images/290138_document_extension_file_format_paper_icon.png" class="roleni">
            <img src="../images/7067453_building_office_property_icon.png" class="department">
            <img src="../images/134228_briefcase_career_business_suitcase_icon.png" class="designation">
            <img src="../images/8665306_circle_user_icon.png" class="profile1">
        </div>
        <ul>
            <li><i class="fas fa-home"></i> <a href="admin_dashboard.php">Dashboard</a></li>
            <li><i class="fas"></i> <a href="user_management.php">User Management</a></li>
            <li><i class="fas"></i> <a href="role_assignment2.php">Role Assignment</a></li>
            <li><i class="fas"></i> <a href="department_management.php">Department<br />Management</a></li>
            <li><i class="fas fa-briefcase"></i> <a href="designation_management.php">Designation<br />Management<br /></a></li>
        </ul>
        <div class="logout">
            <i class="fasfa-user-circle">@Admin</i>
            <a href="logout.php" class="logout-btn">Logout</a>
            <img src="../images/7853741_logout_kashifarif_exit_out_close_icon.png" class="loglogo">
        </div>
    </aside>

    <!-- Main Content -->
<main class="content">
    <header>
        <div class="header">
            <img src="../images/211694_bell_icon.png" class="bell" role="button" onclick="alert('Button clicked!')">
            <img src="../images/8678233_message_communication_chat_icon.png" class="message1" role="button" onclick="alert('Button clicked!')">
        </div>
    </header>

    <div class="chatbox-container">
            <div class="chatbox">
                <div id="user-list">
                    <input type="text" class="search" placeholder="🔍 Search..." aria-label="Search users" /> 
                    <div class="chat-user active" tabindex="0"><img class="chatimg" src="../images/8665306_circle_user_icon.png">John</div>
                    <div class="chat-user" tabindex="0"><img class="chatimg" src="../images/8665306_circle_user_icon.png">Jane</div>
                    <div class="chat-user" tabindex="0"><img class="chatimg" src="../images/8665306_circle_user_icon.png">Mike</div>
                    <!-- Add more users dynamically here -->
                </div>

                <div class="chat-area">
                    <div id="chat-header" aria-live="polite" aria-atomic="true"><img class="chatimg" src="../images/8665306_circle_user_icon.png">John</div>

                    <div id="chat-messages" role="log" aria-live="polite" aria-relevant="additions">
                        <div class="message left" tabindex="0">Hello!</div>
                        <div class="message right" tabindex="0">Hi there! How can I help?</div>
                        <!-- Messages from DB will go here -->
                    </div>

                    <form id="chat-form" method="post" enctype="multipart/form-data" aria-label="Send message form">
                        <label for="file-input" class="attach-label" title="Attach file">📎</label>
                        <input type="file" id="file-input" name="attachment" aria-label="Attach file" />
                        <input type="text" name="message" placeholder="Type a message..." required aria-required="true" aria-label="Message input" />
                        <button type="submit" class="send" aria-label="Send message">Send</button>
                    </form>
                </div>
            </div>
        </div>
</html>