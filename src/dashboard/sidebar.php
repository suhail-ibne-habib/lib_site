<aside class="dashboard-sidebar p-3">
    <h2 class="dashboard-heading">
        <a href="<?php echo $BASE_URL; ?>src/pages" class="home-link" aria-label="Go to Home">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5 6.414V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V9.707l5-5 5 5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6 6a1 1 0 0 1-1.414 1.414L8 3.914 2.707 8.914A1 1 0 0 1 1.293 7.5l6-6z"/>
        </svg>
        </a>
        Dashboard Menu
    </h2>

    <ul class="list-unstyled">
        
        <li>
            <span>Manage Books</span>
            <ul class="list-unstyled pl-3">
                <li><a href="<?php echo $BASE_URL; ?>src/dashboard/pages/books/create-book.php">Create Book</a></li>
                <li><a href="<?php echo $BASE_URL; ?>src/dashboard/pages/books/view-books.php">View Books</a></li>
            </ul>
        </li>
        <li>
            <span>User Accounts</span>
            <ul class="list-unstyled pl-3">
                <li><a href="<?php echo $BASE_URL; ?>src/dashboard/pages/users/create-user.php">Create User</a></li>
                <li><a href="<?php echo $BASE_URL; ?>src/dashboard/pages/users/view-users.php">View Users</a></li>
            </ul>
        </li>
        <li>
            <span>Student Accounts</span>
            <ul class="list-unstyled pl-3">
                <li><a href="<?php echo $BASE_URL; ?>src/dashboard/pages/students/create-student.php">Create Student</a></li>
                <li><a href="<?php echo $BASE_URL; ?>src/dashboard/pages/students/view-students.php">View Students</a></li>
            </ul>
        </li>
        <li>
            <span>Borrow History</span>
            <ul class="list-unstyled pl-3">
                <li><a href="<?php echo $BASE_URL; ?>src/dashboard/pages/borrows/view-borrows.php">Manage Borrows</a></li>
            </ul>
        </li>
        
    </ul>
</aside>
