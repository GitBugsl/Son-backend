<?php

namespace App\Http\Controllers\Api\v1\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\Seller\Seller;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Laravel\Passport\DNSCheckValidation;
use Laravel\Passport\RFCValidation;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Seller\SellerAccount;
use App\Models\Seller\SellerAdress;


class SellerAuthController extends Controller
{
    public function seller_login(Request $request)
    {
    
            
            $email = $request->email;
            $password = $request->password;

            
            if(Auth::attempt(['email' => $email, 'password'=> $password]))
            {
              $user = Auth::User();
              $token = $user->createToken('Token')->accessToken;
              $user->email;
             
              return response()->json([
                'user' => ['email' => $user->email , 'ShopName' => $user->SellerAccount->SupplierShopName, 'ShopInfo' => $user->SellerAccount->SupplierShopInfo , 'ShopPhoto' => $user->SellerAccount->SupplierShopPhoto , 'SupplierId' => $user->SellerAccount->SupplierId ,'SupplierCity' => $user->SellerAdress->SupplierCity,'SupplierCounty' => $user->SellerAdress->SupplierCounty , 'SupplierRegion' => $user->SellerAdress->SupplierRegion ],
               'accessToken' =>  $token->token,
               'status' => 'ok',
           
               "message" => 'Logged in',
              ],200);
    
            }
            return response()->json([
                "status" => "error",
                 "message" => "Missing username and/or password"
            ],404);
        }      







    
    public function seller_register(Request $request){
        { 
            $validator = Validator::make($request->all(), [ 
                'name' => 'required',
                'email'  => 'required|email',
                'SupplierShopName' => 'required',
                'SupplierNumber' => 'required',
                'SupplierShopPhoto' => 'required',
                'SupplierShopInfo' => 'required',
                'SupplierCity' => 'required',
                'SupplierCounty' => 'required',
                'SupplierRegion' => 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'SupplierIbank' => 'required',
                'SupplierBankName' => 'required',
                'SupplierVkn' => 'required',
                'SupplierVd' => 'required',
                'SupplierName' => 'required',
                'SupplierSurname' => 'required',
                
                
            ]);
            
            if ($validator->fails()) { 
                 return response()->json(['Hata'=>$validator->errors()], 401);            
     }
      
       
                 
            $user = new User;
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->assignRole('Seller');
            $user->roltype = 'Seller' ;
            $user->save();

            $selleraccount = new SellerAccount;
            $selleraccount->SupplierShopName = $request->SupplierShopName;
            $selleraccount->SupplierNumber = $request->SupplierNumber;
            $selleraccount->SupplierShopPhoto = $request->SupplierShopPhoto;
            $selleraccount->SupplierShopInfo = $request->SupplierShopInfo;
            $selleraccount->SupplierIbank = $request->SupplierIbank;
            $selleraccount->SupplierBankName = $request->SupplierBankName;
            $selleraccount->SupplierVkn = $request->SupplierVkn;
            $selleraccount->SupplierVd = $request->SupplierVd;
            $selleraccount->SupplierName = $request->SupplierName;
            $selleraccount->SupplierSurname = $request->SupplierSurname;
            $selleraccount->SupplierId = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 7);
            $selleraccount->save();

            $selleradress = new SellerAdress;
            $selleradress->SupplierCity = $request->SupplierCity;
            $selleradress->SupplierCounty = $request->SupplierCounty;
            $selleradress->SupplierRegion = $request->SupplierRegion;
            $selleradress->SupplierId = $selleraccount->SupplierId;
            $selleradress->save();
            
            
       
          
          
           
     return response()->json([
        
        
      $user,
      $selleraccount,
      $selleradress,


    
    ]); 
        }
        return response()->json([
            "status" => "error",
             "message" => "Missing username and/or password"
        ],404);


    }
 


    public function supplierregister(Request $request){
        { 
            $validator = Validator::make($request->all(), [ 
               
                'SubSupplierSurname'=> 'required',
                'SubSupplierEmail'  => 'required|email|unique:Subsuppliers',
                'SubSupplierNumber'=> 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'openTime' => 'required',
                'closedTime' => 'required',
                'supplierShopName' => 'required',
                'supplierShopType' => 'required',
                'subnumber' => 'required',
                'productNumber' => 'required',
                'supplierShopPhoto' => 'required',
                'supplierShopInfo' => 'required',
                'supplierCity' => 'required',
                'supplierCounty' => 'required',
                'supplierRegion' => 'required',
              
            ]);
            
            if ($validator->fails()) { 
                 return response()->json(['Hata'=>$validator->errors()], 401);            
     }
     return response()->json([
        "status" => "error",
         "message" => "Missing username and/or password"
    ],404);
         
          
            $user = Auth::User();   
            $subsuppliers = new subsuppliers;
            $subsuppliers->password = bcrypt($request->password);
            $subsuppliers->SubSupplierNumber = $request->SubSupplierNumber;
            $subsuppliers->SubSupplierName = $request->SubSupplierName;
            $subsuppliers->SubSupplierEmail = $request->SubSupplierEmail;
            $subsuppliers->SubSupplierSurname = $request->SubSupplierSurname;
            $subsuppliers->SupplierId = $user->SupplierId;
            $subsuppliers->SubSupplierId = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);
            $subsuppliers->save();
           
           
            $supplieraddresses = new supplieraddresses;
            $supplieraddresses->supplierCity = $request->supplierCity;
            $supplieraddresses->supplierCounty = $request->supplierCounty;
            $supplieraddresses->supplierRegion = $request->supplierRegion;
            $supplieraddresses->SupplierId = $user->SupplierId;
            $supplieraddresses->save();
     
           
            $supplieraccounts = new supplieraccounts;
            $supplieraccounts->supplierShopName = $supplieraccounts->supplierShopName;
            $supplieraccounts->supplierShopType = $request->supplierShopType;
            $supplieraccounts->subnumber = $request->subnumber;
            $supplieraccounts->productNumber = $request->productNumber;
            $supplieraccounts->supplierShopPhoto = $request->supplierShopPhoto;
            $supplieraccounts->SupplierId = $user->SupplierId;
            $supplieraccounts->supplierShopInfo = $request->supplierShopInfo;
            $supplieraccounts->supplierHolidayMode = $request->supplierHolidayMode;
            $supplieraccounts->save();

  
           
     return response()->json([
        'supplierCity'=> $supplieraddresses->supplierCity,
        'supplierCounty'=> $supplieraddresses->supplierCounty,
        'supplierRegion'=> $supplieraddresses->supplierRegion,
        'supplierShopName'=> $supplieraccounts->supplierShopName,
        'supplierShopType'=> $supplieraccounts->supplierShopType,
        'subnumber'=> $supplieraccounts->subnumber,
        'productNumber'=> $supplieraccounts->productNumber,
   
    ]); 
        }

    }
    
    

    public function logout(Request $request){
       
        auth()->success['token']->token->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ],200);
    }
}
