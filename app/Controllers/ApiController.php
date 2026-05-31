<?php
/**
 * API — a tiny JSON example. The json() helper sets the header, encodes, and
 * stops. These endpoints are authenticated by the normal session cookie, so
 * they work for your own front-end calls (fetch) on the same site.
 *
 * For a PUBLIC API consumed by other apps you'd add token authentication
 * (e.g. an "API key" header checked here) — that's the natural next step, but
 * it's deliberately left out to keep this small.
 */
class ApiController
{
    /** GET /api/examples — the current user's examples as JSON. */
    public function examples(): never
    {
        if (!auth()->check()) {
            json(['error' => 'Not authenticated'], 401);
        }

        $rows = db()->all(
            'SELECT `PK_ExampleID` AS id, `Title` AS title, `Status` AS status, `CreatedAt` AS created_at
             FROM `Example` WHERE `FK_UserID` = ? ORDER BY `CreatedAt` DESC',
            [current_user()['PK_UserID']],
        );

        json(['data' => $rows]);
    }
}
