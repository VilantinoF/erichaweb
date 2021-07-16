<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Validation\Rules;

class Auth extends BaseController
{
	protected $userModel;
	public function __construct()
	{
		$this->userModel = model('App\Models\UserModel');
		session();
	}

	public function index()
	{
		if (session('uname') != null) {
			return redirect()->to('/pages');
		}

		$data = [
			'tittle' => 'Login Page',
			'validation' => \Config\Services::validation()
		];
		return view('auth/login', $data);
	}

	public function login()
	{
		if (!$this->validate([
			'uname' => 'required|trim',
			'password' => 'required'
		])) {
			$validation = \Config\Services::validation();

			return redirect()->to('/auth')->withInput()->with('validation', $validation);
		}

		$uname = trim($this->request->getVar('uname'));
		$password = $this->request->getVar('password');
		$match = $this->userModel->where('uname', $uname)->findAll();
		if ($match) {
			if (password_verify($password, $match['0']['password'])) {
				$data = [
					'uname' => $match['0']['uname'],
					'role' => $match['0']['role']
				];

				session()->set($data);
				return redirect()->to('/pages');
			} else {
				session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah!!</div>');
				return redirect()->to('/auth');
			}
		} else {
			session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Akun tidak ditemukan. Silahkan daftar terlebih dahulu!</div>');
			return redirect()->to('/auth');
		}
	}

	public function register()
	{

		$data = [
			'tittle' => 'Register Account',
			'validation' => \Config\Services::validation()
		];

		return view('auth/register', $data);
	}

	public function saveAccount()
	{

		// form validation
		if (!$this->validate([
			'name' => 'required',
			'uname' => 'required|trim|is_unique[user.uname]',
			'role' => 'required',
			'password1' => [
				'rules' => 'required|matches[password2]',
				'errors' => [
					'required' => 'The password field is required.',
					'matches' => 'Password must be same.'
				]
			],
			'password2' => 'required|matches[password1]'
		])) {
			$validation = \Config\Services::validation();

			return redirect()->to('/auth/register')->withInput()->with('validation', $validation);
		}

		$name = $this->request->getVar('name');
		$uname  = trim(strtolower($this->request->getVar('uname')));
		$role  = $this->request->getVar('role');
		$password1  = password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT);

		$this->userModel->save([
			'name' => $name,
			'uname' => $uname,
			'role' => $role,
			'password' => $password1
		]);

		session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">Akun berhasil didaftarkan. Silahkan login!</div>');
		return redirect()->to('/auth');
	}

	public function logout()
	{
		$data = ['uname', 'role'];

		session()->remove($data);
		return redirect()->to('/auth');
	}
}
