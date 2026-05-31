<?php
/**
 * EXAMPLE CONTROLLER — a complete CRUD section. THIS is the file you copy to
 * build your own (Widgets, Notes, Projects, whatever).
 *
 * Two things to notice, because they're the whole security story for a section:
 *
 *  1. Every query is scoped to the logged-in user:  WHERE `FK_UserID` = ?
 *     So even if someone types /examples/999 for a row that isn't theirs, the
 *     query returns nothing and they get a 404. That's IDOR protection, and
 *     it's just a visible WHERE clause — no magic.
 *
 *  2. require_login() sits at the top of every method here.
 *
 * To make your own section: copy this file, rename the class + table + columns,
 * add routes in routes.php, and copy the views in views/examples/.
 */
class ExampleController
{
    /** GET /examples — list this user's examples (newest first), paginated. */
    public function index(): string
    {
        require_login();

        $page = max(1, (int) input('page', '1'));
        $result = db()->paginate(
            'Example',
            'WHERE `FK_UserID` = ?',
            [current_user()['PK_UserID']],
            $page,
            10,
            'ORDER BY `CreatedAt` DESC',
        );

        return view('examples/index', ['title' => 'Examples', 'result' => $result], 'app');
    }

    /** GET /examples/{id} — show one, but only if it belongs to this user. */
    public function show(string $id): string
    {
        require_login();
        $example = $this->findOwned((int) $id);

        return view('examples/show', ['title' => $example['Title'], 'example' => $example], 'app');
    }

    /** GET /examples/create — the new-example form. */
    public function create(): string
    {
        require_login();
        return view('examples/form', ['title' => 'New example', 'example' => null], 'app');
    }

    /** POST /examples — save a new example owned by this user. */
    public function store(): string
    {
        require_login();

        $title = input('title');
        $body  = input('body');

        if ($title === '') {
            return redirect_errors('/examples/create', ['title' => 'Title is required.'],
                ['title' => $title, 'body' => $body]);
        }

        db()->insert('Example', [
            'FK_UserID' => current_user()['PK_UserID'],
            'Title'     => $title,
            'Body'      => $body,
            'Status'    => 'active',
            'CreatedAt' => gmdate('Y-m-d H:i:s'),
            'UpdatedAt' => gmdate('Y-m-d H:i:s'),
        ]);

        return redirect_with('/examples', 'success', 'Example created.');
    }

    /** GET /examples/{id}/edit — the edit form (ownership checked). */
    public function edit(string $id): string
    {
        require_login();
        $example = $this->findOwned((int) $id);

        return view('examples/form', ['title' => 'Edit example', 'example' => $example], 'app');
    }

    /** POST /examples/{id} — save edits (ownership checked). */
    public function update(string $id): string
    {
        require_login();
        $example = $this->findOwned((int) $id);

        $title = input('title');
        $body  = input('body');
        $status = input('status') === 'archived' ? 'archived' : 'active';

        if ($title === '') {
            return redirect_errors('/examples/' . $example['PK_ExampleID'] . '/edit',
                ['title' => 'Title is required.'], ['title' => $title, 'body' => $body]);
        }

        db()->run(
            'UPDATE `Example` SET `Title` = ?, `Body` = ?, `Status` = ?, `UpdatedAt` = ?
             WHERE `PK_ExampleID` = ? AND `FK_UserID` = ?',
            [$title, $body, $status, gmdate('Y-m-d H:i:s'),
             $example['PK_ExampleID'], current_user()['PK_UserID']],
        );

        return redirect_with('/examples/' . $example['PK_ExampleID'], 'success', 'Saved.');
    }

    /** POST /examples/{id}/delete — delete (ownership checked). */
    public function destroy(string $id): string
    {
        require_login();
        $example = $this->findOwned((int) $id);

        db()->run(
            'DELETE FROM `Example` WHERE `PK_ExampleID` = ? AND `FK_UserID` = ?',
            [$example['PK_ExampleID'], current_user()['PK_UserID']],
        );

        return redirect_with('/examples', 'success', 'Example deleted.');
    }

    /**
     * Find an example by id that belongs to the current user, or 404.
     * Every read/write above goes through this, so you can't touch other
     * people's rows even by guessing ids.
     */
    private function findOwned(int $id): array
    {
        $example = db()->first(
            'SELECT * FROM `Example` WHERE `PK_ExampleID` = ? AND `FK_UserID` = ?',
            [$id, current_user()['PK_UserID']],
        );

        if ($example === null) {
            http_response_code(404);
            exit(view('errors/404', ['title' => 'Not found']));
        }

        return $example;
    }
}
