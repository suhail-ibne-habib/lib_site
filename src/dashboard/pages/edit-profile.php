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
                
                <!-- Page Header -->
                <section class="page-header">
                    <h1>Edit Profile</h1>
                    <p>Update your personal information below.</p>
                </section>

                <!-- Edit Profile Form -->
                <section class="profile-form">
                    <form action="/update-profile" method="POST">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="Jane Doe" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="jane.doe@example.com" required>
                        </div>

                        <!-- Bio -->
                        <div class="form-group">
                            <label for="bio">Short Bio</label>
                            <textarea id="bio" name="bio" rows="4">Lover of timeless classics and modern literature.</textarea>
                        </div>

                        <!-- Favorite Genre -->
                        <div class="form-group">
                            <label for="genre">Favorite Genre</label>
                            <select id="genre" name="genre">
                                <option>Historical Fiction</option>
                                <option>Fantasy</option>
                                <option>Classics</option>
                                <option>Poetry</option>
                                <option>Non-fiction</option>
                            </select>
                        </div>

                        <!-- Currently Reading -->
                        <div class="form-group">
                            <label for="current">Currently Reading</label>
                            <input type="text" id="current" name="current" value="Pride and Prejudice by Jane Austen">
                        </div>

                        <!-- Buttons -->
                        <div class="form-actions">
                            <button type="submit" class="btn-edit">Save Changes</button>
                            <a href="profile.php" class="btn-delete">Cancel</a>
                        </div>
                    </form>
                </section>

            </div>
        </main>

    </div>

<?php include '../footer.php'; ?>
