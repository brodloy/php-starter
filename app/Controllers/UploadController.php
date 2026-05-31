<?php
/**
 * UPLOADS — a small but complete, SAFE file-upload feature, and a good pattern
 * to copy. The security points:
 *   - files are stored OUTSIDE public/ (in storage/uploads), so they can never
 *     be fetched by guessing a URL;
 *   - store_upload() validates size + extension and saves under a random name;
 *   - downloads go through download() here, which checks the file belongs to
 *     the current user before streaming it.
 */
class UploadController
{
    /** GET /uploads — list this user's files. */
    public function index(): string
    {
        require_login();

        $rows = db()->all(
            'SELECT * FROM `Upload` WHERE `FK_UserID` = ? ORDER BY `CreatedAt` DESC',
            [current_user()['PK_UserID']],
        );

        return view('uploads/index', ['title' => 'Files', 'rows' => $rows], 'app');
    }

    /** POST /uploads — store an uploaded file. */
    public function store(): string
    {
        require_login();

        try {
            $info = store_upload($_FILES['file'] ?? []);
        } catch (RuntimeException $e) {
            return redirect_with('/uploads', 'error', $e->getMessage());
        }

        db()->insert('Upload', [
            'FK_UserID'    => current_user()['PK_UserID'],
            'StoredName'   => $info['stored'],
            'OriginalName' => $info['original'],
            'Mime'         => $info['mime'],
            'Size'         => $info['size'],
            'CreatedAt'    => gmdate('Y-m-d H:i:s'),
        ]);

        return redirect_with('/uploads', 'success', 'File uploaded.');
    }

    /** GET /uploads/{id} — stream a file the user owns (never a direct URL). */
    public function download(string $id): string
    {
        require_login();
        $file = $this->findOwned((int) $id);

        $path = upload_dir() . '/' . $file['StoredName'];
        if (!is_file($path)) {
            abort(404, 'File missing.');
        }

        header('Content-Type: ' . $file['Mime']);
        header('Content-Length: ' . $file['Size']);
        header('Content-Disposition: attachment; filename="' . str_replace('"', '', $file['OriginalName']) . '"');
        readfile($path);
        exit;
    }

    /** POST /uploads/{id}/delete — remove a file the user owns. */
    public function destroy(string $id): string
    {
        require_login();
        $file = $this->findOwned((int) $id);

        @unlink(upload_dir() . '/' . $file['StoredName']);
        db()->run('DELETE FROM `Upload` WHERE `PK_UploadID` = ? AND `FK_UserID` = ?',
            [$file['PK_UploadID'], current_user()['PK_UserID']]);

        return redirect_with('/uploads', 'success', 'File deleted.');
    }

    private function findOwned(int $id): array
    {
        $file = db()->first(
            'SELECT * FROM `Upload` WHERE `PK_UploadID` = ? AND `FK_UserID` = ?',
            [$id, current_user()['PK_UserID']],
        );
        if ($file === null) {
            abort(404, 'Not found.');
        }
        return $file;
    }
}
