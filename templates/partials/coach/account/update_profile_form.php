<div id="panel-1" class="panel">
    <div class="panel-hdr">
        <h2>Your Profile</h2>
    </div>
    <div class="panel-container show">
        <div class="panel-content">
            <div class="panel-tag">
                Please fill out the form below to update your profile information. Ensure all fields are accurate and up-to-date to maintain your account details.
            </div>
            <form>
                <h3>Personal Information</h3>
                <div class="form-group">
                    <label class="form-label" for="profile-picture">Profile Picture</label>
                    <input type="file" id="profile-picture" name="profile_picture" class="form-control-file">
                </div>
                <div class="form-group">
                    <label class="form-label" for="coach-name">Name</label>
                    <input type="text" id="coach-name" name="coach_name" class="form-control" placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone-number">Phone Number</label>
                    <input type="tel" id="phone-number" name="phone_number" class="form-control" placeholder="Enter your phone number">
                </div>
                <div class="form-group">
                    <label class="form-label" for="bio">Bio</label>
                    <textarea id="bio" name="bio" class="form-control" rows="5" placeholder="Write a short bio about yourself"></textarea>
                </div>

                <h3>Account Security</h3>
                <div class="form-group">
                    <label class="form-label" for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current-password" class="form-control" placeholder="Enter your current password">
                </div>
                <div class="form-group">
                    <label class="form-label" for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new-password" class="form-control" placeholder="Enter a new password">
                </div>

                <h3>Professional Details</h3>
                <div class="form-group">
                    <label class="form-label" for="team-name">Team Name</label>
                    <input type="text" id="team-name" name="team_name" class="form-control" placeholder="Enter your team name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="experience">Coaching Experience (Years)</label>
                    <input type="number" id="experience" name="experience" class="form-control" placeholder="Enter your years of experience">
                </div>
                <div class="form-group">
                    <label class="form-label" for="specialization">Specialization</label>
                    <select id="specialization" name="specialization" class="form-control">
                        <option value="head-coach">Head Coach</option>
                        <option value="offense">Offense</option>
                        <option value="defense">Defense</option>
                        <option value="special-teams">Special Teams</option>
                    </select>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>