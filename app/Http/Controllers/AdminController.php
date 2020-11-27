<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;

class AdminController extends Controller
{   /**
    *  Dang nhap admin
    */
    public function Login(Request $request)
    {
        //
        $admin = new AdminModel;
        $data = $admin->where('username', $request->username)->get();

        if (count($data) != 1) {
            return redirect()->route('login-admin');
        }
        foreach ($data as $data) {
            if(($request->username == $data->username) && (password_verify($request->password, $data->password)) && $data->kind != 2) {
                /**
                 *  set session khi đăng nhập thành công
                 */
                session(["admin_id" => $data->id]);
                session(["admin_name" => $data->username]);
                session(["admin_kind" => $data->kind]);

                return redirect()->route('home');
            } else {
                return redirect()->route('login-admin');
            }
        }
    }

    /**
    *  Dang xuat admin
    */
    public function Logout() 
    {
        /**
         *  xoá session người dùng hiện tại
         */
        session()->forget(['admin_id', 'admin_name', 'kind']);
        session()->save();
        /**
         *  trả kết quả khi đăng xuất thành công
         */
        return redirect()->route('login-admin');
    }

    /**
    *  Them tai khoan quan tri
    */
    public function add_admin(Request $request)
    {
        //Them tai khoan quan tri
        if ($request->username != '' || $request->password != '') {
            $admin = new AdminModel;
            $CheckExist = $admin->where('username', $request->username)->count();
            if ($CheckExist != 0) {
                return response(["code" => 400, "message" => "Tên đăng nhập đã tồn tại"], 400);
            }

            $password_hash = password_hash($request->password, PASSWORD_DEFAULT);

            $admin->username = $request->username;
            $admin->password = $password_hash;
            $admin->save();
            return response(["code" => 200, "message" => "Thêm thành viên thành công"], 200);
        }
        
        return response(["code" => 400, "message" => "Bạn chưa nhập đủ dữ kiện"], 400);
    }

    /**
    *  Show tai khoan quan tri
    */
    public function show_tk_admin()
    {
        // Hien thi tai khoan admin
        $admin = new AdminModel;
        $result = $admin->get()->toArray();

        return $result ;
    }

    /**
    *  Xoa nhan vien
    */
    public function destroy(Request $request)
    {
        // Xoa quan tri vien
        $admin = new AdminModel;
        $data = $admin->where('id', $request->id)->first();
        if ($request->id == session('admin_id') || $data->kind == 0) {
            return response(["code" => 400, "message" => "Loi"], 400);
        } else {
            $admin->destroy(['id'=>$request->id]);
            return response(["code" => 200, "message" => "Xoa thanh cong"], 200);
        }
    }

    //Hien thi tai khoan nhan vien
    /**
    *  Dang nhap admin
    */
    public function showNhanVien()
    {
        $admin = new AdminModel;
        $result = $admin->get()->toArray();
        return $result;
    }

    
    /**
    *  Khoa tai khoan nhan vien
    */
    public function lock(Request $request)
    {   
        $admin = new AdminModel;
        $data = $admin->where('id', $request->id)->first();
        if ($request->id == session('admin_id') || $data->kind == 0) {
            return response(["error" => 400, "message" => "error", 400]);
        } else {
            $admin->where('id', $request->id)->update(['kind'=>'2']);
            return response(["code" => 200, "message" => "Thanh cong"], 200);
        }
        
        
    }

    
    /**
    *  Mo khoa tai khoan nhan vien
    */
    public function unlock(Request $request)
    {
        $admin = new AdminModel;
        $admin->where('id', $request->id)->update(['kind'=>'1']);
 
        return response(["code" => 200, "message" => "Thanh cong"], 200);
    }
}
