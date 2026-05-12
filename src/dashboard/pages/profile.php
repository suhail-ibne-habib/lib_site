<?php 
    include '../header.php';
?>

    <div class="dashboard d-flex">

        <!-- Sidebar  -->
        <?php include '../sidebar.php' ?>
        <!-- Dashboard Main  -->
        <main class="dashboard-main flex-grow-1">
        
            <!-- Nav  -->
             <?php include '../nav.php' ?>

            <div class="dashboard-container p-3">
                
                <!-- Profile Header -->
                <section class="profile-header">
                    <!-- <div class="profile-avatar">
                        <img src="https://via.placeholder.com/120" alt="User Avatar">
                    </div> -->
                    <div class="profile-info">
                        <h1 class="profile-name" style="text-transform: uppercase;"><?php echo get_user_name(); ?></h1>
                        <p class="profile-role">Book Enthusiast | Literary Critic</p>
                        <p class="profile-bio">
                            Lover of timeless classics and modern literature. Always seeking hidden gems 
                            in dusty libraries and indie bookstores.
                        </p>
                    </div>
                </section>

                <!-- Profile Details -->
                <section class="profile-details">
                    <h2>Details</h2>
                    <table class="literature-table">
                        <tbody>
                            <tr>
                                <th>User Name</th>
                                <td><?php echo get_user_name(); ?></td>
                            </tr>
                            
                            <tr>
                                <th>Member Since</th>
                                <td><?php echo get_user_created_date(); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- Profile Actions -->
                <section class="profile-actions mt-4">
                    <a href="edit-profile.php" class="btn-edit">Edit Profile</a>
                    <a href="../logout.php" class="btn-delete">Log Out</a>
                </section>


            </div>
        </main>

    </div>

<?php include '../footer.php'; ?>
