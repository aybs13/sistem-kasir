<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Cek login wajib (kecuali controller Auth)
        if (!session()->get('logged_in') && service('router')->controllerName() !== 'Auth') {
            return redirect()->to('/login');
        }
    }

    protected function isAdmin()
    {
        return session()->get('role') === 'admin';
    }

    protected function isKasir()
    {
        return session()->get('role') === 'kasir';
    }
}
