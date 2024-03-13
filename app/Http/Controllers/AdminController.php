<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
        // direct change password page
        public function passwordChangePage (){
            return view('admin.account.changePassword');
        }

        // change password
        public function passwordChange (Request $request){
            /*
                1. all field must be fill
                2. new password and confirm password length must be greater than 6 | must not be greater than 10
                3. new password and confirm password must be same
                4. client old password must same with db password
                5. change password
            */

            $this->passwordValidationCheck($request);
            $user = User::select('password')->where('id',Auth::user()->id)->first();
            $dbHashPassword = $user->password;

            if(Hash::check($request->oldPassword, $dbHashPassword)){
                $data = [
                    'password' =>Hash::make($request->newPassword)
                ];
                User::where('id',Auth::user()->id)->update($data);
                // Auth::logout();
                return back()->with(['changeSuccess'=>'Password Change Success!']);
                }

            return back()->with(['notMatch' => 'The old password is not match. Try again!']);

        }
        // direct profile page
        public function details(){
            return view('admin.account.details');
        }
        // edit profile page
        public function editProfile(){
            return view('admin.account.editProfile');
        }

        //edit name page
        public function editName(){
            return view('admin.account.editName');
        }

        // edit email page
        public function editEmail(){
            return view('admin.account.editEmail');
        }

        // edit phone page
        public function editPhone(){
            return view('admin.account.editPhone');
        }

        // edit address page
        public function editAddress(){
            return view('admin.account.editAddress');
        }

        // edit gender page
        public function editGender(){
            return view('admin.account.editGender');
        }

        // update profile
        public function updateProfile($id, Request $request){

            $this->updateValidationCheck($request);
            $data = $this->getUpdateData($request);

            // for image
            if($request->hasFile('image')){
                // 1. get old 2. check & delete $ new image save
                $dbImage = User::where('id',$id)->first();
                $dbImage = $dbImage->image;

                if($dbImage != null){
                    Storage::delete('public/'.$dbImage);
                }

                $fileName = uniqid().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] = $fileName;
            }
            User::where('id',$id)->update($data);
            return redirect()->route('admin#details');
        }

        // update name
        public function updateName($id,Request $request){
            $this->getNameValidation($request);
            $data = $this->getNameData($request);

            User::where('id',$id)->update($data);
            return redirect()->route('admin#details');
        }

        // update email
         public function updateEmail($id,Request $request){
            $this->getEmailValidation($request);
            $data = $this->getEmailData($request);
            User::where('id',$id)->update($data);
            return redirect()->route('admin#details');
        }

        // update phone
         public function updatePhone($id,Request $request){
            $this->getPhoneValidation($request);
            $data = $this->getPhoneData($request);
            User::where('id',$id)->update($data);
            return redirect()->route('admin#details');
        }

         // update address
         public function updateAddress($id,Request $request){
            $this->getAddressValidation($request);
            $data = $this->getAddressData($request);
            User::where('id',$id)->update($data);
            return redirect()->route('admin#details');
        }

        // update gender
        public function updateGender($id, Request $request){
             $this->getGenderValidation($request);
            $data = $this->getGenderData($request);
            User::where('id',$id)->update($data);
            return redirect()->route('admin#details');
        }

        // admin list
        public function adminList () {
            $admin = User::when(request('key'),function($query){
                                $query->orWhere('name','like','%'.request('key').'%')
                                      ->orWhere('email','like','%'.request('key').'%')
                                      ->orWhere('phone','like','%'.request('key').'%')
                                      ->orWhere('gender','like','%'.request('key').'%')
                                      ->orWhere('address','like','%'.request('key').'%');
                            })
                            ->where('role','admin')
                            ->paginate(3);
            $admin->appends(request()->all);
            return view('admin.account.adminList',compact('admin'));
        }

        // admin edit
        public function adminEdit($id){
            $admin = User::where('id',$id)->first();
            return view('admin.account.adminEditPage',compact('admin'));
        }

        // admin update
        public function adminUpdate($id, Request $request){
            $this->updateValidationCheck($request);
            $data = $this->getUpdateData($request);

            if($request->hasFile('image')){
                $dbImage = User::where('id',$id)->first();
                $dbImage = $dbImage->image;

                if($dbImage != null){
                    Storage::delete('public/'.$dbImage);
                }
                $fileName = uniqid().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] = $fileName;
            }
            User::where('id',$id)->update($data);
            return redirect()->route('admin#list');
        }

        // admin delete
        public function adminDelete($id){
            User::where('id',$id)->delete();
            return back()->with(['deleteSuccess'=>'Account delete success.']);
        }

        // admin change role page
        // public function adminChangeRole($id){
        //    $account = User::where('id',$id)->first();
        //     return view('admin.account.changeRole',compact('account'));
        // }

        // admin change role
        public function ajaxChange(Request $request){
           User::where('id',$request->userId)->update([
            'role' => $request->currentStatus
        ]);

        }

        // get account data
        private function getAccountData ($request){
            return [
                'role' => $request->role
            ];
        }
        // get gender request
        private function getGenderData($request){
            return[
                'gender' => $request->gender
            ];
        }

        // // get email validation
        private function getGenderValidation($request){
            Validator::make($request->all(),[
                'gender'=>'required'
            ])->validate();
        }

        // get email request
        private function getEmailData($request){
            return[
                'email' => $request->email
            ];
        }

        // // get email validation
        private function getEmailValidation($request){
            Validator::make($request->all(),[
                'email'=>'required'
            ])->validate();
        }

        // get phone request
        private function getPhoneData($request){
            return[
                'phone' => $request->phone
            ];
        }

        // // get phone validation
        private function getPhoneValidation($request){
            Validator::make($request->all(),[
                'phone'=>'required'
            ])->validate();
        }

        // get address request
        private function getAddressData($request){
            return[
                'address' => $request->address
            ];
        }

        // // get address validation
        private function getAddressValidation($request){
            Validator::make($request->all(),[
                'address'=>'required'
            ])->validate();
        }

        // get name request
        private function getNameData($request){
            return[
                'name' => $request->name
            ];
        }

        // get name validation
        private function getNameValidation($request){
            Validator::make($request->all(),[
                'name'=>'required'
            ])->validate();
        }

        // get update data request
        private function getUpdateData($request){
            return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
            ];
        }

        // update validation check
        private function updateValidationCheck($request){
            Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image' =>'mimes:png,jpg,jpeg,webp|file',
                'gender' => 'required',
                'address' => 'required'

            ])->validate();
        }

        // password validation check
        private function passwordValidationCheck($request){
            Validator::make($request->all(),[
                'oldPassword' => 'required|min:6|max:10',
                'newPassword' => 'required|min:6|max:10',
                'confirmPassword' => 'required|min:6|max:10|same:newPassword'
            ])->validate();
        }
}
