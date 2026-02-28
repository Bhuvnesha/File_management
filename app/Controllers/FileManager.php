<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;

class FileManager extends Controller
{
    protected $uploadpath;

    public function __construct()
    {
        helper('filesytem');
        $this->uploadpath = WRITEPATH . "uploads/";
    }

    // list file
    public function index()
    {
        $type = $this->request->getGet('type');

        $files = get_dir_file_info($this->uploadpath);

        if ($type) {
            $files = array_filter($files, function ($file) use ($type) {
                return pathinfo($file['name'], PATHINFO_EXTENSION) === $type;
            });
        }

        return view('file_view', ['files' => $files]);
    }

    // delete file
    public function delete($file_name)
    {
        $session = \Config\Services::session();
        $file_path = $this->uploadpath.$file_name;
        // echo $file_path;
        if(file_exists($file_path))
        {
            unlink($file_path);
        }
        $session->setFlashdata('message',"file deleted!");
        return redirect()->to('/');
    }

    public function upload()
    {
        $validationRule = [
            'userfile' => [
                'label' => 'File',
                'rules' => 'uploaded[userfile]'
                    . '|max_size[userfile,2048]'
                    . '|ext_in[userfile,png,jpg,jpeg,pdf,docx,txt]',
            ],
        ];

        if (! $this->validate($validationRule)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('userfile');

        if ($file->isValid() && ! $file->hasMoved()) {
            $file->move($this->uploadpath);
        }

        return redirect()->to('/');
    }

    public function download($filename)
    {
        $filePath = $this->uploadpath . basename($filename);

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        }

        return redirect()->back();
    }

    public function zipBackup()
    {
        $zip = new \ZipArchive();
        $zipName = WRITEPATH . 'backup_' . date('Ymd_His') . '.zip';

        if ($zip->open($zipName, \ZipArchive::CREATE) === TRUE) {
            $files = get_filenames($this->uploadpath);

            foreach ($files as $file) {
                $zip->addFile($this->uploadpath . $file, $file);
            }

            $zip->close();
        }

        return redirect()->back();
    }

    public function analytics()
    {
        $files = get_dir_file_info($this->uploadpath);

        $totalSize = 0;
        $fileCount = count($files);

        foreach ($files as $file) {
            $totalSize += $file['size'];
        }

        $data = [
            'totalSizeMB' => round($totalSize / (1024 * 1024), 2),
            'fileCount'   => $fileCount,
            'avgSizeKB'   => $fileCount ? round(($totalSize / $fileCount) / 1024, 2) : 0,
        ];

        return view('analytics', $data);
    }


}

