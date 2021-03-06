<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Strategy\ChefSalary;
use App\Services\Strategy\ManagerSalary;
use App\Services\Strategy\WaiterSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use App\Services\Strategy\Context;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = Http::get('http://127.0.0.1:8001/api/user');
        return view('users.index', ['users' => json_decode($users)]);
//        $users = User::all();
//        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        //$input = $request->all();
        $request->validate([
            'icNumber' => 'unique:users|regex:/^\d{6}-\d{2}-\d{4}$/',
            'name' => "regex:/^[a-zA-Z-'\s]+$/",
            'password' => "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",
            'mobile' => "regex:/^\d{3}-\d{7,9}$/",
            'email' => "email"
        ]);

        $password = Hash::make($request->input('password'));

        $user = User::create([
            'icNumber' => $request->input('icNumber'),
            'name' => $request->input('name'),
            'role' => $request->input('role'),
            'password' => $password,
            'gender' => $request->input('gender'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'birthday' => $request->input('birthday'),
            'address' => $request->input('address')
        ]);
//        $user = Http::post('http://127.0.0.1:8001/api/addUser', [
//            'icNumber' => $request->icNumber,
//            'name' => $request->name,
//            'role' => $request->role,
//            'password' => $password,
//            'gender' => $request->gender,
//            'mobile' => $request->mobile,
//            'email' => $request->email,
//            'birthday' => $request->birthday,
//            'address' => $request->address
//        ]);
//        $user->assignRole($request->input('role'));

//        $ic = $request->input('icNumber');
        $this->newXml();
        return redirect()->route('users.index');
    }

    public function display()
    {
        $xml = file_get_contents('D:\Program Files\Xampp\htdocs\restaurantpos\public\xml\user_info.xml');
        $data = simplexml_load_string($xml);

        $json = json_encode($data);
        $array = json_decode($json, true);
        $array = $array['user'];

        return view('users.display')->with('data', $data)->with('array', $array)/*->with('ic', $ic)->with('name', $name)->with('role', $role)*/ ;
    }

    public function sort()
    {
        $this->newXml();
        $xml = new \DOMDocument();
        $xml->load('xml/user_info.xml');

        $xsl = new \DOMDocument();
        $xsl->load('xml/user_info.xslt');

        $proc = new \XSLTProcessor();
        $proc->importStylesheet($xsl);
        $x = $proc->transformToXml($xml);
        return view('users.search')->with('x', $x);
    }

    public function newXml()
    {
        $path = 'public/xml/user_info.xml';
        if (file_exists($path)) {
            unlink($path);
        } else {
//            $results = User::all();
            $results = Http::get('http://127.0.0.1:8001/api/user');
            $data = json_decode($results);
            $xml = new \DOMDocument('1.0');
            $xml->formatOutput = true;

            $users = $xml->createElement('users');
            $xml->appendChild($users);

            foreach ($data as $row) {
                $user = $xml->createElement("user");
                $users->appendChild($user);

                $ic = $xml->createElement("ic", $row->icNumber);
                $user->appendChild($ic);

                $name = $xml->createElement("name", $row->name);
                $user->appendChild($name);

                $role = $xml->createElement("role", $row->role);
                $user->appendChild($role);

                $gender = $xml->createElement("gender", $row->gender);
                $user->appendChild($gender);

                $mobile = $xml->createElement("mobile", $row->mobile);
                $user->appendChild($mobile);

                $email = $xml->createElement("email", $row->email);
                $user->appendChild($email);

                $birthday = $xml->createElement("birthday", $row->birthday);
                $user->appendChild($birthday);

                $address = $xml->createElement("address", $row->address);
                $user->appendChild($address);

                $dateRegistered = $xml->createElement("dateRegistered", substr($row->created_at, 0, 10));
                $user->appendChild($dateRegistered);
            }

            $xml->saveXML();
            $xml->save("xml/user_info.xml") or die("Unable to create xml");
        }
    }

    public function show($id)
    {
        $user = Http::get('http://127.0.0.1:8001/api/user/' . $id);
        return view('users.show', ['user' => json_decode($user)]);
//        $user = User::find($id);
//        return view('users.show')->with('users', $user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'role', 'userRole'))->with('users', $user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $base = $request->input('base');
        $overTime = $request->input('overTime');
        $bonusRate = $request->input('bonusRate');
        $deduction = $request->input('deduction');
        $role = $request->input('role');
        if ($role != "Admin") {
            if (!empty($base) or !empty($overTime) or !empty($bonusRate) or !empty($deduction)) {
                if (empty($base)) {
                    $base = 0;
                };
                if (empty($overTime)) {
                    $overTime = 0;
                };
                if (empty($bonusRate)) {
                    $bonusRate = 0;
                };
                if (empty($deduction)) {
                    $deduction = 0;
                };
                $salary = $this->defineStrategy($role, $base, $overTime, $bonusRate, $deduction);
                $user->update(array('salary' => $salary));
            }
        }
        $input = $request->all();
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('role'));
        $this->newXml();
        return redirect('users')->with('flash_message', 'User Updated!');
    }

    public function defineStrategy($role, $base, $overTime, $bonusRate, $deduction): float
    {
        switch ($role) {
            case "Manager":
                $strategy = new ManagerSalary();
                break;
            case "Chef":
                $strategy = new ChefSalary();
                break;
            case "Waiter":
                $strategy = new WaiterSalary();
                break;
            default:
                throw new \Exception('Strategy not found for this category.');
        }

        $context = new Context($strategy);
        return $context->execute($base, $overTime, $bonusRate, $deduction);
    }

    public function destroy($id)
    {
//        User::destroy($id);
        $user = Http::delete('http://127.0.0.1:8001/api/deleteUser/'. $id);
        $this->newXml();
        return redirect()->route('users.index');
    }

}
