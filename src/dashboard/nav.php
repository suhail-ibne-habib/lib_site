<?php ?>

<div class="dashboard-main-nav">
    <nav class="p-3">
        <ul class="d-flex justify-content-between align-items-center list-unstyled">
            <li>
                <a href="#" class="hamburger" aria-label="Open menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect y="4" width="24" height="2" rx="1" fill="currentColor"/>
                        <rect y="11" width="24" height="2" rx="1" fill="currentColor"/>
                        <rect y="18" width="24" height="2" rx="1" fill="currentColor"/>
                    </svg>
                </a>
            </li>
            
            <li>
                <a href="<?php echo $BASE_URL; ?>src/dashboard/pages/profile.php" style="display: flex; align-items: center;">
                    <span style="margin-right: 10px; font-weight: 500;"><?php echo get_user_name(); ?></span>
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                </a>
            </li>
        </ul>
    </nav>
</div>
