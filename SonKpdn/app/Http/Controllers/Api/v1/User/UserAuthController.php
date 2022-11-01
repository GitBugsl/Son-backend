<?php
    namespace App\Http\Controllers\Api\v1\User;

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
    use App\Models\User\UserAdress;
    use App\Models\User\UserAccount;
    use Illuminate\Auth\Events\Registered;



    class UserAuthController extends Controller
    {


       

        public function user_login(Request $request)
        {
        
                
                $email = $request->email;
                $password = $request->password;

                
                if(Auth::attempt(['email' => $email, 'password'=> $password]))
                {
                $user = Auth::User();
                $token = $user->createToken('Token')->accessToken;
                $user->email;
                
                return response()->json([
                
                'accessToken' =>  $token->token,
                'status' => 'ok',
                'user' => ['email' => $user->email , 'UserCity' => $user->UserAdress->UserCity, 'UserCounty' => $user->UserAdress->UserCounty, 'UserRegion' => $user->UserAdress->UserRegion, 'UserName' => $user->UserAccount->UserName,'UserSurname' => $user->UserAccount->UserSurname,'UserNumber' => $user->UserAccount->UserNumber, 'UserPhoto' => $user->UserAccount->UserPhoto ],

                "message" => 'Logged in',
                ],200);
        
                }
                return response()->json([
                    "status" => "error",
                    "message" => "Missing username and/or password"
                ],404);
            }      







        
        public function user_register(Request $request){
            { 
                $validator = Validator::make($request->all(), [ 
                    'email'  => 'required|email',
                    'UserCity' => 'required',
                    'UserCounty' => 'required',
                    'UserRegion' => 'required',
                    'UserName' => 'required',
                    'UserSurname' => 'required',
                    'UserNumber' => 'required' ,
                    'UserPhoto' => 'required' ,
                    'password' => 'required',
                    'c_password' => 'required|same:password',
                    'name' => 'required',
                
                    
                    
                ]);
               
                if ($validator->fails()) { 
                    return response()->json(['Hata'=>$validator->errors()], 401);            
        }
        
        
               
                $user = new User;
                $user->password = bcrypt($request->password);
                $user->email = $request->email;
                $user->assignRole('User');
                $user->roltype = 'User' ;
                $user->name = $request->name;
                $user->save();event(new Registered($user));

                $useradress = new UserAdress;
                $useradress->UserCity = $request->UserCity;
                $useradress->UserCounty = $request->UserCounty;
                $useradress->UserRegion = $request->UserRegion;
                $useradress->save();

                $useraccount = new UserAccount;
                $useraccount->UserName = $request->UserName;
                $useraccount->UserSurname = $request->UserSurname;
                $useraccount->UserNumber = $request->UserNumber;
                $useraccount->UserPhoto = $request->UserPhoto;
                $useraccount->UserId = $request->UserId;
                $useraccount->save();

                

                
            
    
        
            
            
            
        return response()->json([
            
            
        $user,
        $useradress,

        
        ]); 
            }
            return response()->json([
                "status" => "error",
                "message" => "Missing username and/or password"
            ],404);


        }
    


    
    }
