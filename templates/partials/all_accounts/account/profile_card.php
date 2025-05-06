<?php
// Get role name
$role_names = [
    1 => 'League Manager',
    2 => 'Coach',
    3 => 'Statistician',
    4 => 'Player',
    5 => 'Fan'
];
$role_name = $role_names[$_SESSION['role_id']] ?? 'Unknown Role';
?>
<div class="card mb-g rounded-top">
    <div class="row no-gutters row-grid">
        <div class="col-12">
            <div class="d-flex flex-column align-items-center justify-content-center p-4">
                <img src="../img/profile-pics/default_profile.jpg" class="rounded-circle shadow-2 img-thumbnail" alt="">
                <h5 class="mb-0 fw-700 text-center mt-3">
                    <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                    <small class="text-muted mb-0"><?= htmlspecialchars($role_name) ?></small>
                </h5>
            </div>
        </div>
        <div class="col-12">
            <div class="p-3">
                <div class="fw-500 mb-1">User Information</div>
                <div class="fs-sm">
                    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                    <?php if ($user['team_id'] && $user['team_name']): ?>
                    <p><strong>Team:</strong> <?= htmlspecialchars($user['team_name']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>