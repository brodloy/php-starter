<?php
/**
 * DASHBOARD — the first page after signing in. Uses the 'app' layout (sidebar).
 */
class DashboardController
{
    public function index(): string
    {
        require_login(); // guests get bounced to /login

        $user = current_user();

        // Count how many examples belong to this user (note the ownership filter).
        $row = db()->first(
            'SELECT COUNT(*) AS c FROM `Example` WHERE `FK_UserID` = ?',
            [$user['PK_UserID']],
        );

        return view('dashboard', [
            'title'        => 'Dashboard',
            'user'         => $user,
            'exampleCount' => (int) ($row['c'] ?? 0),
        ], 'app');
    }
}
